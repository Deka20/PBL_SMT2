<?php

namespace App\Http\Controllers;

use App\Models\Review;
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
        $studios = Studio::all();

        $portfolios = Portfolio::latest()->get();

        $reviews = Review::with(['user', 'studio'])->get();
    
    // Calculate average rating and rating distribution
    $averageRating = $reviews->avg('rating');
    $ratingCount = $reviews->count();
    $ratingDistribution = [
        5 => $reviews->where('rating', 5)->count(),
        4 => $reviews->where('rating', 4)->count(),
        3 => $reviews->where('rating', 3)->count(),
        2 => $reviews->where('rating', 2)->count(),
        1 => $reviews->where('rating', 1)->count(),
    ];

     return view('pages.home', [ // Make sure 'your.view.name' matches your actual blade path, e.g., 'home' or 'welcome'
            'studios' => $studios,
            'portfolios' => $portfolios,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'ratingCount' => $ratingCount,
            'ratingDistribution' => $ratingDistribution,
        ]);
    }
    // Buat Search
    public function searchStudio(Request $request)
    {
        $query = $request->get('q');

        $studios = Studio::select('id_studio', 'nama_studio', 'jenis_studio', 'harga', 'gambar', 'kapasitas')
            ->where('nama_studio', 'like', "%$query%")
            ->orWhere('jenis_studio', 'like', "%$query%")
            ->orWhere('harga', 'like', "%$query%")
            ->get()
            ->unique('id_studio') // <-- ini penting!
            ->values(); // reset indeks

        return response()->json($studios);
    }
}
