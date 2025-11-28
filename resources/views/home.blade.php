@extends('layouts.app')

@section('title', 'LapakMahasiswa - Marketplace Mahasiswa')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <header class="flex items-center justify-between py-6">
        <div class="text-3xl font-bold font-display text-[#0e171b] dark:text-white">
            LapakMahasiswa
        </div>
        
        <!-- Search Bar -->
        <div class="relative flex-grow max-w-xl mx-4">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4d8199]">search</span>
            <input 
                class="w-full pl-10 pr-4 py-2 bg-[#e8eef3] dark:bg-[#1a2632] border border-[#d0e0e7] dark:border-gray-700 rounded-lg text-[#0e171b] dark:text-white placeholder-[#4d8199] focus:ring-2 focus:ring-primary focus:ring-opacity-50 focus:border-primary" 
                placeholder="Cari di LapakMahasiswa" 
                type="text"
            />
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-4">
            <button class="relative p-2 text-[#0e171b] dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">0</span>
            </button>
            
            @auth
                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-white">person</span>
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-[#0e171b] dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="material-symbols-outlined mr-2 text-lg">dashboard</span>
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-[#0e171b] dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="material-symbols-outlined mr-2 text-lg">settings</span>
                            Pengaturan
                        </a>
                        <hr class="my-2 border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="material-symbols-outlined mr-2 text-lg">logout</span>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 border border-primary text-primary rounded-full font-semibold hover:bg-primary hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-white rounded-full font-semibold hover:opacity-90 transition-opacity">
                    Daftar
                </a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-8 pb-12">
        <!-- Hero Section -->
        <section class="bg-primary rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between">
            <div class="text-white text-center md:text-left mb-8 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-black font-display">
                    Males Belanja offline?
                </h1>
                <p class="text-2xl md:text-3xl font-bold font-display mt-2">
                    Yuk pakai LapakMahasiswa aja!!!!
                </p>
                <button class="mt-8 px-8 py-3 bg-white text-primary font-semibold rounded-full shadow-md hover:bg-gray-100 transition-colors">
                    Cek Sekarang
                </button>
            </div>
            <div>
                <img 
                    alt="Ilustrasi belanja" 
                    class="w-64 h-auto md:w-96" 
                    src="/images/hero-illustration.png"
                    onerror="this.style.display='none'"
                />
            </div>
        </section>

        <!-- Kategori Pilihan Section -->
        <section class="mt-12 border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-8">
            <h2 class="text-2xl font-bold font-display mb-6 text-[#0e171b] dark:text-white">
                Kategori Pilihan
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 text-center">
                @php
                    $categories = [
                        ['name' => 'Akademik', 'image' => '/images/categories/akademik.png'],
                        ['name' => 'Elektronik', 'image' => '/images/categories/elektronik.png'],
                        ['name' => 'Fashion', 'image' => '/images/categories/fashion.png'],
                        ['name' => 'Makanan', 'image' => '/images/categories/makanan.png'],
                        ['name' => 'Rumahan', 'image' => '/images/categories/rumahan.png'],
                    ];
                @endphp

                @foreach($categories as $category)
                <div class="flex flex-col items-center cursor-pointer group">
                    <div class="w-full aspect-square border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-4 flex items-center justify-center bg-white group-hover:shadow-lg transition-shadow">
                        <img 
                            alt="{{ $category['name'] }}" 
                            class="max-w-full max-h-full object-contain" 
                            src="{{ $category['image'] }}"
                            onerror="this.parentElement.innerHTML='<span class=\'material-symbols-outlined text-6xl text-gray-300\'>category</span>'"
                        />
                    </div>
                    <span class="mt-3 text-lg font-display font-semibold text-[#0e171b] dark:text-white">
                        {{ $category['name'] }}
                    </span>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-[#d0e0e7] dark:border-gray-700">
        <div class="text-center text-[#4d8199] text-sm">
            &copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.
        </div>
    </footer>
</div>

<!-- Alpine.js for dropdown -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
