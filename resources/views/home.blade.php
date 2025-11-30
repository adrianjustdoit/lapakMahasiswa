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
            <form action="{{ route('home') }}" method="GET">
                @if(isset($selectedCategory) && $selectedCategory)
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4d8199]">search</span>
                <input 
                    name="search"
                    value="{{ $searchQuery ?? '' }}"
                    class="w-full pl-10 pr-4 py-2 bg-[#e8eef3] dark:bg-[#1a2632] border border-[#d0e0e7] dark:border-gray-700 rounded-lg text-[#0e171b] dark:text-white placeholder-[#4d8199] focus:ring-2 focus:ring-primary focus:ring-opacity-50 focus:border-primary" 
                    placeholder="Cari produk, toko, atau lokasi..." 
                    type="text"
                />
            </form>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-4">
            
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
                    Ingin Belanja Terdekat?
                </h1>
                <p class="text-2xl md:text-3xl font-bold font-display mt-2">
                    Yuk pakai LapakMahasiswa aja!!!!
                </p>
                <a href="#produk" class="mt-8 inline-block px-8 py-3 bg-white text-primary font-semibold rounded-full shadow-md hover:bg-gray-100 transition-colors">
                    Cek Sekarang
                </a>
            </div>
            <div>
                <img 
                    alt="Ilustrasi belanja" 
                    class="w-64 h-auto md:w-96 max-w-full" 
                    src="/images/hero-illustration.png"
                    onerror="this.style.display='none'"
                />
            </div>
        </section>

        <!-- Kategori Section -->
        <section class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold font-display text-[#0e171b] dark:text-white">
                    Kategori
                </h2>
                @if(isset($selectedCategory) && $selectedCategory)
                    <a href="{{ route('home') }}" class="text-sm text-primary hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-lg">close</span>
                        Reset Filter
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                <!-- Elektronik -->
                <a href="{{ route('home', ['category' => 'elektronik']) }}" class="flex flex-col items-center p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'elektronik') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-16 h-16 {{ (isset($selectedCategory) && $selectedCategory === 'elektronik') ? 'bg-primary/20' : 'bg-blue-100 dark:bg-blue-900/30' }} rounded-full flex items-center justify-center mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-primary">devices</span>
                    </div>
                    <span class="text-sm font-semibold text-[#0e171b] dark:text-white text-center">Elektronik</span>
                </a>
                
                <!-- Fashion -->
                <a href="{{ route('home', ['category' => 'fashion']) }}" class="flex flex-col items-center p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'fashion') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-16 h-16 {{ (isset($selectedCategory) && $selectedCategory === 'fashion') ? 'bg-primary/20' : 'bg-pink-100 dark:bg-pink-900/30' }} rounded-full flex items-center justify-center mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-primary">checkroom</span>
                    </div>
                    <span class="text-sm font-semibold text-[#0e171b] dark:text-white text-center">Fashion</span>
                </a>
                
                <!-- Makanan -->
                <a href="{{ route('home', ['category' => 'makanan']) }}" class="flex flex-col items-center p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'makanan') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-16 h-16 {{ (isset($selectedCategory) && $selectedCategory === 'makanan') ? 'bg-primary/20' : 'bg-orange-100 dark:bg-orange-900/30' }} rounded-full flex items-center justify-center mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-primary">restaurant</span>
                    </div>
                    <span class="text-sm font-semibold text-[#0e171b] dark:text-white text-center">Makanan</span>
                </a>
                
                <!-- Akademik -->
                <a href="{{ route('home', ['category' => 'akademik']) }}" class="flex flex-col items-center p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'akademik') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-16 h-16 {{ (isset($selectedCategory) && $selectedCategory === 'akademik') ? 'bg-primary/20' : 'bg-green-100 dark:bg-green-900/30' }} rounded-full flex items-center justify-center mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-primary">school</span>
                    </div>
                    <span class="text-sm font-semibold text-[#0e171b] dark:text-white text-center">Akademik</span>
                </a>
                
                <!-- Rumahan -->
                <a href="{{ route('home', ['category' => 'rumahan']) }}" class="flex flex-col items-center p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'rumahan') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-16 h-16 {{ (isset($selectedCategory) && $selectedCategory === 'rumahan') ? 'bg-primary/20' : 'bg-purple-100 dark:bg-purple-900/30' }} rounded-full flex items-center justify-center mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-primary">home</span>
                    </div>
                    <span class="text-sm font-semibold text-[#0e171b] dark:text-white text-center">Rumahan</span>
                </a>
            </div>
        </section>

        <!-- Produk Terbaru Section -->
        <section id="produk" class="mt-12 border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold font-display text-[#0e171b] dark:text-white">
                        @if(isset($searchQuery) && $searchQuery)
                            Hasil Pencarian "{{ $searchQuery }}"
                        @elseif(isset($selectedCategory) && $selectedCategory)
                            Produk {{ ucfirst($selectedCategory) }}
                        @else
                            Produk Terbaru
                        @endif
                    </h2>
                    @if(isset($searchQuery) && $searchQuery)
                        <a href="{{ route('home', isset($selectedCategory) ? ['category' => $selectedCategory] : []) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-lg">close</span>
                            Hapus pencarian
                        </a>
                    @endif
                </div>
                <span class="text-sm text-[#4d8199]">{{ $products->count() }} produk</span>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                    <p class="text-[#4d8199]">
                        @if(isset($searchQuery) && $searchQuery)
                            Tidak ada produk yang cocok dengan pencarian "{{ $searchQuery }}".
                        @else
                            Belum ada produk yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group border border-[#d0e0e7] dark:border-gray-700 rounded-2xl overflow-hidden bg-white hover:shadow-lg transition-shadow flex flex-col">
                            <div class="relative w-full aspect-square bg-[#e8eef3] flex items-center justify-center overflow-hidden">
                                @php
                                    $photo = optional($product->photos->first())->path;
                                @endphp
                                @if($photo)
                                    <img src="{{ asset('storage/'.$photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover max-w-full max-h-full">
                                @else
                                    <span class="material-symbols-outlined text-6xl text-gray-300">image</span>
                                @endif
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-semibold text-sm md:text-base text-[#0e171b] line-clamp-2 min-h-[2.5rem]">
                                    {{ $product->name }}
                                </h3>
                                <div class="mt-2 text-primary font-bold text-base md:text-lg">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="mt-1 flex items-center text-xs text-[#4d8199]">
                                    <span class="material-symbols-outlined text-sm mr-1 text-yellow-400">star</span>
                                    <span>{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    {{ $product->shop_name }}
                                    @if($product->seller && ($product->seller->kota || $product->seller->provinsi))
                                        <span class="text-gray-400">•</span>
                                        {{ $product->seller->kota ?? '' }}{{ $product->seller->kota && $product->seller->provinsi ? ', ' : '' }}{{ $product->seller->provinsi ?? '' }}
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
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
