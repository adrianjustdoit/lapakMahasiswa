<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminSellerVerificationController;
use App\Http\Controllers\SellerActivationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
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
