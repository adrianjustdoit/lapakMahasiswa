<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGuestReview;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Halaman daftar laporan
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->seller_status !== 'approved') {
            abort(403, 'Anda bukan penjual yang terverifikasi');
        }

        return view('seller.reports.index');
    }

    /**
     * Laporan stok produk diurutkan berdasarkan stok (menurun)
     */
    public function stockByQuantity($token)
    {
        $user = Auth::user();
        
        if ($user->seller_status !== 'approved') {
            abort(403, 'Unauthorized');
        }

        $products = Product::where('user_id', $user->id)
            ->withAvg('guestReviews', 'rating')
            ->orderBy('stock', 'desc')
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'category' => $this->formatCategory($product->category),
                    'price' => $product->price,
                    'rating' => round($product->guest_reviews_avg_rating ?? 0, 1),
                ];
            });

        $data = [
            'title' => 'Laporan Stok Produk (Urutan Stok Menurun)',
            'shopName' => $user->shop_name,
            'products' => $products,
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => $user->name,
        ];

        $pdf = Pdf::loadView('seller.reports.pdf.stock-by-quantity', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-stok-produk-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Laporan stok produk diurutkan berdasarkan rating (menurun)
     */
    public function stockByRating($token)
    {
        $user = Auth::user();
        
        if ($user->seller_status !== 'approved') {
            abort(403, 'Unauthorized');
        }

        $products = Product::where('user_id', $user->id)
            ->withAvg('guestReviews', 'rating')
            ->orderByDesc('guest_reviews_avg_rating')
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'category' => $this->formatCategory($product->category),
                    'price' => $product->price,
                    'rating' => round($product->guest_reviews_avg_rating ?? 0, 1),
                ];
            });

        $data = [
            'title' => 'Laporan Stok Produk (Urutan Rating Menurun)',
            'shopName' => $user->shop_name,
            'products' => $products,
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => $user->name,
        ];

        $pdf = Pdf::loadView('seller.reports.pdf.stock-by-rating', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-stok-rating-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Laporan stok yang harus segera dipesan (stock < 2)
     */
    public function lowStock($token)
    {
        $user = Auth::user();
        
        if ($user->seller_status !== 'approved') {
            abort(403, 'Unauthorized');
        }

        $products = Product::where('user_id', $user->id)
            ->where('stock', '<', 2)
            ->withAvg('guestReviews', 'rating')
            ->orderBy('stock', 'asc')
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'category' => $this->formatCategory($product->category),
                    'price' => $product->price,
                    'rating' => round($product->guest_reviews_avg_rating ?? 0, 1),
                ];
            });

        $data = [
            'title' => 'Laporan Stok Produk yang Harus Segera Dipesan',
            'subtitle' => 'Produk dengan stok kurang dari 2',
            'shopName' => $user->shop_name,
            'products' => $products,
            'generatedAt' => now()->format('d F Y H:i:s'),
            'generatedBy' => $user->name,
        ];

        $pdf = Pdf::loadView('seller.reports.pdf.low-stock', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');

        return $pdf->download('laporan-stok-rendah-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Format category slug to readable name
     */
    private function formatCategory($category)
    {
        if (!$category) return '-';
        
        $categories = [
            'fashion-wanita' => 'Fashion Wanita',
            'fashion-pria' => 'Fashion Pria',
            'fashion-muslim' => 'Fashion Muslim',
            'busana-anak-bayi' => 'Busana Anak & Bayi',
            'sepatu-pria' => 'Sepatu Pria',
            'sepatu-wanita' => 'Sepatu Wanita',
            'sandal-slipper' => 'Sandal & Slipper',
            'tas-wanita' => 'Tas Wanita',
            'tas-pria' => 'Tas Pria',
            'jam-tangan' => 'Jam Tangan',
            'aksesoris-fashion' => 'Aksesoris Fashion',
            'emas-perhiasan' => 'Emas & Perhiasan',
            'fashion-lokal-umkm' => 'Fashion Lokal UMKM',
            'kecantikan-perawatan' => 'Kecantikan & Perawatan',
            'perawatan-kulit' => 'Perawatan Kulit',
            'kesehatan' => 'Kesehatan',
            'kesehatan-herbal' => 'Kesehatan Herbal',
            'ibu-bayi' => 'Ibu & Bayi',
            'perlengkapan-rumah' => 'Perlengkapan Rumah',
            'dapur-masak' => 'Dapur & Masak',
            'furnitur' => 'Furnitur',
            'dekorasi-rumah' => 'Dekorasi Rumah',
            'elektronik-rumah' => 'Elektronik Rumah',
            'peralatan-taman' => 'Peralatan Taman',
            'pertukangan' => 'Pertukangan',
            'handphone-aksesoris' => 'Handphone & Aksesoris',
            'laptop-aksesoris' => 'Laptop & Aksesoris',
            'komputer-komponen' => 'Komputer & Komponen',
            'kamera-aksesoris' => 'Kamera & Aksesoris',
            'gaming-console' => 'Gaming & Console',
            'fotografi-videografi' => 'Fotografi & Videografi',
            'otomotif-mobil' => 'Otomotif Mobil',
            'otomotif-motor' => 'Otomotif Motor',
            'hobi-koleksi' => 'Hobi & Koleksi',
            'olahraga-outdoor' => 'Olahraga & Outdoor',
            'camping-hiking' => 'Camping & Hiking',
            'alat-musik' => 'Alat Musik',
            'buku-alat-tulis' => 'Buku & Alat Tulis',
            'software-voucher' => 'Software & Voucher',
            'tiket-travel' => 'Tiket & Travel',
            'makanan-minuman' => 'Makanan & Minuman',
            'bahan-kue-sembako' => 'Bahan Kue & Sembako',
            'hewan-peliharaan' => 'Hewan Peliharaan',
            'perlengkapan-sekolah' => 'Perlengkapan Sekolah',
            'mainan-edukasi' => 'Mainan & Edukasi',
            'handmade-kerajinan' => 'Handmade & Kerajinan',
            'properti-kos' => 'Properti & Kos',
            'jasa-desain' => 'Jasa Desain',
            'jasa-servis' => 'Jasa Servis',
        ];

        return $categories[$category] ?? ucwords(str_replace('-', ' ', $category));
    }
}
