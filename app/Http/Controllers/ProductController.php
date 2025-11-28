<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGuestReview;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // hitung rating rata-rata dari review tamu
        $product->load(['photos', 'guestReviews']);

        $averageRating = $product->guestReviews()->avg('rating') ?? 0;
        $reviewsCount  = $product->guestReviews()->count();

        // distribusi rating (1–5) untuk progress bar
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $product->guestReviews()
                ->where('rating', $i)
                ->count();
        }

        return view('products.show', [
            'product'       => $product,
            'averageRating' => round($averageRating, 1),
            'reviewsCount'  => $reviewsCount,
            'ratingCounts'  => $ratingCounts,
        ]);
    }

    public function storeGuestReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:150',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        ProductGuestReview::create([
            'product_id' => $product->id,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'rating'     => $data['rating'],
            'comment'    => $data['comment'],
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Terima kasih, ulasanmu sudah tersimpan.');
    }
}