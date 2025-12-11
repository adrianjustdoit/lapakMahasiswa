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
     * SRS-MartPlace-09: Laporan daftar akun penjual aktif dan tidak aktif
     */
    public function sellerStatus(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $notAdmin = function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); };

        $activeSellers = User::where('seller_status', 'approved')
            ->where($notAdmin)
            ->orderBy('shop_name')
            ->get();

        $inactiveSellers = User::whereIn('seller_status', ['pending', 'rejected'])
            ->where($notAdmin)
            ->orderBy('shop_name')
            ->get();

        $data = [
            'title' => 'Laporan Daftar Akun Penjual Aktif dan Tidak Aktif',
            'activeSellers' => $activeSellers,
            'inactiveSellers' => $inactiveSellers,
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => auth()->user()->name,
        ];

        $pdf = Pdf::loadView('admin.reports.pdf.seller-status', $data);
        $pdf->setPaper('a4', 'portrait');
        
        // Set default font untuk DomPDF
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-status-penjual-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * SRS-MartPlace-10: Laporan daftar penjual (toko) untuk setiap lokasi provinsi
     */
    public function sellersByProvince(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        // Daftar semua 38 provinsi di Indonesia (urutan abjad)
        $allProvinces = [
            'Aceh',
            'Bali',
            'Banten',
            'Bengkulu',
            'Daerah Istimewa Yogyakarta',
            'DKI Jakarta',
            'Gorontalo',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'Lampung',
            'Maluku',
            'Maluku Utara',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Papua Barat Daya',
            'Papua Pegunungan',
            'Papua Selatan',
            'Papua Tengah',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sumatera Utara',
        ];

        // Ambil semua penjual aktif yang dikelompokkan berdasarkan provinsi
        $sellersByProvinceData = User::where('seller_status', 'approved')
            ->where(function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); })
            ->whereNotNull('provinsi')
            ->orderBy('provinsi')
            ->orderBy('shop_name')
            ->get()
            ->groupBy('provinsi');

        // Pisahkan provinsi yang punya penjual dan yang tidak
        $provincesWithSellersData = collect();
        $provincesWithoutSellers = collect();
        
        foreach ($allProvinces as $province) {
            $sellers = $sellersByProvinceData->get($province, collect());
            if ($sellers->count() > 0) {
                $provincesWithSellersData[$province] = $sellers;
            } else {
                $provincesWithoutSellers->push($province);
            }
        }

        $data = [
            'title' => 'Laporan Daftar Penjual Berdasarkan Provinsi',
            'provincesWithSellersData' => $provincesWithSellersData,
            'provincesWithoutSellers' => $provincesWithoutSellers,
            'allProvinces' => $allProvinces,
            'totalSellers' => $sellersByProvinceData->flatten()->count(),
            'provincesWithSellersCount' => $provincesWithSellersData->count(),
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => auth()->user()->name,
        ];

        $pdf = Pdf::loadView('admin.reports.pdf.sellers-by-province', $data);
        $pdf->setPaper('a4', 'portrait');
        
        // Set default font untuk DomPDF
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-penjual-per-provinsi-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * SRS-MartPlace-11: Laporan daftar produk dan ratingnya
     */
    public function productRatings(Request $request, $token)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $products = Product::with('seller')
            ->withAvg('guestReviews', 'rating')
            ->withCount('guestReviews')
            ->orderByDesc('guest_reviews_avg_rating')
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'shop_name' => $product->shop_name ?? optional($product->seller)->shop_name ?? '-',
                    'category' => $this->formatCategory($product->category),
                    'price' => $product->price,
                    'province' => optional($product->seller)->provinsi ?? '-',
                    'average_rating' => $product->guest_reviews_avg_rating ?? 0,
                    'reviews_count' => $product->guest_reviews_count ?? 0,
                ];
            });

        $data = [
            'title' => 'Laporan Daftar Produk dan Rating',
            'products' => $products,
            'generatedAt' => now()->format('d F Y H:i:s'),
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

        $activeSellers = User::where('seller_status', 'approved')
            ->where($notAdmin)
            ->orderBy('shop_name')
            ->get();

        $inactiveSellers = User::whereIn('seller_status', ['pending', 'rejected'])
            ->where($notAdmin)
            ->orderBy('shop_name')
            ->get();

        return view('admin.reports.pdf.seller-status', [
            'title' => 'Laporan Daftar Akun Penjual Aktif dan Tidak Aktif',
            'activeSellers' => $activeSellers,
            'inactiveSellers' => $inactiveSellers,
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => auth()->user()->name,
        ]);
    }
}
