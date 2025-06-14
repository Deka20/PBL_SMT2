<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function form($id)
    {
        $pemesanan = DB::table('pemesanan')->where('id_pemesanan', $id)->first();
        $studio = DB::table('studio_foto')->where('id_studio', $pemesanan->id_studio)->first();

        return view('booking.pembayaran', [
            'pemesanan' => $pemesanan,
            'studio' => $studio,
            'id' => $id
        ]);
    }

    public function upload(Request $request)
{
    $request->validate([
        'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'id_pemesanan' => 'required|integer'
    ]);

    if (!$request->hasFile('bukti_pembayaran')) {
        return back()->with('error', 'File tidak terkirim');
    }

    $file = $request->file('bukti_pembayaran');
    $path = $file->store('bukti_pembayaran', 'public');

    DB::table('pembayaran')->insert([
        'id_pemesanan'      => $request->id_pemesanan,
        'bukti_pembayaran'  => $path,
        'tgl_pembayaran'    => now()->toDateString(),
        'status'            => 'Pending',
    ]);

    return redirect()->route('riwayat')->with('success', 'Bukti pembayaran berhasil dikirim.');
}

}
