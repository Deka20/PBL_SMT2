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
        return view('admin.pelanggan');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function ulasan()
    {
        return view('admin.ulasan');
    }
    public function studio()
    {
        return view('admin.studio');
    }
}