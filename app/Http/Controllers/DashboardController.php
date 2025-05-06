<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); 
    }

    public function pelanggan()
    {
        return view('pelanggan');
    }

    public function pengaturan()
    {
        return view('pengaturan');
    }

    public function ulasan()
    {
        return view('ulasan');
    }
    public function studio()
    {
        return view('studio');
    }
}