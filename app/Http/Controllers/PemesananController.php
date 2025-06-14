<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function pemesanan()
{
    // Ambil data semua studio dari tabel studio_foto
    $studioList = DB::table('studio_foto')->get();

    return view('booking.pemesanan', [
        'studioList' => $studioList,
        'user' => Auth::user()
    ]);
}

    public function simpan(Request $request)
{
    $request->validate([
        'nama'          => 'required|string|max:100',
        'no_hp'         => 'required|string|max:15',
        'id_studio'     => 'required|integer',
        'tanggal'       => 'required|date',
        'jam'           => 'required|date_format:H:i',
        'jumlah_orang'  => 'required|integer|min:1',
    ]);

    // Cek apakah studio sudah dibooking pada waktu yang sama
    $existing = DB::table('pemesanan')
        ->where('id_studio', $request->id_studio)
        ->where('tanggal', $request->tanggal)
        ->where('jam', $request->jam)
        ->exists();

    if ($existing) {
        return back()->withErrors([
            'msg' => 'Studio sudah dibooking pada tanggal dan jam tersebut.'
        ])->withInput();
    }

    // Simpan ke database
    $id = DB::table('pemesanan')->insertGetId([
        'nama'          => $request->nama,
        'no_hp'         => $request->no_hp,
        'id_studio'     => $request->id_studio,
        'tanggal'       => $request->tanggal,
        'jam'           => $request->jam,
        'jumlah_orang'  => $request->jumlah_orang,
    ]);

    return redirect()->route('bukti.form', ['id' => $id]);
}

}
