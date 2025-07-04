<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the portfolio images.
     * This will be used to load existing images on page load.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->get();
        // You would typically pass this to your Blade view
        return view('settings', compact('portfolios'));
    }

    /**
     * Store a newly created portfolio image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Portfolio upload request received.');

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('portfolios', 'public');

                $portfolio = Portfolio::create([
                    'image_path' => $path,
                ]);

                Log::info('Image uploaded and saved to DB: ' . $path);

                return response()->json([
                    'success' => true,
                    'message' => 'Gambar portofolio berhasil diunggah!',
                    'data' => [
                        'id' => $portfolio->id,
                        'image_path' => Storage::url($portfolio->image_path),
                        'created_at' => $portfolio->created_at->format('d/m/Y'),
                    ]
                ], 201);
            }

            Log::warning('No image file provided in the request.');
            return response()->json(['success' => false, 'message' => 'Tidak ada gambar yang diunggah.'], 400);

        } catch (\Exception $e) {
            Log::error('Error uploading portfolio image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mengunggah gambar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified portfolio image from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        Log::info('Portfolio delete request received for ID: ' . $portfolio->id);
        try {
            if (Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
                Log::info('Image file deleted: ' . $portfolio->image_path);
            }

            $portfolio->delete();
            Log::info('Portfolio record deleted from DB for ID: ' . $portfolio->id);

            return response()->json(['success' => true, 'message' => 'Portofolio berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting portfolio image ' . $portfolio->id . ': ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus portofolio: ' . $e->getMessage()], 500);
        }
    }
}