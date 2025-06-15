<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
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

      public function simpan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_studio' => 'required|exists:studio_foto,id_studio',
            'tanggal' => [
                'required',
                'date',
                'after_or_equal:today',
                // Custom rule to ensure date is not in the past relative to current time
                function ($attribute, $value, $fail) use ($request) {
                    $jam = $request->input('jam');
                    $bookingDateTime = \Carbon\Carbon::parse($value . ' ' . $jam);
                    if ($bookingDateTime->isPast() && !$bookingDateTime->isToday()) {
                        $fail("Tanggal dan jam tidak boleh di masa lalu.");
                    }
                },
            ],
            'jam' => 'required|date_format:H:i',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Check for existing bookings for the same studio, date, and time
            $existingBooking = Pemesanan::where('id_studio', $validated['id_studio'])
                ->where('tanggal', $validated['tanggal'])
                ->where('jam', $validated['jam'])
                ->whereIn('status', ['pending', 'confirmed']) // Consider what statuses should block new bookings
                ->first();

            if ($existingBooking) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Slot waktu pada ' . $validated['tanggal'] . ' jam ' . $validated['jam'] . ' untuk studio ini sudah dipesan.'
                ], 409); // 409 Conflict status code is appropriate for this
            }

            // Calculate total price
            $studio = Studio::findOrFail($validated['id_studio']);
            // Assuming 'harga' in Studio model is the base price per 15-min slot
            $totalHarga = $studio->harga + ($validated['jumlah_orang'] * 5000);

            // Create booking
            $pemesanan = Pemesanan::create([
                'id_user' => Auth::id(),
                'id_studio' => $validated['id_studio'],
                'nama' => $validated['nama'],
                'no_hp' => $validated['no_hp'],
                'tanggal' => $validated['tanggal'],
                'jam' => $validated['jam'],
                'jumlah_orang' => $validated['jumlah_orang'],
                'harga' => $totalHarga,
                'status' => 'pending', // Initial status is pending payment upload
            ]);

            // Create initial payment record linked to the booking
            Pembayaran::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'tgl_pembayaran' => null, // Will be set when payment proof is uploaded
                'status' => 'pending', // Pending payment proof upload
                'bukti_pembayaran' => null, // Will be set when payment proof is uploaded
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'message' => 'Pemesanan berhasil dibuat. Silakan upload bukti pembayaran.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Catch validation exceptions specifically to return proper JSON errors
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity status code
        }
        catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging purposes
            Log::error('Booking failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal saat memproses pemesanan. Silakan coba lagi.'
            ], 500);
        }
    }
}