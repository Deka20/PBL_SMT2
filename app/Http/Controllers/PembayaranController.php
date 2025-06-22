<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\VerifikasiPembayaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    public function form($id)
    {
        $pemesanan = Pemesanan::with('studio')->findOrFail($id);

        return view('booking.pembayaran', [
            'pemesanan' => $pemesanan,
            'id' => $id
        ]);
    }

  public function upload(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'id_pemesanan' => 'required|integer|exists:pemesanan,id_pemesanan'
    ]);

    DB::beginTransaction();

    try {
        // Temukan pemesanan
        $pemesanan = Pemesanan::with('verifikasiPembayaran')->findOrFail($validated['id_pemesanan']);

        // Validasi status pemesanan
        if ($pemesanan->status !== 'pending') {
            throw new \Exception('Pemesanan sudah diproses, tidak dapat mengupload bukti pembayaran');
        }

        // Generate nama file unik
        $extension = $request->file('bukti_pembayaran')->extension();
        $filename = 'payment_'.$pemesanan->id_pemesanan.'_'.time().'.'.$extension;
        
        // Simpan file
        $path = $request->file('bukti_pembayaran')->storeAs(
            'bukti_pembayaran',
            $filename,
            'public'
        );

        // Update atau buat pembayaran
        $pembayaran = Pembayaran::updateOrCreate(
            ['id_pemesanan' => $pemesanan->id_pemesanan],
            [
                'bukti_pembayaran' => $path,
                'status' => 'pending', // Tetap 'pending'
            ]
        );

        // Verifikasi pembayaran tetap 'pending'
        VerifikasiPembayaran::updateOrCreate(
            ['id_pemesanan' => $pemesanan->id_pemesanan],
            [
                'status_pembayaran' => 'menunggu verifikasi', // Tetap 'pending'
            ]
        );

        DB::commit();

        return redirect()->route('riwayat')
            ->with('success', 'Bukti pembayaran berhasil diupload. Status tetap pending.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal upload: ' . $e->getMessage());
    }
}

   public function updateStatus(Request $request, $id_pemesanan)
    {
        $validated = $request->validate([
            'status_pembayaran' => 'required|string|in:menunggu verifikasi,diverifikasi,ditolak,selesai',
        ]);

        try {
            DB::beginTransaction();

            // Find the booking with its related verification and payment data
            $pemesanan = Pemesanan::with(['verifikasiPembayaran', 'pembayaran'])->findOrFail($id_pemesanan);

            // If a verification record already exists, update it.
            if ($pemesanan->verifikasiPembayaran) {
                $pemesanan->verifikasiPembayaran->update([
                    'status_pembayaran' => $validated['status_pembayaran'],
                    'updated_at' => now()
                ]);
            } else {
                // If no verification record exists, create one.
                // It's crucial that a 'pembayaran' record exists for this 'pemesanan'
                // before a 'verifikasiPembayaran' can be created.
                if (!$pemesanan->pembayaran) {
                    throw new \Exception('Data pembayaran tidak ditemukan untuk pemesanan ini. Tidak dapat membuat verifikasi pembayaran.');
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status verifikasi pembayaran berhasil diperbarui.',
                'status_pembayaran' => $validated['status_pembayaran']
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}