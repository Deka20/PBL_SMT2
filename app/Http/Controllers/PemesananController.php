<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function pemesanan()
    {
        return view('booking.pemesanan');
    }
}
