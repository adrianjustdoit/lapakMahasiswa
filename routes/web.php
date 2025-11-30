<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminSellerVerificationController;
use App\Http\Controllers\SellerActivationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $category = request('category');
    $search = request('search');
    $query = \App\Models\Product::with('seller')->latest();
    
    // Filter by category
    if ($category && in_array($category, ['elektronik', 'fashion', 'makanan', 'akademik', 'rumahan'])) {
        $query->where('category', $category);
    }
    
    // Search by nama produk, nama toko, lokasi (kabupaten/kota, provinsi)
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('shop_name', 'like', "%{$search}%")
              ->orWhereHas('seller', function($sellerQuery) use ($search) {
                  $sellerQuery->where('kota', 'like', "%{$search}%")
                              ->orWhere('provinsi', 'like', "%{$search}%")
                              ->orWhere('shop_name', 'like', "%{$search}%");
              });
        });
    }
    
    $products = $query->take(12)->get();
    $selectedCategory = $category;
    $searchQuery = $search;
    
    return view('home', compact('products', 'selectedCategory', 'searchQuery'));
})->name('home');

Route::get('/dashboard', function () {
    // Redirect admin to admin sellers dashboard
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.sellers.index');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Seller registration (public)
Route::get('/seller/register', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/seller/register', [SellerRegistrationController::class, 'store'])->name('seller.register.store');

// Activation link
Route::get('/seller/activate/{token}', [SellerActivationController::class, 'activate'])->name('seller.activate');

// Admin seller verification
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/sellers', [AdminSellerVerificationController::class, 'index'])->name('admin.sellers.index');
    Route::get('/admin/sellers/{user}', [AdminSellerVerificationController::class, 'show'])->name('admin.sellers.show');
    Route::post('/admin/sellers/{user}/approve', [AdminSellerVerificationController::class, 'approve'])->name('admin.sellers.approve');
    Route::post('/admin/sellers/{user}/reject', [AdminSellerVerificationController::class, 'reject'])->name('admin.sellers.reject');
});

// Detail produk
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

// Simpan review tamu (tanpa middleware auth)
Route::post('/products/{product}/reviews', [ProductController::class, 'storeGuestReview'])
    ->name('products.reviews.store');

// Seller: kelola produk (harus login sebagai seller)
Route::middleware(['auth'])->group(function () {
    Route::get('/seller/products/create', [ProductController::class, 'create'])
        ->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])
        ->name('seller.products.store');
});

// Halaman publik toko (non-login boleh akses)
Route::get('/shops/{user}', [SellerController::class, 'show'])
    ->name('shops.show');

// API Region Indonesia (proxy to avoid CORS)
Route::prefix('api/region')->group(function () {
    Route::get('/provinces', [RegionController::class, 'provinces']);
    Route::get('/regencies/{provinceCode}', [RegionController::class, 'regencies']);
    Route::get('/districts/{regencyCode}', [RegionController::class, 'districts']);
    Route::get('/villages/{districtCode}', [RegionController::class, 'villages']);
});
