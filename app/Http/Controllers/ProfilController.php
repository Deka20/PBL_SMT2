<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_pengguna' => 'required|string|max:255|unique:users,nama_pengguna,' . $user->id,
            'tgl_lahir' => 'nullable|date',
            'telepon' => 'nullable|string|max:15',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profil_photos', 'public');
            $user->photo = $path;
        }

        $user->nama_lengkap = $request->nama_lengkap;
        $user->nama_pengguna = $request->nama_pengguna;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->telepon = $request->telepon;
        $user->save();

        return redirect()->route('profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
