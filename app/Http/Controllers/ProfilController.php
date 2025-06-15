<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        return view('profil.profil', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_pengguna' => 'required|string|max:255|unique:users,nama_pengguna,' . $user->id,
            'tgl_lahir' => 'nullable|date',
            'telepon' => 'nullable|string|max:15',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Isi semua field kecuali 'foto'
        $user->fill(collect($validated)->except('foto')->toArray());

        logger('Validasi selesai, data user diisi tanpa foto');

        if ($request->hasFile('foto')) {
            logger('File foto terdeteksi: ' . $request->file('foto')->getClientOriginalName());

            // Jika ada foto lama, hapus dulu
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                logger('Menghapus foto lama: ' . $user->foto);
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profil_photos', 'public');
            logger('File foto berhasil diupload ke: ' . $path);

            $user->foto = $path;
        } else {
            logger('Tidak ada file foto yang diupload.');
        }

        $saved = $user->save();
        logger('User berhasil disimpan: ' . ($saved ? 'YES' : 'NO'));

        return redirect()->route('profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}