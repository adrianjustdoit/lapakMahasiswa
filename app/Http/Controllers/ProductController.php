<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGuestReview;
use App\Models\ProductPhoto;
use App\Mail\NewReviewNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function create()
    {
        return view('seller.products.create');
    }

    // Daftar semua kategori yang valid
    private static $validCategories = [
        // Fashion & Aksesoris
        'fashion-wanita', 'fashion-pria', 'fashion-muslim', 'busana-anak-bayi',
        'sepatu-pria', 'sepatu-wanita', 'sandal-slipper', 'tas-wanita', 'tas-pria',
        'jam-tangan', 'aksesoris-fashion', 'emas-perhiasan', 'fashion-lokal-umkm',
        // Kecantikan & Kesehatan
        'kecantikan-perawatan', 'perawatan-kulit', 'kesehatan', 'kesehatan-herbal', 'ibu-bayi',
        // Rumah & Kehidupan
        'perlengkapan-rumah', 'dapur-masak', 'furnitur', 'dekorasi-rumah',
        'elektronik-rumah', 'peralatan-taman', 'pertukangan',
        // Elektronik & Gadget
        'handphone-aksesoris', 'laptop-aksesoris', 'komputer-komponen',
        'kamera-aksesoris', 'gaming-console', 'fotografi-videografi',
        // Hobi & Gaya Hidup
        'otomotif-mobil', 'otomotif-motor', 'hobi-koleksi', 'olahraga-outdoor',
        'camping-hiking', 'alat-musik', 'buku-alat-tulis',
        // Lainnya
        'software-voucher', 'tiket-travel', 'makanan-minuman', 'bahan-kue-sembako',
        'hewan-peliharaan', 'perlengkapan-sekolah', 'mainan-edukasi',
        'handmade-kerajinan', 'properti-kos', 'jasa-desain', 'jasa-servis',
    ];

    // Mapping kategori utama ke sub-kategori
    private static $categoryGroups = [
        'fashion' => [
            'fashion-wanita', 'fashion-pria', 'fashion-muslim', 'busana-anak-bayi',
            'sepatu-pria', 'sepatu-wanita', 'sandal-slipper', 'tas-wanita', 'tas-pria',
            'jam-tangan', 'aksesoris-fashion', 'emas-perhiasan', 'fashion-lokal-umkm',
        ],
        'kecantikan' => [
            'kecantikan-perawatan', 'perawatan-kulit', 'kesehatan', 'kesehatan-herbal', 'ibu-bayi',
        ],
        'rumah' => [
            'perlengkapan-rumah', 'dapur-masak', 'furnitur', 'dekorasi-rumah',
            'elektronik-rumah', 'peralatan-taman', 'pertukangan',
        ],
        'elektronik' => [
            'handphone-aksesoris', 'laptop-aksesoris', 'komputer-komponen',
            'kamera-aksesoris', 'gaming-console', 'fotografi-videografi',
        ],
        'hobi' => [
            'otomotif-mobil', 'otomotif-motor', 'hobi-koleksi', 'olahraga-outdoor',
            'camping-hiking', 'alat-musik', 'buku-alat-tulis',
        ],
        'lainnya' => [
            'software-voucher', 'tiket-travel', 'makanan-minuman', 'bahan-kue-sembako',
            'hewan-peliharaan', 'perlengkapan-sekolah', 'mainan-edukasi',
            'handmade-kerajinan', 'properti-kos', 'jasa-desain', 'jasa-servis',
        ],
    ];

    public static function getValidCategories()
    {
        return self::$validCategories;
    }

    public static function getCategoryGroups()
    {
        return self::$categoryGroups;
    }

    public static function getSubcategoriesByMainCategory($mainCategory)
    {
        return self::$categoryGroups[$mainCategory] ?? [];
    }

    public function store(Request $request)
    {
        $validCategoriesString = implode(',', self::$validCategories);
        
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:' . $validCategoriesString,
            'description' => 'nullable|string',
            'shop_name'   => 'nullable|string|max:255',
            'condition'   => 'nullable|string|max:50',
            'min_order'   => 'nullable|integer|min:1',
            'showcase'    => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'nullable|integer|min:0',
            'photos'      => 'required|array|min:1',
            'photos.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();

        $product = Product::create([
            'user_id'        => $user->id,
            'name'           => $data['name'],
            'category'       => $data['category'],
            'description'    => $data['description'] ?? null,
            'shop_name'      => $data['shop_name'] ?? $user->shop_name,
            'condition'      => $data['condition'] ?? 'baru',
            'min_order'      => $data['min_order'] ?? 1,
            'showcase'       => $data['showcase'] ?? null,
            'price'          => $data['price'],
            'average_rating' => 0,
            'reviews_count'  => 0,
            'sold_count'     => 0,
            'stock'          => $data['stock'] ?? 0,
        ]);

        foreach ($request->file('photos') as $index => $file) {
            $path = $file->store('products', 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'path'       => $path,
                'is_cover'   => $index === 0,
            ]);
        }

        return redirect()->route('products.show', $product)
            ->with('status', 'Produk berhasil dibuat.');
    }
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
            'name'     => 'required|string|max:120',
            'email'    => 'required|email|max:150',
            'provinsi' => 'nullable|string|max:100',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'required|string|max:1000',
        ]);

        $review = ProductGuestReview::create([
            'product_id' => $product->id,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'provinsi'   => $data['provinsi'] ?? null,
            'rating'     => $data['rating'],
            'comment'    => $data['comment'],
        ]);

        $averageRating = $product->guestReviews()->avg('rating') ?? 0;
        $reviewsCount  = $product->guestReviews()->count();

        $product->update([
            'average_rating' => $averageRating,
            'reviews_count'  => $reviewsCount,
        ]);

        // Kirim email notifikasi ke penjual jika ada seller
        $product->refresh();
        if ($product->seller && $product->seller->email) {
            try {
                Mail::to($product->seller->email)->send(new NewReviewNotificationMail($review, $product));
            } catch (\Exception $e) {
                // Log error tapi tidak gagalkan proses
                \Log::error('Failed to send review notification email: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Terima kasih, ulasanmu sudah tersimpan.');
    }

    /**
     * Tampilkan daftar produk milik seller yang login
     */
    public function sellerIndex(Request $request)
    {
        $user = $request->user();
        
        $query = Product::where('user_id', $user->id)
            ->with('photos')
            ->latest();
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('showcase', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $products = $query->paginate(12);
        
        return view('seller.products.index', compact('products'));
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Request $request, Product $product)
    {
        // Pastikan produk milik seller yang login
        if ($product->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }
        
        $product->load('photos');
        
        return view('seller.products.edit', compact('product'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        // Pastikan produk milik seller yang login
        if ($product->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }
        
        $validCategoriesString = implode(',', self::$validCategories);
        
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:' . $validCategoriesString,
            'description' => 'nullable|string',
            'shop_name'   => 'nullable|string|max:255',
            'condition'   => 'nullable|string|max:50',
            'min_order'   => 'nullable|integer|min:1',
            'showcase'    => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'nullable|integer|min:0',
            'photos'      => 'nullable|array',
            'photos.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:product_photos,id',
        ]);

        $product->update([
            'name'           => $data['name'],
            'category'       => $data['category'],
            'description'    => $data['description'] ?? null,
            'shop_name'      => $data['shop_name'] ?? $request->user()->shop_name,
            'condition'      => $data['condition'] ?? 'baru',
            'min_order'      => $data['min_order'] ?? 1,
            'showcase'       => $data['showcase'] ?? null,
            'price'          => $data['price'],
            'stock'          => $data['stock'] ?? 0,
        ]);

        // Hapus foto yang dipilih
        if (!empty($data['delete_photos'])) {
            $photosToDelete = ProductPhoto::whereIn('id', $data['delete_photos'])
                ->where('product_id', $product->id)
                ->get();
            
            foreach ($photosToDelete as $photo) {
                // Hapus file dari storage
                if (\Storage::disk('public')->exists($photo->path)) {
                    \Storage::disk('public')->delete($photo->path);
                }
                $photo->delete();
            }
        }

        // Upload foto baru
        if ($request->hasFile('photos')) {
            $existingPhotosCount = $product->photos()->count();
            
            foreach ($request->file('photos') as $index => $file) {
                $path = $file->store('products', 'public');

                ProductPhoto::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'is_cover'   => $existingPhotosCount === 0 && $index === 0,
                ]);
                
                $existingPhotosCount++;
            }
        }

        // Pastikan ada foto cover
        $product->refresh();
        if ($product->photos()->where('is_cover', true)->count() === 0) {
            $firstPhoto = $product->photos()->first();
            if ($firstPhoto) {
                $firstPhoto->update(['is_cover' => true]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('status', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy(Request $request, Product $product)
    {
        // Pastikan produk milik seller yang login
        if ($product->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        // Hapus semua foto produk dari storage
        foreach ($product->photos as $photo) {
            if (\Storage::disk('public')->exists($photo->path)) {
                \Storage::disk('public')->delete($photo->path);
            }
        }

        // Hapus produk (photos akan terhapus otomatis karena cascade)
        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('status', 'Produk berhasil dihapus.');
    }
}