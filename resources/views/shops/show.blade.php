@extends('layouts.app')

@section('title', ($seller->shop_name ?? $seller->name) . ' - Katalog LapakMahasiswa')
@section('content')
<div class="min-h-screen bg-[#f6f7f8] py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <header class="bg-white/95 backdrop-blur rounded-2xl border border-[#d0e0e7] shadow-sm px-6 sm:px-8 py-4 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-bold font-display text-[#0e171b] hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-3xl text-primary/80">storefront</span>
                LapakMahasiswa
            </a>
            <nav class="flex items-center gap-3 text-sm font-semibold text-[#4d8199]">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-full hover:bg-[#f6f7f8] hover:text-primary transition-colors">
                    Beranda
                </a>
                <a href="#produk" class="px-3 py-2 rounded-full hover:bg-[#f6f7f8] hover:text-primary transition-colors">
                    Produk
                </a>
                <a href="#ulasan" class="px-3 py-2 rounded-full hover:bg-[#f6f7f8] hover:text-primary transition-colors">
                    Ulasan
                </a>
            </nav>
        </header>

        <div class="rounded-3xl bg-gradient-to-br from-white via-primary/5 to-primary/10 border border-[#d0e0e7] shadow-xl overflow-hidden">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 px-8 py-10">
                <div class="space-y-3 max-w-2xl">
                    <p class="text-xs font-semibold text-[#4d8199] uppercase tracking-[0.3em]">LapakMahasiswa</p>
                    <h1 class="text-3xl font-black text-[#0e171b]">{{ $seller->shop_name ?? $seller->name }}</h1>
                    <p class="text-sm text-[#4d8199] leading-relaxed">
                        {{ $seller->shop_description ?? 'Belanja langsung dari civitas kampus dengan produk terkurasi dan layanan responsif.' }}
                    </p>
                    <div class="flex flex-wrap gap-3 text-xs text-[#4d8199]">
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/70 border border-[#d0e0e7]">
                            <span class="material-symbols-outlined text-base text-primary">location_on</span>
                            {{ $seller->kota ?? 'Lokasi belum diatur' }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/70 border border-[#d0e0e7]">
                            <span class="material-symbols-outlined text-base text-primary">schedule</span>
                            Bergabung {{ $seller->created_at?->diffForHumans() ?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full lg:w-auto">
                    <div class="min-w-[140px] rounded-2xl border border-white/70 bg-white/70 px-4 py-3 shadow-sm">
                        <p class="text-xs text-[#4d8199]">Produk</p>
                        <p class="text-2xl font-semibold text-[#0e171b]">{{ $totalProductCount }}</p>
                    </div>
                    <div class="min-w-[140px] rounded-2xl border border-white/70 bg-white/70 px-4 py-3 shadow-sm">
                        <p class="text-xs text-[#4d8199]">Rating Rata-rata</p>
                        <p class="text-2xl font-semibold text-[#0e171b] flex items-center gap-1">
                            <span class="material-symbols-outlined text-yellow-400 text-base">star</span>
                            {{ number_format($reviewSummary['average'] ?? 0, 1) }}
                        </p>
                    </div>
                    <div class="min-w-[140px] rounded-2xl border border-white/70 bg-white/70 px-4 py-3 shadow-sm">
                        <p class="text-xs text-[#4d8199]">Kepuasan</p>
                        <p class="text-2xl font-semibold text-[#0e171b]">{{ $reviewSummary['positive'] ?? 0 }}%</p>
                    </div>
                </div>
            </div>
            @if($categoryHighlights->isNotEmpty())
                <div class="relative px-8 pb-6">
                    <div class="flex flex-wrap gap-2">
                        @foreach($categoryHighlights as $category)
                            <span class="inline-flex items-center gap-1 rounded-full bg-white/80 text-xs font-semibold text-[#4d8199] border border-[#d0e0e7] px-3 py-1">
                                <span class="material-symbols-outlined text-xs">sell</span>
                                {{ \Illuminate\Support\Str::headline($category) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] px-4 py-2 overflow-x-auto">
            <nav class="flex gap-6 text-sm font-semibold text-[#4d8199]">
                <a href="#beranda" class="py-3 border-b-2 border-transparent hover:border-primary hover:text-primary">Beranda</a>
                <a href="#produk" class="py-3 border-b-2 border-transparent hover:border-primary hover:text-primary">Produk</a>
                <a href="#ulasan" class="py-3 border-b-2 border-transparent hover:border-primary hover:text-primary">Ulasan</a>
            </nav>
        </div>

        <!-- Beranda / ringkasan -->
        <section id="beranda" class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-[#d0e0e7] bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-semibold text-[#0e171b]">Kesimpulan Ulasan</h2>
                        <p class="text-xs text-[#4d8199]">Dirangkum dari 10 produk terbaru di toko ini</p>
                    </div>
                    <a href="#ulasan" class="text-xs font-semibold text-primary hover:underline">Lihat ulasan</a>
                </div>
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="rounded-2xl bg-[#f6f7f8] px-5 py-4 text-center md:min-w-[180px]">
                        <div class="text-4xl font-extrabold text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-yellow-400 text-3xl mr-1">star</span>
                            {{ number_format($reviewSummary['average'] ?? 0, 1) }}
                        </div>
                        <p class="text-xs text-[#4d8199] mt-1">dari 5.0</p>
                        <p class="text-sm font-semibold text-[#0e171b] mt-2">{{ $reviewSummary['positive'] ?? 0 }}% pembeli puas</p>
                        <p class="text-xs text-[#4d8199]">{{ $reviewSummary['count'] ?? 0 }} ulasan</p>
                    </div>
                    <div class="flex-1 space-y-2">
                        @for($i = 5; $i >= 1; $i--)
                            @php
                                $count = $reviewSummary['breakdown'][$i] ?? 0;
                                $percent = ($reviewSummary['count'] ?? 0) > 0 ? ($count / $reviewSummary['count']) * 100 : 0;
                            @endphp
                            <div class="flex items-center text-xs gap-3">
                                <div class="flex items-center text-yellow-400 w-16">
                                    <span class="material-symbols-outlined text-base">star</span>
                                    <span class="ml-1 text-[#0e171b] font-semibold">{{ $i }}</span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-[#e8eef3] overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-primary to-cyan-400 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-[#4d8199] min-w-[36px] text-right">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-[#d0e0e7] bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-[#0e171b] mb-3">Tentang Toko</h2>
                <ul class="space-y-2 text-sm text-[#4d8199]">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">package_2</span>
                        Total produk aktif: <strong class="text-[#0e171b]">{{ $totalProductCount }}</strong>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">reviews</span>
                        Ulasan terpantau: <strong class="text-[#0e171b]">{{ $reviewSummary['count'] ?? 0 }}</strong>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        Toko aktif sejak: <strong class="text-[#0e171b]">{{ $seller->created_at?->format('d M Y') }}</strong>
                    </li>
                </ul>
                <p class="text-xs text-[#9bb6c4] mt-4">Data diambil otomatis dari aktivitas seller dan ulasan tamu.</p>
            </div>
        </section>

        <!-- Produk -->
        <section id="produk" class="bg-white rounded-3xl shadow-sm border border-[#d0e0e7] p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-[#0e171b]">Produk di Etalase</h2>
                    <p class="text-xs text-[#4d8199]">Menampilkan {{ $products->count() }} produk @if($searchTerm) untuk kata kunci "{{ $searchTerm }}" @endif</p>
                </div>
                <form method="GET" action="{{ route('shops.show', $seller) }}" class="w-full md:w-auto">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $searchTerm }}" placeholder="Cari produk di toko"
                               class="w-full md:w-64 rounded-full border border-[#d0e0e7] bg-[#f6f7f8] py-2 pl-10 pr-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary/40">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#9bb6c4]">search</span>
                    </div>
                </form>
            </div>

            @if($products->isEmpty())
                <div class="rounded-2xl border border-dashed border-[#d0e0e7] py-12 text-center text-[#4d8199]">
                    <span class="material-symbols-outlined text-4xl text-primary/60">styler</span>
                    <p class="font-semibold text-lg text-[#0e171b] mt-2">Belum ada produk ditemukan</p>
                    @if($searchTerm)
                        <p class="text-sm">Coba gunakan kata kunci lain.</p>
                    @else
                        <p class="text-sm">Pemilik toko belum menambahkan produk.</p>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($products as $product)
                        @php
                            $photo = optional($product->photos->first())->path;
                            $photoUrl = $photo ? (str_starts_with($photo, 'images/') ? asset($photo) : asset('storage/'.$photo)) : null;
                            $rating = number_format($product->average_rating ?? 0, 1);
                        @endphp
                        <a href="{{ route('products.show', $product) }}" class="group rounded-2xl border border-transparent bg-[#f6f7f8] hover:border-primary/30 hover:bg-white transition-all duration-200 shadow-sm hover:shadow-lg flex flex-col overflow-hidden">
                            <div class="relative w-full aspect-square bg-white flex items-center justify-center overflow-hidden">
                                @if($photoUrl)
                                    <img src="{{ $photoUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
                                @endif
                                <div class="absolute top-3 left-3 rounded-full bg-white/85 px-3 py-1 text-[11px] font-semibold text-primary shadow">
                                    {{ $product->showcase ?? 'Umum' }}
                                </div>
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-semibold text-sm text-[#0e171b] line-clamp-2 min-h-[2.75rem]">
                                    {{ $product->name }}
                                </h3>
                                <div class="mt-2 text-lg font-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="mt-2 flex items-center text-xs text-[#4d8199]">
                                    <span class="material-symbols-outlined text-yellow-400 text-base mr-1">star</span>
                                    {{ $rating }}
                                    <span class="mx-2 text-[#d0e0e7]">•</span>
                                    Stok {{ $product->stock ?? 0 }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Ulasan -->
        <section id="ulasan" class="bg-white rounded-3xl shadow-sm border border-[#d0e0e7] p-6 space-y-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-xl font-semibold text-[#0e171b]">Ulasan Toko</h2>
                    <p class="text-xs text-[#4d8199]">Rangkuman otomatis dari 10 produk terakhir</p>
                </div>
                <div class="rounded-full bg-[#f6f7f8] px-4 py-2 text-sm text-[#0e171b] flex items-center gap-2">
                    <span class="material-symbols-outlined text-yellow-400">star</span>
                    {{ number_format($reviewSummary['average'] ?? 0, 1) }} / 5.0
                    <span class="text-[#d0e0e7]">•</span>
                    {{ $reviewSummary['count'] ?? 0 }} ulasan
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">
                <div class="rounded-2xl border border-[#d0e0e7] bg-[#f6f7f8] p-5">
                    <p class="text-sm text-[#4d8199]">Skor kebahagiaan pembeli</p>
                    <p class="text-4xl font-extrabold text-primary mt-2">{{ $reviewSummary['positive'] ?? 0 }}%</p>
                    <p class="text-xs text-[#4d8199]">{{ $reviewSummary['count'] ?? 0 }} ulasan dianalisis</p>
                    <div class="mt-4 space-y-2">
                        @for($i = 5; $i >= 1; $i--)
                            @php
                                $count = $reviewSummary['breakdown'][$i] ?? 0;
                                $percent = ($reviewSummary['count'] ?? 0) > 0 ? ($count / $reviewSummary['count']) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-3 text-xs">
                                <span class="w-4 text-[#0e171b]">{{ $i }}</span>
                                <div class="w-full h-2 rounded-full bg-white overflow-hidden">
                                    <div class="h-full bg-primary/70" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-[#4d8199] min-w-[36px] text-right">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-4">
                    @forelse($latestReviews as $review)
                        <div class="rounded-2xl border border-[#d0e0e7] bg-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-[#0e171b]">{{ $review->name }}</p>
                                    <p class="text-xs text-[#4d8199]">{{ optional($review->product)->name }}</p>
                                </div>
                                <span class="text-xs text-[#9bb6c4]">{{ $review->created_at?->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center text-yellow-400 mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-base">
                                        {{ $i <= $review->rating ? 'star' : 'star_border' }}
                                    </span>
                                @endfor
                                @if($review->provinsi)
                                    <span class="ml-2 rounded-full bg-primary/10 px-3 py-0.5 text-xs text-primary">{{ $review->provinsi }}</span>
                                @endif
                            </div>
                            <p class="mt-3 text-sm text-[#0e171b] leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-[#d0e0e7] py-10 text-center text-[#4d8199]">
                            Belum ada ulasan yang masuk. Jadilah pembeli pertama yang berbagi pengalaman.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
