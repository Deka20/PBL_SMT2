<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Resi;
use App\Models\Studio;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TotalPenghasilan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function pemesanan()
    {
        $studioList = Studio::all();

        return view('booking.pemesanan', [
            'studioList' => $studioList,
            'user' => Auth::user()
        ]);
    }

    public function detailreservasi($id)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Find the booking with related data
        $booking = Pemesanan::with(['studio', 'pembayaran', 'reviews']) // Eager load reviews
            ->where('id_pemesanan', $id)
            ->where('user_id', $userId) // Ensure user can only see their own bookings
            ->first();

        // If booking not found or doesn't belong to the user
        if (!$booking) {
            abort(404, 'Reservasi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Get the user's review for this booking, if any
        $userReview = $booking->reviews->first();

        return view('detailreservasi', compact('booking', 'userReview'));
    }

    public function simpan(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'id_studio' => 'required|exists:studio_foto,id_studio',
            'tanggal' => [
                'required',
                'date_format:Y-m-d', // Ensure date format is YYYY-MM-DD
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $jam = $request->input('jam');
                    try {
                        $bookingDateTime = Carbon::parse($value . ' ' . $jam, 'Asia/Jakarta'); // Specify timezone
                        // Check if the booking time is in the past relative to now, considering the current time
                        if ($bookingDateTime->lt(Carbon::now('Asia/Jakarta'))) { // Check if it's strictly before now
                            $fail("Waktu pemesanan tidak boleh di masa lalu.");
                        }
                    } catch (\Exception $e) {
                        $fail("Format tanggal atau jam tidak valid.");
                    }
                },
            ],
            'jam' => 'required|date_format:H:i',
            'jumlah_orang' => 'required|integer|min:1|max:10',
        ]);

        DB::beginTransaction();

        try {
            $studio = Studio::findOrFail($validated['id_studio']);

            $bookingTime = Carbon::parse($validated['tanggal'] . ' ' . $validated['jam'], 'Asia/Jakarta');
            $slotDurationMinutes = 15; // Assuming each booking slot is 15 minutes long
            $bookingEndTime = $bookingTime->copy()->addMinutes($slotDurationMinutes);

            // Fetch existing bookings for the selected studio and date
            // We need to consider active bookings and pending ones that are still within their grace period
            $overlappingBookings = Pemesanan::where('id_studio', $validated['id_studio'])
                ->where('tanggal', $validated['tanggal'])
                ->whereIn('status', ['pending', 'dikonfirmasi', 'lunas', 'menunggu_verifikasi'])
                ->get();

            // Custom logic to check for overlaps
            $isOverlap = $overlappingBookings->contains(function ($existingBooking) use ($bookingTime, $bookingEndTime, $slotDurationMinutes) {
                $existingBookingStart = Carbon::parse($existingBooking->tanggal . ' ' . $existingBooking->jam, 'Asia/Jakarta');
                $existingBookingEnd = $existingBookingStart->copy()->addMinutes($slotDurationMinutes);

                // Check for direct time overlap
                $directOverlap = ($bookingTime->lt($existingBookingEnd) && $bookingEndTime->gt($existingBookingStart));

                // Additionally, for 'pending' bookings, check if they were created recently
                // This prevents new bookings from taking a slot that was just reserved
                if ($existingBooking->status === 'pending') {
                    // Check if the pending booking was created within the last 15 minutes
                    $gracePeriodExpired = Carbon::now('Asia/Jakarta')->diffInMinutes($existingBooking->created_at) > 15;
                    // If grace period is not expired AND there's a direct overlap, then it's an overlap
                    return $directOverlap && !$gracePeriodExpired;
                }

                return $directOverlap;
            });


            if ($isOverlap) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot studio tidak tersedia pada ' .
                        Carbon::parse($validated['tanggal'])->translatedFormat('l, d F Y') .
                        ' jam ' . $validated['jam'] . '. Slot ini sudah dipesan atau sedang dalam proses pembayaran.',
                ], 409); // Conflict status code
            }

            // Calculate total price
            $hargaDasar = $studio->harga;
            $biayaTambahan = max(0, ($validated['jumlah_orang'] - 1)) * 5000;
            $totalHarga = $hargaDasar + $biayaTambahan;

            // Create booking
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'id_studio' => $validated['id_studio'],
                'nama' => $validated['nama'],
                'no_hp' => $validated['no_hp'],
                'tanggal' => $validated['tanggal'],
                'jam' => $validated['jam'],
                'jumlah_orang' => $validated['jumlah_orang'],
                'harga' => $totalHarga,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create payment record
            $pembayaran = Pembayaran::create([
                'user_id' => Auth::id(),
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'tgl_pembayaran' => null, // Will be filled upon payment
                'status' => 'pending',
                'bukti_pembayaran' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create resi record
            $detailSewa = sprintf(
                "Pemesanan %s - %s\nTanggal: %s\nJam: %s\nJumlah Orang: %d orang\nHarga Dasar: Rp %s\nBiaya Tambahan: Rp %s",
                $studio->nama_studio,
                $studio->jenis_studio,
                Carbon::parse($validated['tanggal'])->translatedFormat('l, d F Y'),
                $validated['jam'],
                $validated['jumlah_orang'],
                number_format($hargaDasar, 0, ',', '.'),
                number_format($biayaTambahan, 0, ',', '.')
            );

            $resi = Resi::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'detail_sewa' => $detailSewa,
                'nama_studio' => $studio->nama_studio,
                'jenis_studio' => $studio->jenis_studio,
                'total_harga' => $totalHarga,
                'status' => 'pending',
            ]);

            // Create total_penghasilan record
            $tanggalPemesanan = Carbon::parse($validated['tanggal']);
            $totalPenghasilan = TotalPenghasilan::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'id_studio' => $validated['id_studio'],
                'user_id' => Auth::id(),
                'nama_studio' => $studio->nama_studio,
                'jenis_studio' => $studio->jenis_studio,
                'tanggal_pemesanan' => $validated['tanggal'],
                'jam_pemesanan' => $validated['jam'],
                'jumlah_orang' => $validated['jumlah_orang'],
                'harga_dasar' => $hargaDasar,
                'biaya_tambahan' => $biayaTambahan,
                'total_harga' => $totalHarga,
                'status_pemesanan' => 'pending',
                'bulan' => $tanggalPemesanan->month,
                'tahun' => $tanggalPemesanan->year,
                'periode' => $tanggalPemesanan->format('Y-m'),
            ]);

            // Update summary (jika menggunakan tabel penghasilan_summary)
            $this->updatePenghasilanSummary($validated['id_studio'], $tanggalPemesanan);

            DB::commit();

            // Log successful booking
            Log::info('Pemesanan, resi, dan total penghasilan berhasil dibuat', [
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'id_resi' => $resi->id_resi,
                'id_total_penghasilan' => $totalPenghasilan->id,
                'user_id' => Auth::id(),
                'studio' => $studio->nama_studio,
                'tanggal' => $validated['tanggal'],
                'jam' => $validated['jam'],
                'total_harga' => $totalHarga
            ]);

            return response()->json([
                'success' => true,
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'id_resi' => $resi->id_resi,
                'redirect_url' => route('detailreservasi', $pemesanan->id_pemesanan),
                'message' => 'Pemesanan berhasil dibuat. Silakan selesaikan pembayaran dalam 1x24 jam.',
                'booking_details' => [
                    'nama' => $validated['nama'],
                    'no_hp' => $validated['no_hp'],
                    'studio' => $studio->nama_studio . ' - ' . $studio->jenis_studio,
                    'tanggal' => Carbon::parse($validated['tanggal'])->translatedFormat('l, d F Y'),
                    'jam' => $validated['jam'],
                    'jumlah_orang' => $validated['jumlah_orang'],
                    'total_harga' => 'Rp ' . number_format($totalHarga, 0, ',', '.')
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validasi pemesanan gagal', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi data gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Studio tidak ditemukan', ['id_studio' => $validated['id_studio'] ?? null]);
            return response()->json([
                'success' => false,
                'message' => 'Studio tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat pemesanan, resi, dan total penghasilan', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Update summary penghasilan bulanan
     */
    private function updatePenghasilanSummary($studioId, Carbon $tanggal)
    {
        try {
            $studio = Studio::find($studioId);
            if (!$studio) {
                Log::warning('Studio not found for summary update', ['studio_id' => $studioId]);
                return;
            }

            $periode = $tanggal->format('Y-m');

            // Recalculate total_penghasilan for confirmed/lunas/menunggu_verifikasi bookings
            // We should only sum up actual income from confirmed bookings
            $summary = Pemesanan::where('id_studio', $studioId)
                ->where('tanggal', 'LIKE', $periode . '%') // Match by month and year
                ->whereIn('status', ['dikonfirmasi', 'lunas', 'menunggu_verifikasi']) // Only count actual revenue
                ->selectRaw('
                    COUNT(*) as total_transaksi,
                    SUM(harga) as total_penghasilan,
                    AVG(harga) as rata_rata_harga
                ')
                ->first();

            // Update or create summary in penghasilan_summary table
            // Ensure penghasilan_summary table exists and has necessary columns
            DB::table('penghasilan_summary')
                ->updateOrInsert(
                    [
                        'id_studio' => $studioId,
                        'periode' => $periode
                    ],
                    [
                        'nama_studio' => $studio->nama_studio,
                        'jenis_studio' => $studio->jenis_studio,
                        'bulan' => $tanggal->month,
                        'tahun' => $tanggal->year,
                        'total_transaksi' => $summary->total_transaksi ?? 0,
                        'total_penghasilan' => $summary->total_penghasilan ?? 0,
                        'rata_rata_harga' => $summary->rata_rata_harga ?? 0,
                        'updated_at' => now()
                    ]
                );
        } catch (\Exception $e) {
            Log::warning('Gagal update penghasilan summary', [
                'studio_id' => $studioId,
                'periode' => $periode ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function getBookedSlots(Request $request)
{
    try {
        $request->validate([
            'tanggal' => 'required|date',
            'id_studio' => 'required|exists:studio_foto,id_studio'
        ]);

        $bookedSlots = Pemesanan::where('id_studio', $request->id_studio)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['pending', 'dikonfirmasi', 'lunas', 'menunggu_verifikasi'])
            ->pluck('jam')
            ->toArray();

        return response()->json($bookedSlots);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
        ], 500);
    }
}
}