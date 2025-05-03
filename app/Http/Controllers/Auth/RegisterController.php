<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.daftar');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap'     => 'required|string|max:255',
            'nama_pengguna'    => 'required|string|max:255|unique:users,nama_pengguna',
            'email'            => 'required|string|email|max:255|unique:users,email',
            'telepon'          => 'required|string|max:15',
            'password'         => 'required|string|min:8|confirmed',
            'tgl_lahir'        => 'required|string|max:15',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Buat user baru
        $user = User::create([
            'nama_lengkap'   => $request->nama_lengkap,
            'nama_pengguna'  => $request->nama_pengguna,
            'email'          => $request->email,
            'telepon'        => $request->telepon,
            'password'       => Hash::make($request->password),
            'role'           => 'pelanggan',
            'tgl_lahir'      => $request->tgl_lahir,
        ]);
    

        Auth::login($user);

        return redirect()->route('pages.home')->with('success', 'Registrasi berhasil!');
    }
}