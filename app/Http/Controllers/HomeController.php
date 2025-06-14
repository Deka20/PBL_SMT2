<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\Studio; // Pastikan model Studio diimpor

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar studio.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua data studio dari database
        // Anda bisa menambahkan kriteria pengurutan atau filter sesuai kebutuhan
        $studios = Studio::orderBy('nama_studio', 'asc')->get();

        // Ambil semua data portofolio dari database, diurutkan berdasarkan terbaru
        $portfolios = Portfolio::latest()->get(); // Mengambil semua portofolio terbaru

        // Kirim data studio dan portofolio ke view 'pages.home'
        return view('pages.home', compact('studios', 'portfolios')); // Tambahkan 'portfolios' di compact
    }
}
