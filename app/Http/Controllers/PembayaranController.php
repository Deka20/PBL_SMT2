<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
    $validated = $request->validate([
        'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'id_pemesanan' => 'required|integer|exists:pemesanan,id_pemesanan'
    ]);

    try {
        DB::beginTransaction();

        $pemesanan = Pemesanan::findOrFail($validated['id_pemesanan']);

        // Generate unique filename
        $filename = 'payment_'.$pemesanan->id.'_'.time().'.'.$request->file('bukti_pembayaran')->extension();
        
        // Simpan file ke public storage
        $path = $request->file('bukti_pembayaran')->storeAs(
            'bukti_pembayaran', // Folder tujuan
            $filename,          // Nama file
            'public'            // Gunakan disk public
        );

        Pembayaran::updateOrCreate(
            ['id_pemesanan' => $validated['id_pemesanan']],
            [
                'bukti_pembayaran' => $path,
                'tgl_pembayaran' => now(),
                'status' => 'menunggu_verifikasi'
            ]
        );

        $pemesanan->update(['status' => 'menunggu_verifikasi']);

        DB::commit();

        return redirect()->route('riwayat')->with('success', 'Bukti pembayaran berhasil diupload');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Upload error: '.$e->getMessage());
        return back()->with('error', 'Gagal upload: '.$e->getMessage());
    }
}

    public function updateStatus(Request $request, $id_pemesanan)
{
    // Log input request
    Log::info('Permintaan updateStatus diterima.', [
        'id_pemesanan_route' => $id_pemesanan,
        'request_status' => $request->status
    ]);

    $request->validate([
        'status' => 'required|string|in:pending,lunas,dibatalkan',
    ]);

    try {
        DB::beginTransaction();

        // Cari data pemesanan dan pembayaran
        $pemesanan = Pemesanan::with('pembayaran')->findOrFail($id_pemesanan);
        
        // Log hasil pencarian
        Log::info('Data pemesanan dan pembayaran ditemukan.', [
            'id_pemesanan' => $pemesanan->id_pemesanan, 
            'current_status_pemesanan' => $pemesanan->status,
            'current_status_pembayaran' => $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null
        ]);

        // Simpan status lama untuk logging
        $oldStatusPemesanan = $pemesanan->status;
        $oldStatusPembayaran = $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null;

        // Mapping status yang sesuai antara pemesanan dan pembayaran
        $statusMapping = [
            'pending' => 'menunggu_verifikasi',
            'lunas' => 'dikonfirmasi',
            'dibatalkan' => 'ditolak'
        ];

        // Perbarui status pemesanan
        $pemesanan->status = $request->status;
        
        // Perbarui status pembayaran jika ada
        if ($pemesanan->pembayaran) {
            $pemesanan->pembayaran->status = $statusMapping[$request->status] ?? $request->status;
        }

        // Cek apakah ada perubahan yang sebenarnya
        $isPemesananChanged = $pemesanan->isDirty('status');
        $isPembayaranChanged = $pemesanan->pembayaran ? $pemesanan->pembayaran->isDirty('status') : false;

        if ($isPemesananChanged || $isPembayaranChanged) {
            // Simpan perubahan ke database
            $pemesanan->save();
            if ($pemesanan->pembayaran) {
                $pemesanan->pembayaran->save();
            }

            DB::commit();

            Log::info('Status berhasil diperbarui.', [
                'id_pemesanan' => $id_pemesanan,
                'old_status_pemesanan' => $oldStatusPemesanan,
                'new_status_pemesanan' => $pemesanan->status,
                'old_status_pembayaran' => $oldStatusPembayaran,
                'new_status_pembayaran' => $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null
            ]);
            
            // Response untuk AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui.',
                    'new_status_pemesanan' => $pemesanan->status,
                    'new_status_pembayaran' => $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null
                ]);
            }
            
            return back()->with('success', 'Status berhasil diperbarui.');
        } else {
            DB::rollBack();
            
            Log::info('Status tidak berubah (sudah sama).', [
                'id_pemesanan' => $id_pemesanan,
                'current_status_pemesanan' => $pemesanan->status,
                'current_status_pembayaran' => $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null,
                'requested_status' => $request->status
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status sudah sesuai. Tidak ada perubahan dilakukan.',
                    'current_status_pemesanan' => $pemesanan->status,
                    'current_status_pembayaran' => $pemesanan->pembayaran ? $pemesanan->pembayaran->status : null
                ]);
            }
            
            return back()->with('info', 'Status sudah sesuai. Tidak ada perubahan dilakukan.');
        }

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        Log::error('Validasi gagal untuk updateStatus.', ['errors' => $e->errors()]);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
        
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Terjadi kesalahan saat memperbarui status.', [
            'id_pemesanan' => $id_pemesanan,
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine()
        ]);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
        
        return back()->with('error', 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage());
    }
}
}