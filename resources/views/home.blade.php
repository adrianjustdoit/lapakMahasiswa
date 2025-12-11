@extends('layouts.app')

@section('title', 'LapakMahasiswa - Marketplace Mahasiswa')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <header class="py-4 md:py-6" x-data="{ mobileMenuOpen: false }">
        <!-- Mobile Header -->
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl md:text-3xl font-bold font-display text-[#0e171b] dark:text-white transition-colors hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/60 rounded-lg px-1" title="Kembali ke beranda">
                <span class="material-symbols-outlined text-2xl md:text-4xl text-primary/80">storefront</span>
                <span class="hidden sm:inline">LapakMahasiswa</span>
                <span class="sm:hidden">Lapak</span>
            </a>
            
            <!-- Desktop: Kategori Mega Menu -->
            <div class="relative hidden lg:block" x-data="{ open: false, activeCategory: null }" @mouseleave="open = false; activeCategory = null">
                <button 
                    @mouseenter="open = true" 
                    class="flex items-center gap-1 px-4 py-2 text-sm font-semibold text-[#0e171b] dark:text-white hover:text-primary transition-colors"
                >
                    <span class="material-symbols-outlined text-lg">category</span>
                    Kategori
                    <span class="material-symbols-outlined text-lg transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                
                <!-- Mega Menu Dropdown - Auto-sized based on content -->
                <div 
                    x-show="open" 
                    x-cloak
                    @mouseenter="open = true"
                    class="absolute left-0 top-full mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-[#d0e0e7] dark:border-gray-700 z-50 overflow-hidden"
                    style="width: clamp(320px, 50vw, 600px);"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                >
                    <div class="flex" style="max-height: clamp(300px, 60vh, 500px);">
                        <!-- Main Categories (Left Side) - Compact -->
                        <div class="w-40 flex-shrink-0 bg-[#f9fafb] dark:bg-gray-900 p-2 border-r border-[#d0e0e7] dark:border-gray-700 overflow-y-auto">
                            <h3 class="text-[10px] font-bold text-[#4d8199] uppercase tracking-wider mb-1.5 px-2">Kategori</h3>
                            
                            <div class="flex flex-col gap-0.5">
                                <div 
                                    @mouseenter="activeCategory = 'fashion'" 
                                    @click="activeCategory = activeCategory === 'fashion' ? null : 'fashion'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'fashion' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">checkroom</span>
                                    <span class="font-medium text-xs">Fashion</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                                
                                <div 
                                    @mouseenter="activeCategory = 'kecantikan'" 
                                    @click="activeCategory = activeCategory === 'kecantikan' ? null : 'kecantikan'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'kecantikan' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">spa</span>
                                    <span class="font-medium text-xs">Kecantikan</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                                
                                <div 
                                    @mouseenter="activeCategory = 'rumah'" 
                                    @click="activeCategory = activeCategory === 'rumah' ? null : 'rumah'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'rumah' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">home</span>
                                    <span class="font-medium text-xs">Rumah</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                                
                                <div 
                                    @mouseenter="activeCategory = 'elektronik'" 
                                    @click="activeCategory = activeCategory === 'elektronik' ? null : 'elektronik'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'elektronik' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">devices</span>
                                    <span class="font-medium text-xs">Elektronik</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                                
                                <div 
                                    @mouseenter="activeCategory = 'hobi'" 
                                    @click="activeCategory = activeCategory === 'hobi' ? null : 'hobi'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'hobi' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">sports_esports</span>
                                    <span class="font-medium text-xs">Hobi</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                                
                                <div 
                                    @mouseenter="activeCategory = 'lainnya'" 
                                    @click="activeCategory = activeCategory === 'lainnya' ? null : 'lainnya'"
                                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                    :class="activeCategory === 'lainnya' ? 'bg-primary text-white' : 'hover:bg-[#e8eef3] dark:hover:bg-gray-800 text-[#0e171b] dark:text-white'"
                                >
                                    <span class="material-symbols-outlined text-sm">more_horiz</span>
                                    <span class="font-medium text-xs">Lainnya</span>
                                    <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sub Categories (Right Side) - Compact & Scrollable -->
                        <div class="flex-1 p-3 overflow-y-auto min-w-0">
                            <!-- Fashion & Aksesoris -->
                            <div x-show="activeCategory === 'fashion'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">checkroom</span>
                                    Fashion & Aksesoris
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'fashion-wanita']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Fashion Wanita</a>
                                    <a href="{{ route('home', ['category' => 'fashion-pria']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Fashion Pria</a>
                                    <a href="{{ route('home', ['category' => 'fashion-muslim']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Fashion Muslim</a>
                                    <a href="{{ route('home', ['category' => 'busana-anak-bayi']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Busana Anak & Bayi</a>
                                    <a href="{{ route('home', ['category' => 'sepatu-pria']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Sepatu Pria</a>
                                    <a href="{{ route('home', ['category' => 'sepatu-wanita']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Sepatu Wanita</a>
                                    <a href="{{ route('home', ['category' => 'sandal-slipper']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Sandal & Slipper</a>
                                    <a href="{{ route('home', ['category' => 'tas-wanita']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Tas Wanita</a>
                                    <a href="{{ route('home', ['category' => 'tas-pria']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Tas Pria</a>
                                    <a href="{{ route('home', ['category' => 'jam-tangan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Jam Tangan</a>
                                    <a href="{{ route('home', ['category' => 'aksesoris-fashion']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Aksesoris Fashion</a>
                                    <a href="{{ route('home', ['category' => 'emas-perhiasan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Emas & Perhiasan</a>
                                    <a href="{{ route('home', ['category' => 'fashion-lokal-umkm']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Fashion Lokal/UMKM</a>
                                </div>
                            </div>
                            
                            <!-- Kecantikan & Kesehatan -->
                            <div x-show="activeCategory === 'kecantikan'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">spa</span>
                                    Kecantikan & Kesehatan
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'kecantikan-perawatan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Kecantikan & Perawatan</a>
                                    <a href="{{ route('home', ['category' => 'perawatan-kulit']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Perawatan Kulit</a>
                                    <a href="{{ route('home', ['category' => 'kesehatan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Kesehatan</a>
                                    <a href="{{ route('home', ['category' => 'kesehatan-herbal']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Kesehatan Herbal</a>
                                    <a href="{{ route('home', ['category' => 'ibu-bayi']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Ibu & Bayi</a>
                                </div>
                            </div>
                            
                            <!-- Rumah & Kehidupan -->
                            <div x-show="activeCategory === 'rumah'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">home</span>
                                    Rumah & Kehidupan
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'perlengkapan-rumah']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Perlengkapan Rumah</a>
                                    <a href="{{ route('home', ['category' => 'dapur-masak']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Dapur & Masak</a>
                                    <a href="{{ route('home', ['category' => 'furnitur']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Furnitur</a>
                                    <a href="{{ route('home', ['category' => 'dekorasi-rumah']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Dekorasi Rumah</a>
                                    <a href="{{ route('home', ['category' => 'elektronik-rumah']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Elektronik Rumah</a>
                                    <a href="{{ route('home', ['category' => 'peralatan-taman']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Taman & Pertanian</a>
                                    <a href="{{ route('home', ['category' => 'pertukangan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Pertukangan</a>
                                </div>
                            </div>
                            
                            <!-- Elektronik & Gadget -->
                            <div x-show="activeCategory === 'elektronik'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">devices</span>
                                    Elektronik & Gadget
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'handphone-aksesoris']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Handphone & Aksesoris</a>
                                    <a href="{{ route('home', ['category' => 'laptop-aksesoris']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Laptop & Aksesoris</a>
                                    <a href="{{ route('home', ['category' => 'komputer-komponen']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Komputer & Komponen</a>
                                    <a href="{{ route('home', ['category' => 'kamera-aksesoris']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Kamera & Aksesoris</a>
                                    <a href="{{ route('home', ['category' => 'gaming-console']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Gaming & Console</a>
                                    <a href="{{ route('home', ['category' => 'fotografi-videografi']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Fotografi & Videografi</a>
                                </div>
                            </div>
                            
                            <!-- Hobi & Gaya Hidup -->
                            <div x-show="activeCategory === 'hobi'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">sports_esports</span>
                                    Hobi & Gaya Hidup
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'otomotif-mobil']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Otomotif Mobil</a>
                                    <a href="{{ route('home', ['category' => 'otomotif-motor']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Otomotif Motor</a>
                                    <a href="{{ route('home', ['category' => 'hobi-koleksi']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Hobi & Koleksi</a>
                                    <a href="{{ route('home', ['category' => 'olahraga-outdoor']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Olahraga & Outdoor</a>
                                    <a href="{{ route('home', ['category' => 'camping-hiking']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Camping & Hiking</a>
                                    <a href="{{ route('home', ['category' => 'alat-musik']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Alat Musik</a>
                                    <a href="{{ route('home', ['category' => 'buku-alat-tulis']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Buku & Alat Tulis</a>
                                </div>
                            </div>
                            
                            <!-- Lainnya -->
                            <div x-show="activeCategory === 'lainnya'">
                                <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">more_horiz</span>
                                    Lainnya
                                </h4>
                                <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                    <a href="{{ route('home', ['category' => 'software-voucher']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Software & Voucher</a>
                                    <a href="{{ route('home', ['category' => 'tiket-travel']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Tiket & Travel</a>
                                    <a href="{{ route('home', ['category' => 'makanan-minuman']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Makanan & Minuman</a>
                                    <a href="{{ route('home', ['category' => 'bahan-kue-sembako']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Bahan Kue & Sembako</a>
                                    <a href="{{ route('home', ['category' => 'hewan-peliharaan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Hewan Peliharaan</a>
                                    <a href="{{ route('home', ['category' => 'perlengkapan-sekolah']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Perlengkapan Sekolah</a>
                                    <a href="{{ route('home', ['category' => 'mainan-edukasi']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Mainan & Edukasi</a>
                                    <a href="{{ route('home', ['category' => 'handmade-kerajinan']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Handmade & Kerajinan</a>
                                    <a href="{{ route('home', ['category' => 'properti-kos']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Properti & Kos</a>
                                    <a href="{{ route('home', ['category' => 'jasa-desain']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Jasa Desain</a>
                                    <a href="{{ route('home', ['category' => 'jasa-servis']) }}" class="text-[11px] text-[#0e171b] dark:text-gray-300 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate">Jasa Servis</a>
                                </div>
                            </div>
                            
                            <!-- Default State -->
                            <div x-show="!activeCategory" class="flex flex-col items-center justify-center h-full text-center py-6">
                                <span class="material-symbols-outlined text-3xl text-[#d0e0e7] mb-2">touch_app</span>
                                <p class="text-xs text-[#4d8199]">Pilih kategori</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Desktop Search Bar -->
            <div class="hidden md:block relative flex-grow max-w-xl mx-4">
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
        <div class="flex items-center space-x-2 md:space-x-4">
            
            @auth
                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 p-1 md:p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-primary rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-lg md:text-xl">person</span>
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
                <!-- Mobile: Compact buttons -->
                <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 md:px-6 py-2 border border-primary text-primary rounded-full font-semibold text-sm hover:bg-primary hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="hidden sm:inline-block px-4 md:px-6 py-2 bg-primary text-white rounded-full font-semibold text-sm hover:opacity-90 transition-opacity">
                    Daftar
                </a>
                
                <!-- Mobile: Hamburger menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden flex items-center justify-center w-10 h-10 bg-[#e8eef3] dark:bg-[#1a2632] border border-[#d0e0e7] dark:border-gray-700 rounded-lg hover:bg-[#dce4eb] dark:hover:bg-[#243442] transition-colors">
                    <span class="material-symbols-outlined text-[#4d8199]" x-show="!mobileMenuOpen">menu</span>
                    <span class="material-symbols-outlined text-[#4d8199]" x-show="mobileMenuOpen" x-cloak>close</span>
                </button>
            @endauth
        </div>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div 
            x-show="mobileMenuOpen" 
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="sm:hidden mt-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-[#d0e0e7] dark:border-gray-700 p-4"
        >
            <!-- Mobile Search -->
            <form action="{{ route('home') }}" method="GET" class="mb-4">
                @if(isset($selectedCategory) && $selectedCategory)
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4d8199]">search</span>
                    <input 
                        name="search"
                        value="{{ $searchQuery ?? '' }}"
                        class="w-full pl-10 pr-4 py-3 bg-[#e8eef3] dark:bg-[#1a2632] border border-[#d0e0e7] dark:border-gray-700 rounded-lg text-[#0e171b] dark:text-white placeholder-[#4d8199] focus:ring-2 focus:ring-primary" 
                        placeholder="Cari produk..." 
                        type="text"
                    />
                </div>
            </form>
            
            <!-- Mobile Categories -->
            <div class="mb-4">
                <h4 class="text-xs font-bold text-[#4d8199] uppercase tracking-wider mb-2">Kategori</h4>
                <div class="grid grid-cols-3 gap-2">
                    <a href="{{ route('home', ['category' => 'fashion']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">checkroom</span>
                        <span class="text-[10px] mt-1 text-center">Fashion</span>
                    </a>
                    <a href="{{ route('home', ['category' => 'kecantikan']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">spa</span>
                        <span class="text-[10px] mt-1 text-center">Kecantikan</span>
                    </a>
                    <a href="{{ route('home', ['category' => 'elektronik']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">devices</span>
                        <span class="text-[10px] mt-1 text-center">Elektronik</span>
                    </a>
                    <a href="{{ route('home', ['category' => 'rumah']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">home</span>
                        <span class="text-[10px] mt-1 text-center">Rumah</span>
                    </a>
                    <a href="{{ route('home', ['category' => 'hobi']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">sports_esports</span>
                        <span class="text-[10px] mt-1 text-center">Hobi</span>
                    </a>
                    <a href="{{ route('home', ['category' => 'lainnya']) }}" class="flex flex-col items-center p-3 bg-[#f6f7f8] dark:bg-gray-700 rounded-lg hover:bg-primary/10">
                        <span class="material-symbols-outlined text-primary text-xl">more_horiz</span>
                        <span class="text-[10px] mt-1 text-center">Lainnya</span>
                    </a>
                </div>
            </div>
            
            <!-- Mobile Auth Buttons -->
            @guest
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="flex-1 py-3 text-center border border-primary text-primary rounded-lg font-semibold hover:bg-primary hover:text-white transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 py-3 text-center bg-primary text-white rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Daftar
                    </a>
                </div>
            @endguest
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-4 md:mt-8 pb-12">
        <!-- Hero Section -->
        <section class="bg-primary rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-12 flex flex-col md:flex-row items-center justify-between">
            <div class="text-white text-center md:text-left mb-4 md:mb-0">
                <h1 class="text-xl sm:text-2xl md:text-4xl font-black font-display">
                    Ingin Belanja Terdekat?
                </h1>
                <p class="text-lg sm:text-xl md:text-3xl font-bold font-display mt-1 md:mt-2">
                    Yuk pakai LapakMahasiswa aja!!!!
                </p>
                <a href="#produk" class="mt-4 md:mt-8 inline-block px-6 md:px-8 py-2 md:py-3 bg-white text-primary font-semibold text-sm md:text-base rounded-full shadow-md hover:bg-gray-100 transition-colors">
                    Cek Sekarang
                </a>
            </div>
            <div class="hidden sm:block">
                <img 
                    alt="Ilustrasi belanja" 
                    class="w-48 md:w-64 lg:w-96 h-auto max-w-full" 
                    src="/images/hero-illustration.png"
                    onerror="this.style.display='none'"
                />
            </div>
        </section>

        <!-- Kategori Section -->
        <section class="mt-6 md:mt-12">
            <div class="flex items-center justify-between mb-4 md:mb-6">
                <h2 class="text-lg md:text-2xl font-bold font-display text-[#0e171b] dark:text-white">
                    Kategori
                </h2>
                @if(isset($selectedCategory) && $selectedCategory)
                    <a href="{{ route('home') }}" class="text-xs md:text-sm text-primary hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-base md:text-lg">close</span>
                        Reset Filter
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 gap-2 md:gap-4">
                <!-- Fashion & Aksesoris -->
                <a href="{{ route('home', ['category' => 'fashion']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'fashion') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'fashion') ? 'bg-primary/20' : 'bg-pink-100 dark:bg-pink-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">checkroom</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Fashion</span>
                </a>
                
                <!-- Kecantikan & Kesehatan -->
                <a href="{{ route('home', ['category' => 'kecantikan']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'kecantikan') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'kecantikan') ? 'bg-primary/20' : 'bg-rose-100 dark:bg-rose-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">spa</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Kecantikan</span>
                </a>
                
                <!-- Rumah & Kehidupan -->
                <a href="{{ route('home', ['category' => 'rumah']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'rumah') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'rumah') ? 'bg-primary/20' : 'bg-orange-100 dark:bg-orange-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">home</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Rumah</span>
                </a>
                
                <!-- Elektronik & Gadget -->
                <a href="{{ route('home', ['category' => 'elektronik']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'elektronik') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'elektronik') ? 'bg-primary/20' : 'bg-blue-100 dark:bg-blue-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">devices</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Elektronik</span>
                </a>
                
                <!-- Hobi & Gaya Hidup -->
                <a href="{{ route('home', ['category' => 'hobi']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'hobi') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'hobi') ? 'bg-primary/20' : 'bg-green-100 dark:bg-green-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">sports_esports</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Hobi</span>
                </a>
                
                <!-- Lainnya -->
                <a href="{{ route('home', ['category' => 'lainnya']) }}" class="flex flex-col items-center p-3 md:p-6 bg-white dark:bg-gray-800 border-2 {{ (isset($selectedCategory) && $selectedCategory === 'lainnya') ? 'border-primary bg-primary/5' : 'border-[#d0e0e7] dark:border-gray-700' }} rounded-xl md:rounded-2xl hover:shadow-lg hover:border-primary transition-all group">
                    <div class="w-10 h-10 md:w-16 md:h-16 {{ (isset($selectedCategory) && $selectedCategory === 'lainnya') ? 'bg-primary/20' : 'bg-purple-100 dark:bg-purple-900/30' }} rounded-full flex items-center justify-center mb-2 md:mb-3 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-xl md:text-3xl text-primary">more_horiz</span>
                    </div>
                    <span class="text-[10px] md:text-xs font-semibold text-[#0e171b] dark:text-white text-center leading-tight">Lainnya</span>
                </a>
            </div>
        </section>

        <!-- Produk Terbaru Section -->
        <section id="produk" class="mt-6 md:mt-12 border border-[#d0e0e7] dark:border-gray-700 rounded-xl md:rounded-2xl p-4 md:p-8">
            <div class="flex items-center justify-between mb-4 md:mb-6">
                <div>
                    <h2 class="text-lg md:text-2xl font-bold font-display text-[#0e171b] dark:text-white">
                        @if(isset($searchQuery) && $searchQuery)
                            Hasil Pencarian "{{ $searchQuery }}"
                        @elseif(isset($selectedCategory) && $selectedCategory)
                            Produk {{ ucfirst($selectedCategory) }}
                        @else
                            Produk Terbaru
                        @endif
                    </h2>
                    @if(isset($searchQuery) && $searchQuery)
                        <a href="{{ route('home', isset($selectedCategory) ? ['category' => $selectedCategory] : []) }}" class="text-xs md:text-sm text-primary hover:underline flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-base md:text-lg">close</span>
                            Hapus pencarian
                        </a>
                    @endif
                </div>
                <span class="text-xs md:text-sm text-[#4d8199]">{{ $products->total() }} produk</span>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-8 md:py-12">
                    <span class="material-symbols-outlined text-4xl md:text-6xl text-gray-300 mb-4">search_off</span>
                    <p class="text-sm md:text-base text-[#4d8199]">
                        @if(isset($searchQuery) && $searchQuery)
                            Tidak ada produk yang cocok dengan pencarian "{{ $searchQuery }}".
                        @else
                            Belum ada produk yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group border border-[#d0e0e7] dark:border-gray-700 rounded-xl md:rounded-2xl overflow-hidden bg-white hover:shadow-lg transition-shadow flex flex-col">
                            <div class="relative w-full aspect-square bg-[#e8eef3] flex items-center justify-center overflow-hidden">
                                @php
                                    $photo = optional($product->photos->first())->path;
                                    // Cek apakah path dimulai dengan 'images/' (public folder) atau perlu storage
                                    $photoUrl = $photo ? (str_starts_with($photo, 'images/') ? asset($photo) : asset('storage/'.$photo)) : null;
                                @endphp
                                @if($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover max-w-full max-h-full">
                                @else
                                    <span class="material-symbols-outlined text-4xl md:text-6xl text-gray-300">image</span>
                                @endif
                            </div>
                            <div class="p-2 md:p-4 flex flex-col flex-1">
                                <h3 class="font-semibold text-xs md:text-base text-[#0e171b] line-clamp-2 min-h-[2rem] md:min-h-[2.5rem]">
                                    {{ $product->name }}
                                </h3>
                                <div class="mt-1 md:mt-2 text-primary font-bold text-sm md:text-lg">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="mt-1 flex items-center text-[10px] md:text-xs text-[#4d8199]">
                                    <span class="material-symbols-outlined text-xs md:text-sm mr-1 text-yellow-400">star</span>
                                    <span>{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                                <div class="mt-1 text-[10px] md:text-xs text-gray-500 truncate">
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

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-8 flex flex-col items-center gap-4">
                        <!-- Info halaman -->
                        <div class="text-sm text-[#4d8199]">
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                        </div>
                        
                        <!-- Tombol navigasi -->
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            {{-- Tombol Previous --}}
                            @if($products->onFirstPage())
                                <span class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 dark:bg-gray-700 dark:text-gray-500 rounded-lg cursor-not-allowed">
                                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    <span class="hidden sm:inline">Sebelumnya</span>
                                </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-[#0e171b] dark:text-white bg-white dark:bg-gray-800 border border-[#d0e0e7] dark:border-gray-600 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    <span class="hidden sm:inline">Sebelumnya</span>
                                </a>
                            @endif

                            {{-- Nomor halaman --}}
                            <div class="flex items-center gap-1">
                                @php
                                    $currentPage = $products->currentPage();
                                    $lastPage = $products->lastPage();
                                    $start = max(1, $currentPage - 2);
                                    $end = min($lastPage, $currentPage + 2);
                                @endphp

                                {{-- Halaman pertama --}}
                                @if($start > 1)
                                    <a href="{{ $products->url(1) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-[#0e171b] dark:text-white bg-white dark:bg-gray-800 border border-[#d0e0e7] dark:border-gray-600 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                        1
                                    </a>
                                    @if($start > 2)
                                        <span class="px-2 text-[#4d8199]">...</span>
                                    @endif
                                @endif

                                {{-- Halaman tengah --}}
                                @for($page = $start; $page <= $end; $page++)
                                    @if($page == $currentPage)
                                        <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-primary rounded-lg shadow-md">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $products->url($page) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-[#0e171b] dark:text-white bg-white dark:bg-gray-800 border border-[#d0e0e7] dark:border-gray-600 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endfor

                                {{-- Halaman terakhir --}}
                                @if($end < $lastPage)
                                    @if($end < $lastPage - 1)
                                        <span class="px-2 text-[#4d8199]">...</span>
                                    @endif
                                    <a href="{{ $products->url($lastPage) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-[#0e171b] dark:text-white bg-white dark:bg-gray-800 border border-[#d0e0e7] dark:border-gray-600 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                        {{ $lastPage }}
                                    </a>
                                @endif
                            </div>

                            {{-- Tombol Next --}}
                            @if($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-[#0e171b] dark:text-white bg-white dark:bg-gray-800 border border-[#d0e0e7] dark:border-gray-600 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
                                    <span class="hidden sm:inline">Selanjutnya</span>
                                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                                </a>
                            @else
                                <span class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 dark:bg-gray-700 dark:text-gray-500 rounded-lg cursor-not-allowed">
                                    <span class="hidden sm:inline">Selanjutnya</span>
                                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
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
