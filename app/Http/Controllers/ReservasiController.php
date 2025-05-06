<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function reservasi()
    {
        return view('reservasi');
    }

    public function detailReservasi()
    {
        return view('detailreservasi');
    }

    public function reservasiLunas()
    {
        return view('reservasilunas');
    }

    public function reservasiSelesai()
    {
        return view('reservasiselesai');
    }

    public function statistikPendapatan()
    {
        return view('statistikpendapatan');
    }
}
