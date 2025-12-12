@extends('layouts.admin')

@section('title', 'Laporan - LapakMahasiswa Admin')
@section('page-title', 'Laporan')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-primary to-[#1a8bc7] rounded-2xl p-6 lg:p-8 mb-8 text-white">
    <h1 class="text-2xl lg:text-3xl font-black font-display">Pusat Laporan</h1>
    <p class="text-white/80 mt-2">Unduh laporan dalam format PDF untuk keperluan administrasi</p>
</div>

<!-- Report Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-2xl border border-[#d0e0e7] shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-green-600 text-3xl">person_check</span>
            </div>
            <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">Laporan Daftar Akun Penjual Berdasarkan Status</h3>
            
            <div class="border-t border-[#e8eef3] pt-4">
                <a href="{{ route('admin.reports.seller-status', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                    <span class="material-symbols-outlined">download</span>
                    Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#d0e0e7] shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-blue-600 text-3xl">map</span>
            </div>
            <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">Laporan Daftar Toko Berdasarkan Lokasi Propinsi</h3>
            
            <div class="border-t border-[#e8eef3] pt-4">
                <a href="{{ route('admin.reports.sellers-by-province', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                    <span class="material-symbols-outlined">download</span>
                    Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#d0e0e7] shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-yellow-600 text-3xl">star</span>
            </div>
            <h3 class="text-lg font-bold font-display text-[#0e171b] mb-2">Laporan Daftar Produk Berdasarkan Rating</h3>
           
            <div class="border-t border-[#e8eef3] pt-4">
                <a href="{{ route('admin.reports.product-ratings', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" 
                   class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-yellow-600 text-white rounded-xl font-semibold hover:bg-yellow-700 transition-colors">
                    <span class="material-symbols-outlined">download</span>
                    Download PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Info Section -->
<div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-200">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-outlined text-blue-600">lightbulb</span>
        </div>
        <div>
            <h4 class="font-semibold text-blue-900 mb-1">Tips Penggunaan Laporan</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Laporan dihasilkan dalam format PDF yang dapat langsung dicetak</li>
                <li>• Data yang ditampilkan adalah data real-time dari database</li>
                <li>• Setiap laporan menyertakan tanggal dan waktu pembuatan</li>
                <li>• Gunakan laporan untuk keperluan dokumentasi dan evaluasi</li>
            </ul>
        </div>
    </div>
</div>
@endsection
