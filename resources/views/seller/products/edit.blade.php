@extends('layouts.seller')

@section('title', 'Edit Produk')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
        <a href="{{ route('seller.products.index') }}" class="hover:text-primary">Produk</a>
        <span class="material-symbols-outlined text-lg">chevron_right</span>
        <span>Edit</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">edit</span>
        Edit Produk
    </h1>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Perbarui informasi produk Anda</p>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">

    @if ($errors->any())
        <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm rounded-lg px-4 py-3">
            <div class="font-semibold mb-1">Ada beberapa error:</div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" required>
        </div>

        <div class="relative" x-data="{ 
            open: false, 
            activeCategory: null, 
            selectedCategory: '{{ old('category', $product->category) }}',
            selectedCategoryLabel: '{{ ucfirst(str_replace('-', ' ', old('category', $product->category))) }}'
        }" @click.away="open = false">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
            <input type="hidden" name="category" :value="selectedCategory">
            
            <!-- Trigger Button -->
            <button 
                type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white dark:bg-gray-700 text-left"
                :class="selectedCategory ? 'text-gray-800 dark:text-white' : 'text-gray-400 dark:text-gray-500'"
            >
                <span x-text="selectedCategory ? selectedCategoryLabel : '-- Pilih Kategori --'"></span>
                <span class="material-symbols-outlined text-lg transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
            </button>
            
            <!-- Mega Dropdown -->
            <div 
                x-show="open" 
                x-cloak
                @mouseleave="open = false; activeCategory = null"
                style="display: none; width: clamp(320px, 100%, 550px);"
                class="absolute left-0 mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 z-50 overflow-hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="flex" style="max-height: clamp(280px, 50vh, 400px);">
                    <!-- Main Categories -->
                    <div class="w-36 flex-shrink-0 bg-gray-50 dark:bg-gray-700/50 p-2 border-r border-gray-200 dark:border-gray-600 overflow-y-auto">
                        <h3 class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5 px-2">Kategori</h3>
                        
                        <div class="flex flex-col gap-0.5">
                            <div 
                                @mouseenter="activeCategory = 'fashion'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'fashion' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">checkroom</span>
                                <span class="font-medium text-xs">Fashion</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>
                            
                            <div 
                                @mouseenter="activeCategory = 'kecantikan'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'kecantikan' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">spa</span>
                                <span class="font-medium text-xs">Kecantikan</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>
                            
                            <div 
                                @mouseenter="activeCategory = 'rumah'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'rumah' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">home</span>
                                <span class="font-medium text-xs">Rumah</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>

                            <div 
                                @mouseenter="activeCategory = 'elektronik'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'elektronik' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">devices</span>
                                <span class="font-medium text-xs">Elektronik</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>
                            
                            <div 
                                @mouseenter="activeCategory = 'hobi'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'hobi' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">sports_esports</span>
                                <span class="font-medium text-xs">Hobi</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>
                            
                            <div 
                                @mouseenter="activeCategory = 'lainnya'"
                                class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg cursor-pointer transition-all"
                                :class="activeCategory === 'lainnya' ? 'bg-primary text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200'"
                            >
                                <span class="material-symbols-outlined text-sm">more_horiz</span>
                                <span class="font-medium text-xs">Lainnya</span>
                                <span class="material-symbols-outlined ml-auto text-xs">chevron_right</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sub Categories -->
                    <div class="flex-1 p-3 overflow-y-auto min-w-0">
                        <!-- Fashion & Aksesoris -->
                        <div x-show="activeCategory === 'fashion'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">checkroom</span>
                                Fashion & Aksesoris
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'fashion-wanita'; selectedCategoryLabel = 'Fashion Wanita'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'fashion-wanita' ? 'bg-primary/10 text-primary font-medium' : ''">Fashion Wanita</button>
                                <button type="button" @click="selectedCategory = 'fashion-pria'; selectedCategoryLabel = 'Fashion Pria'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'fashion-pria' ? 'bg-primary/10 text-primary font-medium' : ''">Fashion Pria</button>
                                <button type="button" @click="selectedCategory = 'fashion-muslim'; selectedCategoryLabel = 'Fashion Muslim'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'fashion-muslim' ? 'bg-primary/10 text-primary font-medium' : ''">Fashion Muslim</button>
                                <button type="button" @click="selectedCategory = 'busana-anak-bayi'; selectedCategoryLabel = 'Busana Anak & Bayi'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'busana-anak-bayi' ? 'bg-primary/10 text-primary font-medium' : ''">Busana Anak & Bayi</button>
                                <button type="button" @click="selectedCategory = 'sepatu-pria'; selectedCategoryLabel = 'Sepatu Pria'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'sepatu-pria' ? 'bg-primary/10 text-primary font-medium' : ''">Sepatu Pria</button>
                                <button type="button" @click="selectedCategory = 'sepatu-wanita'; selectedCategoryLabel = 'Sepatu Wanita'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'sepatu-wanita' ? 'bg-primary/10 text-primary font-medium' : ''">Sepatu Wanita</button>
                                <button type="button" @click="selectedCategory = 'sandal-slipper'; selectedCategoryLabel = 'Sandal & Slipper'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'sandal-slipper' ? 'bg-primary/10 text-primary font-medium' : ''">Sandal & Slipper</button>
                                <button type="button" @click="selectedCategory = 'tas-wanita'; selectedCategoryLabel = 'Tas Wanita'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'tas-wanita' ? 'bg-primary/10 text-primary font-medium' : ''">Tas Wanita</button>
                                <button type="button" @click="selectedCategory = 'tas-pria'; selectedCategoryLabel = 'Tas Pria'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'tas-pria' ? 'bg-primary/10 text-primary font-medium' : ''">Tas Pria</button>
                                <button type="button" @click="selectedCategory = 'jam-tangan'; selectedCategoryLabel = 'Jam Tangan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'jam-tangan' ? 'bg-primary/10 text-primary font-medium' : ''">Jam Tangan</button>
                                <button type="button" @click="selectedCategory = 'aksesoris-fashion'; selectedCategoryLabel = 'Aksesoris Fashion'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'aksesoris-fashion' ? 'bg-primary/10 text-primary font-medium' : ''">Aksesoris Fashion</button>
                                <button type="button" @click="selectedCategory = 'emas-perhiasan'; selectedCategoryLabel = 'Emas & Perhiasan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'emas-perhiasan' ? 'bg-primary/10 text-primary font-medium' : ''">Emas & Perhiasan</button>
                                <button type="button" @click="selectedCategory = 'fashion-lokal-umkm'; selectedCategoryLabel = 'Fashion Lokal/UMKM'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'fashion-lokal-umkm' ? 'bg-primary/10 text-primary font-medium' : ''">Fashion Lokal/UMKM</button>
                            </div>
                        </div>
                        
                        <!-- Kecantikan & Kesehatan -->
                        <div x-show="activeCategory === 'kecantikan'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">spa</span>
                                Kecantikan & Kesehatan
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'kecantikan-perawatan'; selectedCategoryLabel = 'Kecantikan & Perawatan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'kecantikan-perawatan' ? 'bg-primary/10 text-primary font-medium' : ''">Kecantikan & Perawatan</button>
                                <button type="button" @click="selectedCategory = 'perawatan-kulit'; selectedCategoryLabel = 'Perawatan Kulit'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'perawatan-kulit' ? 'bg-primary/10 text-primary font-medium' : ''">Perawatan Kulit</button>
                                <button type="button" @click="selectedCategory = 'kesehatan'; selectedCategoryLabel = 'Kesehatan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'kesehatan' ? 'bg-primary/10 text-primary font-medium' : ''">Kesehatan</button>
                                <button type="button" @click="selectedCategory = 'kesehatan-herbal'; selectedCategoryLabel = 'Kesehatan Herbal'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'kesehatan-herbal' ? 'bg-primary/10 text-primary font-medium' : ''">Kesehatan Herbal</button>
                                <button type="button" @click="selectedCategory = 'ibu-bayi'; selectedCategoryLabel = 'Ibu & Bayi'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'ibu-bayi' ? 'bg-primary/10 text-primary font-medium' : ''">Ibu & Bayi</button>
                            </div>
                        </div>
                        
                        <!-- Rumah & Kehidupan -->
                        <div x-show="activeCategory === 'rumah'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">home</span>
                                Rumah & Kehidupan
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'perlengkapan-rumah'; selectedCategoryLabel = 'Perlengkapan Rumah'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'perlengkapan-rumah' ? 'bg-primary/10 text-primary font-medium' : ''">Perlengkapan Rumah</button>
                                <button type="button" @click="selectedCategory = 'dapur-masak'; selectedCategoryLabel = 'Dapur & Masak'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'dapur-masak' ? 'bg-primary/10 text-primary font-medium' : ''">Dapur & Masak</button>
                                <button type="button" @click="selectedCategory = 'furnitur'; selectedCategoryLabel = 'Furnitur'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'furnitur' ? 'bg-primary/10 text-primary font-medium' : ''">Furnitur</button>
                                <button type="button" @click="selectedCategory = 'dekorasi-rumah'; selectedCategoryLabel = 'Dekorasi Rumah'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'dekorasi-rumah' ? 'bg-primary/10 text-primary font-medium' : ''">Dekorasi Rumah</button>
                                <button type="button" @click="selectedCategory = 'elektronik-rumah'; selectedCategoryLabel = 'Elektronik Rumah'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'elektronik-rumah' ? 'bg-primary/10 text-primary font-medium' : ''">Elektronik Rumah</button>
                                <button type="button" @click="selectedCategory = 'peralatan-taman'; selectedCategoryLabel = 'Taman & Pertanian'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'peralatan-taman' ? 'bg-primary/10 text-primary font-medium' : ''">Taman & Pertanian</button>
                                <button type="button" @click="selectedCategory = 'pertukangan'; selectedCategoryLabel = 'Pertukangan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'pertukangan' ? 'bg-primary/10 text-primary font-medium' : ''">Pertukangan</button>
                            </div>
                        </div>
                        
                        <!-- Elektronik & Gadget -->
                        <div x-show="activeCategory === 'elektronik'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">devices</span>
                                Elektronik & Gadget
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'handphone-aksesoris'; selectedCategoryLabel = 'Handphone & Aksesoris'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'handphone-aksesoris' ? 'bg-primary/10 text-primary font-medium' : ''">Handphone & Aksesoris</button>
                                <button type="button" @click="selectedCategory = 'laptop-aksesoris'; selectedCategoryLabel = 'Laptop & Aksesoris'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'laptop-aksesoris' ? 'bg-primary/10 text-primary font-medium' : ''">Laptop & Aksesoris</button>
                                <button type="button" @click="selectedCategory = 'komputer-komponen'; selectedCategoryLabel = 'Komputer & Komponen'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'komputer-komponen' ? 'bg-primary/10 text-primary font-medium' : ''">Komputer & Komponen</button>
                                <button type="button" @click="selectedCategory = 'kamera-aksesoris'; selectedCategoryLabel = 'Kamera & Aksesoris'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'kamera-aksesoris' ? 'bg-primary/10 text-primary font-medium' : ''">Kamera & Aksesoris</button>
                                <button type="button" @click="selectedCategory = 'gaming-console'; selectedCategoryLabel = 'Gaming & Console'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'gaming-console' ? 'bg-primary/10 text-primary font-medium' : ''">Gaming & Console</button>
                                <button type="button" @click="selectedCategory = 'fotografi-videografi'; selectedCategoryLabel = 'Fotografi & Videografi'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'fotografi-videografi' ? 'bg-primary/10 text-primary font-medium' : ''">Fotografi & Videografi</button>
                            </div>
                        </div>
                        
                        <!-- Hobi & Gaya Hidup -->
                        <div x-show="activeCategory === 'hobi'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">sports_esports</span>
                                Hobi & Gaya Hidup
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'otomotif-mobil'; selectedCategoryLabel = 'Otomotif Mobil'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'otomotif-mobil' ? 'bg-primary/10 text-primary font-medium' : ''">Otomotif Mobil</button>
                                <button type="button" @click="selectedCategory = 'otomotif-motor'; selectedCategoryLabel = 'Otomotif Motor'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'otomotif-motor' ? 'bg-primary/10 text-primary font-medium' : ''">Otomotif Motor</button>
                                <button type="button" @click="selectedCategory = 'hobi-koleksi'; selectedCategoryLabel = 'Hobi & Koleksi'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'hobi-koleksi' ? 'bg-primary/10 text-primary font-medium' : ''">Hobi & Koleksi</button>
                                <button type="button" @click="selectedCategory = 'olahraga-outdoor'; selectedCategoryLabel = 'Olahraga & Outdoor'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'olahraga-outdoor' ? 'bg-primary/10 text-primary font-medium' : ''">Olahraga & Outdoor</button>
                                <button type="button" @click="selectedCategory = 'camping-hiking'; selectedCategoryLabel = 'Camping & Hiking'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'camping-hiking' ? 'bg-primary/10 text-primary font-medium' : ''">Camping & Hiking</button>
                                <button type="button" @click="selectedCategory = 'alat-musik'; selectedCategoryLabel = 'Alat Musik'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'alat-musik' ? 'bg-primary/10 text-primary font-medium' : ''">Alat Musik</button>
                                <button type="button" @click="selectedCategory = 'buku-alat-tulis'; selectedCategoryLabel = 'Buku & Alat Tulis'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'buku-alat-tulis' ? 'bg-primary/10 text-primary font-medium' : ''">Buku & Alat Tulis</button>
                            </div>
                        </div>
                        
                        <!-- Lainnya -->
                        <div x-show="activeCategory === 'lainnya'">
                            <h4 class="text-xs font-bold text-primary mb-2 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">more_horiz</span>
                                Lainnya
                            </h4>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                                <button type="button" @click="selectedCategory = 'software-voucher'; selectedCategoryLabel = 'Software & Voucher'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'software-voucher' ? 'bg-primary/10 text-primary font-medium' : ''">Software & Voucher</button>
                                <button type="button" @click="selectedCategory = 'tiket-travel'; selectedCategoryLabel = 'Tiket & Travel'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'tiket-travel' ? 'bg-primary/10 text-primary font-medium' : ''">Tiket & Travel</button>
                                <button type="button" @click="selectedCategory = 'makanan-minuman'; selectedCategoryLabel = 'Makanan & Minuman'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'makanan-minuman' ? 'bg-primary/10 text-primary font-medium' : ''">Makanan & Minuman</button>
                                <button type="button" @click="selectedCategory = 'bahan-kue-sembako'; selectedCategoryLabel = 'Bahan Kue & Sembako'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'bahan-kue-sembako' ? 'bg-primary/10 text-primary font-medium' : ''">Bahan Kue & Sembako</button>
                                <button type="button" @click="selectedCategory = 'hewan-peliharaan'; selectedCategoryLabel = 'Hewan Peliharaan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'hewan-peliharaan' ? 'bg-primary/10 text-primary font-medium' : ''">Hewan Peliharaan</button>
                                <button type="button" @click="selectedCategory = 'perlengkapan-sekolah'; selectedCategoryLabel = 'Perlengkapan Sekolah'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'perlengkapan-sekolah' ? 'bg-primary/10 text-primary font-medium' : ''">Perlengkapan Sekolah</button>
                                <button type="button" @click="selectedCategory = 'mainan-edukasi'; selectedCategoryLabel = 'Mainan & Edukasi'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'mainan-edukasi' ? 'bg-primary/10 text-primary font-medium' : ''">Mainan & Edukasi</button>
                                <button type="button" @click="selectedCategory = 'handmade-kerajinan'; selectedCategoryLabel = 'Handmade & Kerajinan'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'handmade-kerajinan' ? 'bg-primary/10 text-primary font-medium' : ''">Handmade & Kerajinan</button>
                                <button type="button" @click="selectedCategory = 'properti-kos'; selectedCategoryLabel = 'Properti & Kos'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'properti-kos' ? 'bg-primary/10 text-primary font-medium' : ''">Properti & Kos</button>
                                <button type="button" @click="selectedCategory = 'jasa-desain'; selectedCategoryLabel = 'Jasa Desain'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'jasa-desain' ? 'bg-primary/10 text-primary font-medium' : ''">Jasa Desain</button>
                                <button type="button" @click="selectedCategory = 'jasa-servis'; selectedCategoryLabel = 'Jasa Servis'; open = false" class="text-left text-[11px] text-gray-800 dark:text-gray-200 hover:text-primary hover:bg-primary/5 px-1.5 py-1 rounded transition-colors truncate" :class="selectedCategory === 'jasa-servis' ? 'bg-primary/10 text-primary font-medium' : ''">Jasa Servis</button>
                            </div>
                        </div>
                        
                        <!-- Default State -->
                        <div x-show="!activeCategory" class="flex flex-col items-center justify-center h-full text-center py-6">
                            <span class="material-symbols-outlined text-3xl text-gray-300 dark:text-gray-600 mb-2">touch_app</span>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Pilih kategori</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Toko</label>
                <input type="text" name="shop_name" value="{{ old('shop_name', $product->shop_name) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kondisi</label>
                <select name="condition" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                    <option value="baru" {{ old('condition', $product->condition) === 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="bekas" {{ old('condition', $product->condition) === 'bekas' ? 'selected' : '' }}>Bekas</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min. Order</label>
                <input type="number" name="min_order" value="{{ old('min_order', $product->min_order) }}" min="1" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Etalase</label>
                <input type="text" name="showcase" value="{{ old('showcase', $product->showcase) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" placeholder="Misal: MICROPHONE CABLE">
            </div>
        </div>

        <!-- Existing Photos -->
        @if($product->photos->count() > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Saat Ini</label>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Centang foto yang ingin dihapus</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($product->photos as $photo)
                        @php
                            $photoUrl = str_starts_with($photo->path, 'images/') ? asset($photo->path) : asset('storage/' . $photo->path);
                        @endphp
                        <div class="relative aspect-square rounded-xl overflow-hidden border-2 border-gray-200 dark:border-gray-600 group">
                            <img src="{{ $photoUrl }}" alt="Photo" class="w-full h-full object-cover">
                            
                            @if($photo->is_cover)
                                <div class="absolute top-2 left-2 px-2 py-1 bg-primary text-white text-xs font-bold rounded-full">
                                    Utama
                                </div>
                            @endif
                            
                            <!-- Delete Checkbox -->
                            <label class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 transition-all cursor-pointer">
                                <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="w-6 h-6 rounded border-2 border-white text-red-500 focus:ring-red-500 focus:ring-offset-0 opacity-0 group-hover:opacity-100 transition-opacity">
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Add New Photos -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tambah Foto Baru</label>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Pilih foto tambahan (opsional). Max 2MB per foto.</p>
            
            <!-- Photo Upload Area -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3" id="photo-container">
                <!-- Add Photo Button -->
                <label id="add-photo-btn" class="relative flex flex-col items-center justify-center w-full aspect-square border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 hover:border-primary transition-all duration-200">
                    <div class="flex flex-col items-center justify-center text-center p-4">
                        <span class="material-symbols-outlined text-3xl text-gray-500 dark:text-gray-400 mb-2">add_photo_alternate</span>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Tambah Foto</p>
                    </div>
                    <input type="file" name="photos[]" multiple accept="image/*" class="hidden" id="photo-input" onchange="handlePhotoUpload(this)">
                </label>
            </div>
            
            <!-- Photo Preview Template (hidden) -->
            <template id="photo-preview-template">
                <div class="photo-preview relative w-full aspect-square rounded-xl overflow-hidden border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 group">
                    <!-- Loading State -->
                    <div class="loading-state absolute inset-0 flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-700">
                        <div class="w-10 h-10 border-3 border-primary border-t-transparent rounded-full animate-spin mb-2"></div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Memproses...</p>
                    </div>
                    <!-- Success State -->
                    <div class="success-state hidden absolute inset-0">
                        <img src="" alt="Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-200"></div>
                        <!-- Delete Button -->
                        <button type="button" class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600" onclick="removePhoto(this)">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('seller.products.index') }}" class="px-4 py-2 text-sm rounded-full border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
            <button type="submit" class="px-5 py-2 text-sm rounded-full bg-primary text-white font-semibold hover:opacity-90">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    .border-3 {
        border-width: 3px;
    }
</style>
@endpush

@push('scripts')
<script>
    let uploadedFiles = [];
    const photoContainer = document.getElementById('photo-container');
    const addPhotoBtn = document.getElementById('add-photo-btn');
    const photoInput = document.getElementById('photo-input');
    const template = document.getElementById('photo-preview-template');

    function handlePhotoUpload(input) {
        const files = Array.from(input.files);
        
        files.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;
            if (file.size > 2 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 2MB.`);
                return;
            }

            // Create preview element from template
            const preview = template.content.cloneNode(true).querySelector('.photo-preview');
            
            // Insert before add button
            photoContainer.insertBefore(preview, addPhotoBtn);

            // Read and display image
            const reader = new FileReader();
            reader.onload = function(e) {
                setTimeout(() => {
                    const loadingState = preview.querySelector('.loading-state');
                    const successState = preview.querySelector('.success-state');
                    const img = successState.querySelector('img');

                    // Set image source
                    img.src = e.target.result;

                    // Hide loading, show success
                    loadingState.classList.add('hidden');
                    successState.classList.remove('hidden');

                    // Store file reference
                    uploadedFiles.push({
                        file: file,
                        element: preview
                    });

                }, 300 + (index * 100));
            };
            reader.readAsDataURL(file);
        });

        // Clear input to allow re-selecting same files
        input.value = '';
    }

    function removePhoto(button) {
        const preview = button.closest('.photo-preview');
        const index = uploadedFiles.findIndex(item => item.element === preview);
        
        if (index > -1) {
            uploadedFiles.splice(index, 1);
        }

        // Animate removal
        preview.style.transform = 'scale(0.8)';
        preview.style.opacity = '0';
        preview.style.transition = 'all 0.2s ease-out';
        
        setTimeout(() => {
            preview.remove();
            updateFormData();
        }, 200);
    }

    function updateFormData() {
        // Create a new DataTransfer to hold the files
        const dataTransfer = new DataTransfer();
        uploadedFiles.forEach(item => {
            dataTransfer.items.add(item.file);
        });
        
        // Update the input files
        photoInput.files = dataTransfer.files;
    }

    // Update form data before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        updateFormData();
    });
</script>
@endpush
