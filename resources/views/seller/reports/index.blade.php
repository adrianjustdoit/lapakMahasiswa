@extends('layouts.seller')

@section('title', 'Laporan - LapakMahasiswa')
@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">Laporan Toko</h1>
        <p class="text-[#4d8199] mt-1">Unduh laporan stok dan rating produk dalam format PDF</p>
    </div>

    <!-- Report Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Laporan Stok berdasarkan Jumlah -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-3xl text-blue-600">inventory</span>
                </div>
                <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">
                    Laporan Stok (Urutan Stok)
                </h3>
                <p class="text-sm text-[#4d8199] mb-4">
                    Daftar produk diurutkan berdasarkan jumlah stok secara menurun.
                </p>
                <a href="{{ route('seller.reports.stock-by-quantity', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Unduh PDF
                </a>
            </div>
        </div>

        <!-- Laporan Stok berdasarkan Rating -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-3xl text-yellow-600">star</span>
                </div>
                <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">
                    Laporan Stok (Urutan Rating)
                </h3>
                <p class="text-sm text-[#4d8199] mb-4">
                    Daftar produk diurutkan berdasarkan rating secara menurun.
                </p>
                <a href="{{ route('seller.reports.stock-by-rating', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-yellow-600 text-white rounded-xl text-sm font-semibold hover:bg-yellow-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Unduh PDF
                </a>
            </div>
        </div>

        <!-- Laporan Stok Rendah -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-3xl text-red-600">warning</span>
                </div>
                <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">
                    Stok Harus Dipesan
                </h3>
                <p class="text-sm text-[#4d8199] mb-4">
                    Daftar produk dengan stok kurang dari 2 yang harus segera dipesan ulang.
                </p>
                <a href="{{ route('seller.reports.low-stock', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 text-white rounded-xl text-sm font-semibold hover:bg-red-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
