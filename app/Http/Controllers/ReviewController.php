<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'booking_id' => 'required|exists:pemesanan,id_pemesanan',
        'studio_id' => 'required|exists:studio_foto,id_studio',
        'rating' => 'required|integer|between:1,5',
        'review' => 'required|string|max:500'
    ]);

    // Cek apakah sudah ada review untuk booking ini
    $existingReview = Review::where('booking_id', $validated['booking_id'])->first();
    
    if ($existingReview) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah memberikan ulasan untuk reservasi ini.',
            'review' => $existingReview
        ], 422);
    }

    $review = Review::create([
        'booking_id' => $validated['booking_id'],
        'studio_id' => $validated['studio_id'],
        'user_id' => Auth::id(),
        'rating' => $validated['rating'],
        'review' => $validated['review'],
        'review_date' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Ulasan berhasil dikirim!',
        'review' => $review
    ]);
}

public function edit(Review $review)
    {
        // Check authorization
        if (Auth::id() !== $review->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'review' => $review
        ]);
    }

    public function update(Request $request, Review $review)
    {
        // Check authorization
        if (Auth::id() !== $review->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah ulasan ini.'
            ], 403);
        }

        try {
            $validated = $request->validate([
                'rating' => 'required|integer|between:1,5',
                'review' => 'nullable|string|max:500'
            ]);

            $review->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil diperbarui!',
                'review' => [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'review' => $review->review,
                    'updated_at' => $review->updated_at
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating review: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate ulasan.'
            ], 500);
        }
    }

    public function destroy(Review $review)
    {
        // Check authorization
        if (Auth::id() !== $review->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus ulasan ini.'
            ], 403);
        }

        try {
            $review->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error deleting review: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus ulasan.'
            ], 500);
        }
    }

  public function index()
{
    $studios = Studio::all();
    $reviews = Review::with(['user', 'studio'])->get();
    
    // Hitung jumlah dan distribusi rating
    $totalReviews = $reviews->count();
    $averageRating = $reviews->avg('rating');
    $ratingCount = $totalReviews;

    // Ganti nama dari ratingDistribution ke ratingCounts agar sesuai dengan view
    $ratingCounts = [
        5 => $reviews->where('rating', 5)->count(),
        4 => $reviews->where('rating', 4)->count(),
        3 => $reviews->where('rating', 3)->count(),
        2 => $reviews->where('rating', 2)->count(),
        1 => $reviews->where('rating', 1)->count(),
    ];

    return view('admin.ulasan', [
        'studios' => $studios,
        'reviews' => $reviews,
        'averageRating' => $averageRating,
        'ratingCount' => $ratingCount,
        'ratingCounts' => $ratingCounts,
        'totalReviews' => $totalReviews,
    ]);
}

}