<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //contoh autentikasi sederhana
        if ($username == 'admin' && $password === '123') {
            return 'Login Berhasil!';
        } else {
            return 'Login Gagal!';
        }
    }
}
