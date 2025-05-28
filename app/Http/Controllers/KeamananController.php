<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KeamananController extends Controller
{
    public function keamanan()
    {
        return view('profil.keamanan'); // Pastikan path view benar
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $user = Auth::user();

        // Debugging: Cek input dan user
        \Log::info('Attempting password change for user: '.$user->id);
        \Log::info('Input data:', $request->all());

        if (!Hash::check($request->current_password, $user->password)) {
            \Log::error('Current password mismatch');
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->password = Hash::make($request->new_password);
        
        if ($user->save()) {
            \Log::info('Password changed successfully');
            return back()->with('success', 'Password berhasil diubah!');
        }

        \Log::error('Failed to save new password');
        return back()->with('error', 'Gagal mengubah password');
    }
}