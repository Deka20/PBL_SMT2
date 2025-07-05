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
use App\Models\VerifikasiPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        $userId = Auth::id();
        $booking = Pemesanan::with(['studio', 'pembayaran', 'reviews'])
            ->where('id_pemesanan', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$booking) {
            abort(404, 'Reservasi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $userReview = $booking->reviews->first();
        return view('detailreservasi', compact('booking', 'userReview'));
    }

    public function simpan(Request $request)
{
    // Validasi input data
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
        'id_studio' => 'required|exists:studio_foto,id_studio',
        'tanggal' => 'required|date_format:Y-m-d|after_or_equal:today',
        'jam' => 'required|string',
        'jumlah_orang' => 'required|integer|min:1|max:10',
        'bukti_pembayaran' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('bukti_pembayaran')) {
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        $validated['bukti_pembayaran'] = $path;
    }

    // Pastikan jam adalah string sebelum split
    $jamSlots = is_string($validated['jam']) ? explode(',', $validated['jam']) : [$validated['jam']];
    
    // Validasi setiap slot waktu
    foreach ($jamSlots as $jam) {
        $jam = trim($jam);
        if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $jam)) {
            throw ValidationException::withMessages([
                'jam' => ['Format jam tidak valid. Harus dalam format HH:MM.']
            ]);
        }

        // Validasi waktu tidak di masa lalu
        $bookingDateTime = Carbon::parse($validated['tanggal'] . ' ' . $jam, 'Asia/Jakarta');
        if ($bookingDateTime->lt(Carbon::now('Asia/Jakarta'))) {
            throw ValidationException::withMessages([
                'jam' => ['Waktu pemesanan tidak boleh di masa lalu.']
            ]);
        }
    }

    DB::beginTransaction();

    try {
        $studio = Studio::findOrFail($validated['id_studio']);
        $slotDurationMinutes = 15;
        $totalAmount = 0;
        $jamAwal = null;
        $jamAkhir = null;
        $detailSlots = [];

        // Cek overlap dan hitung total harga untuk semua slot
        foreach ($jamSlots as $index => $jam) {
            $jam = trim($jam);
            $bookingTime = Carbon::parse($validated['tanggal'] . ' ' . $jam, 'Asia/Jakarta');
            $bookingEndTime = $bookingTime->copy()->addMinutes($slotDurationMinutes);

            // Set jam awal dan akhir
            if ($index === 0) {
                $jamAwal = $jam;
            }
            if ($index === count($jamSlots) - 1) {
                $jamAkhir = $bookingEndTime->format('H:i');
            }

$overlappingBookings = Pemesanan::where('id_studio', $validated['id_studio'])
    ->where('tanggal', $validated['tanggal'])
    ->whereHas('verifikasiPembayaran', function($query) {
        $query->whereIn('status_pembayaran', [
            VerifikasiPembayaran::STATUS_PENDING,
            VerifikasiPembayaran::STATUS_DIKONFIRMASI,
        ]);
    })
    ->get();

            $isOverlap = $overlappingBookings->contains(function ($existingBooking) use ($bookingTime, $bookingEndTime, $slotDurationMinutes) {
                // Cek overlap dengan jam awal dan jam akhir booking yang ada
                $existingBookingStart = Carbon::parse($existingBooking->tanggal . ' ' . $existingBooking->jam, 'Asia/Jakarta');
                $existingBookingEnd = Carbon::parse($existingBooking->tanggal . ' ' . $existingBooking->jam_akhir, 'Asia/Jakarta');

                return ($bookingTime->lt($existingBookingEnd) && $bookingEndTime->gt($existingBookingStart));
            });

            if ($isOverlap) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Slot studio tidak tersedia pada ' .
                        Carbon::parse($validated['tanggal'])->translatedFormat('l, d F Y') .
                        ' jam ' . $jam . '. Slot ini sudah dipesan atau sedang dalam proses pembayaran.',
                ], 409);
            }

            // Hitung harga per slot
            $hargaDasar = $studio->harga;
            $biayaTambahan = max(0, ($validated['jumlah_orang'] - 1)) * 5000;
            $totalAmount += $hargaDasar + $biayaTambahan;

            // Simpan detail untuk resi
            $detailSlots[] = [
                'jam' => $jam,
                'jam_akhir' => $bookingEndTime->format('H:i'),
                'harga_dasar' => $hargaDasar,
                'biaya_tambahan' => $biayaTambahan
            ];
        }

        // Hitung durasi total
        $totalDurasi = count($jamSlots) * $slotDurationMinutes;

        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'id_studio' => $validated['id_studio'],
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'tanggal' => $validated['tanggal'],
            'jam' => $jamAwal,
            'jam_akhir' => $jamAkhir,
            'durasi' => $totalDurasi,
            'jumlah_orang' => $validated['jumlah_orang'],
            'total_harga' => $totalAmount,
        ]);

        $pemesanan->slots_detail = implode(',', array_map('trim', $jamSlots));
        $pemesanan->save();

        // Buat pembayaran
        $pembayaran = Pembayaran::create([
            'user_id' => Auth::id(),
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'tgl_pembayaran' => null,
            'bukti_pembayaran' => $validated['bukti_pembayaran'] ?? null,
        ]);

        DB::table('verifikasi_pembayaran')->insert([
        'id_pembayaran' => $pembayaran->id_pembayaran,
        'id_pemesanan' => $pemesanan->id_pemesanan,
        'status_pembayaran' => $request->hasFile('bukti_pembayaran') ? 'menunggu verifikasi' : 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

        // Buat detail untuk resi
        $detailSewa = sprintf(
            "Pemesanan %s - %s\nTanggal: %s\nJam: %s - %s\nDurasi: %d menit (%d slot)\nJumlah Orang: %d orang\n",
            $studio->nama_studio,
            $studio->jenis_studio,
            Carbon::parse($validated['tanggal'])->translatedFormat('l, d F Y'),
            $jamAwal,
            $jamAkhir,
            $totalDurasi,
            count($jamSlots),
            $validated['jumlah_orang']
        );

        // Tambahkan detail per slot ke resi
        foreach ($detailSlots as $index => $slot) {
            $detailSewa .= sprintf(
                "Slot %d: %s - %s (Rp %s + Rp %s)\n",
                $index + 1,
                $slot['jam'],
                $slot['jam_akhir'],
                number_format($slot['harga_dasar'], 0, ',', '.'),
                number_format($slot['biaya_tambahan'], 0, ',', '.')
            );
        }

        $detailSewa .= sprintf("Total Harga: Rp %s", number_format($totalAmount, 0, ',', '.'));

        // Buat resi
        Resi::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'detail_sewa' => $detailSewa,
            'nama_studio' => $studio->nama_studio,
            'jenis_studio' => $studio->jenis_studio,
            'total_harga' => $totalAmount,
            'status' => 'pending',
        ]);

        // Buat total penghasilan
        $tanggalPemesanan = Carbon::parse($validated['tanggal']);
        $periode = $tanggalPemesanan->format('Y-m');
        
        TotalPenghasilan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'id_studio' => $validated['id_studio'],
            'user_id' => Auth::id(),
            'nama_studio' => $studio->nama_studio,
            'jenis_studio' => $studio->jenis_studio,
            'tanggal_pemesanan' => $validated['tanggal'],
            'jam_pemesanan' => $jamAwal,
            'jumlah_orang' => $validated['jumlah_orang'],
            'harga_dasar' => $studio->harga * count($jamSlots),
            'biaya_tambahan' => max(0, ($validated['jumlah_orang'] - 1)) * 5000 * count($jamSlots),
            'total_harga' => $totalAmount,
            'status_pemesanan' => 'pending',
            'bulan' => $tanggalPemesanan->month,
            'tahun' => $tanggalPemesanan->year,
            'periode' => $periode
        ]);

        // Update total penghasilan summary
        $this->updatePenghasilanSummary($validated['id_studio'], $tanggalPemesanan);

       DB::commit();

        return response()->json([
            'success' => true,
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'redirect_url' => route('detailreservasi', $pemesanan->id_pemesanan),
            'message' => 'Pemesanan berhasil dibuat. Silakan selesaikan pembayaran dalam 1x24 jam.',
            'total_harga' => $totalAmount,
            'jumlah_slot' => count($jamSlots)
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in simpan method: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    private function updatePenghasilanSummary($studioId, Carbon $tanggal)
{
    try {
        $studio = Studio::find($studioId);
        if (!$studio) {
            Log::warning('Studio not found for summary update', ['studio_id' => $studioId]);
            return;
        }

        $periode = $tanggal->format('Y-m');

        $summary = Pemesanan::where('id_studio', $studioId)
            ->where('tanggal', 'LIKE', $periode . '%')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('verifikasi_pembayaran')
                      ->whereColumn('verifikasi_pembayaran.id_pemesanan', 'pemesanan.id_pemesanan')
                      ->where('verifikasi_pembayaran.status_pembayaran', 'diverifikasi');
            })
            ->selectRaw('
                COUNT(*) as total_transaksi,
                SUM(total_harga) as total_penghasilan,
                AVG(total_harga) as rata_rata_harga
            ')
            ->first();

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

        $bookings = Pemesanan::where('id_studio', $request->id_studio)
            ->where('tanggal', $request->tanggal)
            ->whereHas('verifikasiPembayaran', function($query) {
                $query->whereIn('status_pembayaran', [
                    VerifikasiPembayaran::STATUS_PENDING,
                    VerifikasiPembayaran::STATUS_DIKONFIRMASI
                ]);
            })
            ->get();

        $bookedSlots = [];
        $processingSlots = [];

        foreach ($bookings as $booking) {
            $status = $booking->verifikasiPembayaran->status_pembayaran;
            
            if ($status === VerifikasiPembayaran::STATUS_DIKONFIRMASI) {
                $bookedSlots[] = $booking->jam;
            } else {
                $processingSlots[] = $booking->jam;
            }
        }

        return response()->json([
            'booked' => array_unique($bookedSlots),
            'processing' => array_unique($processingSlots)
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
        ], 500);
    }
}
}