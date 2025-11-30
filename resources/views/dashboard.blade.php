@extends('layouts.app')

@section('title', 'Dashboard - LapakMahasiswa')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary">
                            <span class="material-symbols-outlined text-white text-lg">store</span>
                        </div>
                        <span class="text-xl font-bold text-gray-800 dark:text-white">LapakMahasiswa</span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-primary bg-primary/10 rounded-lg font-medium">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                @if(Auth::user()->seller_status === 'approved')
                <a href="{{ route('seller.settings') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Pengaturan</span>
                </a>
                @endif
                
                @if(Auth::user()->seller_status !== 'approved')
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 mt-4">
                    <a href="{{ route('seller.register') }}" class="flex items-center space-x-3 px-4 py-3 text-green-700 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">storefront</span>
                        <span>Daftar Jadi Penjual</span>
                    </a>
                </div>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Dashboard</h1>
            
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            @php
                $user = Auth::user();
                $products = $user->products()->latest()->get();
            @endphp

            @if($user->seller_status === 'approved')
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Produk Saya</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola katalog produk yang kamu tampilkan.</p>
                    </div>
                    <a href="{{ route('seller.products.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-semibold rounded-full hover:opacity-90">
                        <span class="material-symbols-outlined text-sm mr-1">add</span>
                        Tambah Produk
                    </a>
                </div>

                @if($products->isEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm text-center text-gray-500 dark:text-gray-400">
                        Belum ada produk. Mulai dengan menambahkan produk pertamamu.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col">
                                @php
                                    $photo = optional($product->photos->first())->path;
                                @endphp
                                <div class="w-full aspect-square bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden mb-3 flex items-center justify-center">
                                    @if($photo)
                                        <img src="{{ asset('storage/'.$photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover max-w-full max-h-full">
                                    @else
                                        <span class="material-symbols-outlined text-4xl text-gray-300">image</span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-800 dark:text-white text-sm line-clamp-2 min-h-[2.5rem]">{{ $product->name }}</h3>
                                <p class="mt-1 text-primary font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="mt-1 flex items-center text-xs text-gray-500">
                                    <span class="material-symbols-outlined text-yellow-400 text-xs mr-1">star</span>
                                    {{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }} ulasan)
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Etalase: {{ $product->showcase ?? '-' }}</p>
                                <p class="mt-1 text-xs text-gray-500">Stok: {{ $product->stock ?? 0 }}</p>
                                <a href="{{ route('products.show', $product) }}" class="mt-3 inline-flex items-center text-xs text-primary hover:underline">
                                    Lihat detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Selamat Datang, {{ $user->name }}!</h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Anda login sebagai <span class="font-medium text-primary">{{ $user->email }}</span>.
                    </p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Untuk menampilkan katalog sebagai penjual, silakan daftar terlebih dahulu sebagai penjual.
                    </p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
