<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductGuestReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Halaman index laporan
     */
    public function index()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        return view('admin.reports.index');
    }

    /**
     * Urut: Status (Aktif dulu baru Tidak Aktif)
     */
    public function sellerStatus(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $notAdmin = function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); };

        // Gabungkan semua seller, urutkan berdasarkan status (approved = Aktif dulu)
        $sellers = User::where(function($q) {
                $q->whereNotNull('seller_status');
            })
            ->where($notAdmin)
            ->orderByRaw("CASE WHEN seller_status = 'approved' THEN 0 ELSE 1 END")
            ->orderBy('shop_name')
            ->get()
            ->map(function ($seller) {
                return [
                    'nama_user' => $seller->email,
                    'nama_pic' => $seller->name,
                    'nama_toko' => $seller->shop_name ?? '-',
                    'status' => $seller->seller_status === 'approved' ? 'Aktif' : 'Tidak Aktif',
                    'is_active' => $seller->seller_status === 'approved',
                ];
            });

        $data = [
            'title' => 'Laporan Daftar Akun Penjual Berdasarkan Status',
            'sellers' => $sellers,
            'activeSellersCount' => $sellers->where('is_active', true)->count(),
            'inactiveSellersCount' => $sellers->where('is_active', false)->count(),
            'generatedAt' => now()->format('d-m-Y'),
            'generatedBy' => auth()->user()->name,
        ];

        $pdf = Pdf::loadView('admin.reports.pdf.seller-status', $data);
        $pdf->setPaper('a4', 'portrait');
        
        // Set default font untuk DomPDF
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-status-penjual-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Urut: Berdasarkan Propinsi
     */
    public function sellersByProvince(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        // Ambil semua penjual aktif, urutkan berdasarkan provinsi
        $sellers = User::where('seller_status', 'approved')
            ->where(function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); })
            ->orderBy('provinsi')
            ->orderBy('shop_name')
            ->get()
            ->map(function ($seller) {
                return [
                    'nama_toko' => $seller->shop_name ?? '-',
                    'nama_pic' => $seller->name,
                    'provinsi' => $seller->provinsi ?? '-',
                ];
            });

        $data = [
            'title' => 'Laporan Daftar Toko Berdasarkan Lokasi Propinsi',
            'sellers' => $sellers,
            'totalSellers' => $sellers->count(),
            'generatedAt' => now()->format('d-m-Y'),
            'generatedBy' => auth()->user()->name,
        ];

        $pdf = Pdf::loadView('admin.reports.pdf.sellers-by-province', $data);
        $pdf->setPaper('a4', 'portrait');
        
        // Set default font untuk DomPDF
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-penjual-per-provinsi-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     */
    public function productRatings(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        // Ambil produk dengan rating dari review, provinsi diambil dari pemberi rating
        $products = Product::with(['seller', 'guestReviews'])
            ->withAvg('guestReviews', 'rating')
            ->withCount('guestReviews')
            ->orderByDesc('guest_reviews_avg_rating')
            ->get()
            ->map(function ($product) {
                // Ambil provinsi dari pemberi rating terbanyak/terbaru
                $reviewerProvince = $product->guestReviews()
                    ->whereNotNull('provinsi')
                    ->orderByDesc('created_at')
                    ->value('provinsi') ?? '-';
                
                return [
                    'produk' => $product->name,
                    'kategori' => $this->formatCategory($product->category),
                    'harga' => $product->price,
                    'rating' => $product->guest_reviews_avg_rating ?? 0,
                    'nama_toko' => $product->shop_name ?? optional($product->seller)->shop_name ?? '-',
                    'provinsi' => $reviewerProvince,
                ];
            });

        $data = [
            'title' => 'Laporan Daftar Produk Berdasarkan Rating',
            'products' => $products,
            'generatedAt' => now()->format('d-m-Y'),
            'generatedBy' => auth()->user()->name,
        ];

        $pdf = Pdf::loadView('admin.reports.pdf.product-ratings', $data);
        $pdf->setPaper('a4', 'landscape');
        
        // Set default font untuk DomPDF
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-produk-rating-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Format category slug to readable name
     */
    private function formatCategory($category)
    {
        if (!$category) return '-';
        
        $formatted = str_replace('-', ' ', $category);
        return ucwords($formatted);
    }

    /**
     * Preview laporan sebelum download (optional)
     */
    public function previewSellerStatus()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $notAdmin = function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); };

        // Gabungkan semua seller, urutkan berdasarkan status (approved = Aktif dulu)
        $sellers = User::where(function($q) {
                $q->whereNotNull('seller_status');
            })
            ->where($notAdmin)
            ->orderByRaw("CASE WHEN seller_status = 'approved' THEN 0 ELSE 1 END")
            ->orderBy('shop_name')
            ->get()
            ->map(function ($seller) {
                return [
                    'nama_user' => $seller->email,
                    'nama_pic' => $seller->name,
                    'nama_toko' => $seller->shop_name ?? '-',
                    'status' => $seller->seller_status === 'approved' ? 'Aktif' : 'Tidak Aktif',
                    'is_active' => $seller->seller_status === 'approved',
                ];
            });

        return view('admin.reports.pdf.seller-status', [
            'title' => 'Laporan Daftar Akun Penjual Berdasarkan Status',
            'sellers' => $sellers,
            'activeSellersCount' => $sellers->where('is_active', true)->count(),
            'inactiveSellersCount' => $sellers->where('is_active', false)->count(),
            'generatedAt' => now()->format('d-m-Y'),
            'generatedBy' => auth()->user()->name,
        ]);
    }
}
