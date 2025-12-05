<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show(Request $request, User $user)
    {
        $user->loadCount('products');

        $productsQuery = $user->products()
            ->with(['photos', 'guestReviews'])
            ->latest();

        $search = $request->query('search');
        if ($search) {
            $productsQuery->where('name', 'like', "%{$search}%");
        }

        $products = $productsQuery->get();

        $topProducts = $user->products()
            ->with('guestReviews')
            ->latest()
            ->take(10)
            ->get();

        $reviewCollection = $topProducts->flatMap(function ($product) {
            return $product->guestReviews->map(function ($review) use ($product) {
                $review->setRelation('product', $product);
                return $review;
            });
        });

        $reviewCount = $reviewCollection->count();
        $averageRating = $reviewCount > 0
            ? round($reviewCollection->avg('rating'), 1)
            : 0;
        $positivePercentage = $reviewCount > 0
            ? round(($reviewCollection->where('rating', '>=', 4)->count() / $reviewCount) * 100)
            : 0;

        $ratingsBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingsBreakdown[$i] = $reviewCollection->where('rating', $i)->count();
        }

        $latestReviews = $reviewCollection
            ->sortByDesc('created_at')
            ->take(5);

        $reviewSummary = [
            'average'   => $averageRating,
            'count'     => $reviewCount,
            'positive'  => $positivePercentage,
            'breakdown' => $ratingsBreakdown,
        ];

        $categoryHighlights = $user->products()
            ->whereNotNull('category')
            ->pluck('category')
            ->filter()
            ->unique()
            ->take(6);

        return view('shops.show', [
            'seller'            => $user,
            'products'          => $products,
            'searchTerm'        => $search,
            'totalProductCount' => $user->products_count,
            'reviewSummary'     => $reviewSummary,
            'latestReviews'     => $latestReviews,
            'categoryHighlights' => $categoryHighlights,
        ]);
    }
}
