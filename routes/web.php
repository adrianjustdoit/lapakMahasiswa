<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminSellerVerificationController;
use App\Http\Controllers\SellerActivationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SellerSettingsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerReportController;
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
    if ($category) {
        $validCategories = \App\Http\Controllers\ProductController::getValidCategories();
        $categoryGroups = \App\Http\Controllers\ProductController::getCategoryGroups();
        
        // Check if it's a main category (fashion, kecantikan, rumah, elektronik, hobi, lainnya)
        if (array_key_exists($category, $categoryGroups)) {
            // Filter by all subcategories in this group
            $subcategories = $categoryGroups[$category];
            $query->whereIn('category', $subcategories);
        } elseif (in_array($category, $validCategories)) {
            // Filter by specific subcategory
            $query->where('category', $category);
        }
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
    // Redirect admin to admin dashboard
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    // Redirect approved seller to seller dashboard
    if (auth()->user()->seller_status === 'approved') {
        return redirect()->route('seller.dashboard');
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
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/chart-data', [AdminDashboardController::class, 'getChartData'])->name('admin.chart-data');
    
    // Admin Reports
    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/reports/seller-status', [AdminReportController::class, 'sellerStatus'])->name('admin.reports.seller-status');
    Route::get('/admin/reports/sellers-by-province', [AdminReportController::class, 'sellersByProvince'])->name('admin.reports.sellers-by-province');
    Route::get('/admin/reports/product-ratings', [AdminReportController::class, 'productRatings'])->name('admin.reports.product-ratings');
    
    // Seller Verification
    Route::get('/admin/sellers', [AdminSellerVerificationController::class, 'index'])->name('admin.sellers.index');
    Route::get('/admin/sellers/{user}', [AdminSellerVerificationController::class, 'show'])->name('admin.sellers.show');
    Route::post('/admin/sellers/{user}/approve', [AdminSellerVerificationController::class, 'approve'])->name('admin.sellers.approve');
    Route::post('/admin/sellers/{user}/reject', [AdminSellerVerificationController::class, 'reject'])->name('admin.sellers.reject');
    
    // Profile update approval
    Route::post('/admin/profile-updates/{update}/approve', [AdminSellerVerificationController::class, 'approveProfileUpdate'])->name('admin.profile-updates.approve');
    Route::post('/admin/profile-updates/{update}/reject', [AdminSellerVerificationController::class, 'rejectProfileUpdate'])->name('admin.profile-updates.reject');
});

// Detail produk
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

// Simpan review tamu (tanpa middleware auth)
Route::post('/products/{product}/reviews', [ProductController::class, 'storeGuestReview'])
    ->name('products.reviews.store');

// Seller: kelola produk (harus login sebagai seller)
Route::middleware(['auth'])->group(function () {
    // Seller Dashboard
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])
        ->name('seller.dashboard');
    Route::get('/seller/chart-data', [SellerDashboardController::class, 'getChartData'])
        ->name('seller.chart-data');
    
    // Seller Reports
    Route::get('/seller/reports', [SellerReportController::class, 'index'])
        ->name('seller.reports.index');
    Route::get('/seller/reports/stock-by-quantity', [SellerReportController::class, 'stockByQuantity'])
        ->name('seller.reports.stock-by-quantity');
    Route::get('/seller/reports/stock-by-rating', [SellerReportController::class, 'stockByRating'])
        ->name('seller.reports.stock-by-rating');
    Route::get('/seller/reports/low-stock', [SellerReportController::class, 'lowStock'])
        ->name('seller.reports.low-stock');
    
    Route::get('/seller/products/create', [ProductController::class, 'create'])
        ->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])
        ->name('seller.products.store');
    Route::get('/seller/products', [ProductController::class, 'sellerIndex'])
        ->name('seller.products.index');
    Route::get('/seller/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('seller.products.edit');
    Route::put('/seller/products/{product}', [ProductController::class, 'update'])
        ->name('seller.products.update');
    Route::delete('/seller/products/{product}', [ProductController::class, 'destroy'])
        ->name('seller.products.destroy');
    
    // Seller settings
    Route::get('/seller/settings', [SellerSettingsController::class, 'index'])
        ->name('seller.settings');
    Route::put('/seller/settings/shop', [SellerSettingsController::class, 'updateShop'])
        ->name('seller.settings.update-shop');
    Route::put('/seller/settings/contact', [SellerSettingsController::class, 'updateContact'])
        ->name('seller.settings.update-contact');
    Route::put('/seller/settings/password', [SellerSettingsController::class, 'updatePassword'])
        ->name('seller.settings.update-password');
    Route::delete('/seller/settings/cancel-update', [SellerSettingsController::class, 'cancelUpdate'])
        ->name('seller.settings.cancel-update');
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
