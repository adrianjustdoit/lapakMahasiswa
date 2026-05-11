<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGuestReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard penjual dengan grafik statistik
     */
    public function index()
    {
        $user = Auth::user();
        
        // Pastikan user adalah seller
        if ($user->seller_status !== 'approved') {
            abort(403, 'Anda bukan penjual yang terverifikasi');
        }

        // Statistik dasar
        $totalProducts = Product::where('user_id', $user->id)->count();
        $totalStock = Product::where('user_id', $user->id)->sum('stock');
        $lowStockCount = Product::where('user_id', $user->id)->where('stock', '<', 2)->count();
        
        // Total reviews untuk produk seller
        $productIds = Product::where('user_id', $user->id)->pluck('id');
        $totalReviews = ProductGuestReview::whereIn('product_id', $productIds)->count();
        
        // Rata-rata rating
        $averageRating = ProductGuestReview::whereIn('product_id', $productIds)->avg('rating') ?? 0;

        return view('seller.dashboard.index', compact(
            'user',
            'totalProducts',
            'totalStock',
            'lowStockCount',
            'totalReviews',
            'averageRating'
        ));
    }

    /**
     * API untuk data chart
     */
    public function getChartData()
    {
        $user = Auth::user();
        
        if ($user->seller_status !== 'approved') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $productIds = Product::where('user_id', $user->id)->pluck('id');

        // 1. Sebaran jumlah stok per produk
        $stockDistribution = Product::where('user_id', $user->id)
            ->select('name', 'stock')
            ->orderBy('stock', 'desc')
            ->take(10)
            ->get();

        // 2. Sebaran nilai rating per produk
        $ratingDistribution = Product::where('user_id', $user->id)
            ->whereHas('guestReviews')
            ->withAvg('guestReviews', 'rating')
            ->withCount('guestReviews')
            ->orderByDesc('guest_reviews_avg_rating')
            ->take(10)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'rating' => round($product->guest_reviews_avg_rating, 1),
                    'reviews_count' => $product->guest_reviews_count,
                ];
            });

        // 3. Sebaran pemberi rating berdasarkan lokasi provinsi
        $reviewersByProvince = ProductGuestReview::whereIn('product_id', $productIds)
            ->whereNotNull('provinsi')
            ->selectRaw('provinsi, COUNT(*) as count')
            ->groupBy('provinsi')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return response()->json([
            'stockDistribution' => $stockDistribution,
            'ratingDistribution' => $ratingDistribution,
            'reviewersByProvince' => $reviewersByProvince,
        ]);
    }
}
