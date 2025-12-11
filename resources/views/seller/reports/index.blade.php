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
                    Daftar produk diurutkan berdasarkan jumlah stok secara menurun. Dilengkapi rating, kategori, dan harga.
                </p>
                <ul class="text-xs text-[#4d8199] space-y-1 mb-4">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                        Urutan: Stok tertinggi - terendah
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                        Termasuk: Rating, Kategori, Harga
                    </li>
                </ul>
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
                    Daftar produk diurutkan berdasarkan rating secara menurun. Dilengkapi stok, kategori, dan harga.
                </p>
                <ul class="text-xs text-[#4d8199] space-y-1 mb-4">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                        Urutan: Rating tertinggi - terendah
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                        Termasuk: Stok, Kategori, Harga
                    </li>
                </ul>
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
                <ul class="text-xs text-[#4d8199] space-y-1 mb-4">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-red-500">error</span>
                        Filter: Stok &lt; 2
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                        Termasuk: Rating, Kategori, Harga
                    </li>
                </ul>
                <a href="{{ route('seller.reports.low-stock', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 text-white rounded-xl text-sm font-semibold hover:bg-red-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Unduh PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex gap-4">
            <div class="flex-shrink-0">
                <span class="material-symbols-outlined text-2xl text-blue-600">info</span>
            </div>
            <div>
                <h4 class="font-semibold text-blue-800 mb-1">Tentang Laporan</h4>
                <p class="text-sm text-blue-700">
                    Semua laporan dihasilkan dalam format PDF dengan margin standar surat formal (4cm kiri, 3cm atas/bawah/kanan). 
                    Laporan mencakup informasi nama toko, tanggal pembuatan, dan data produk yang lengkap.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
