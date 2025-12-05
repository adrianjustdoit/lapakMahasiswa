@extends('layouts.seller')

@section('title', 'Lihat Produk')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                Daftar Produk
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola semua produk Anda</p>
        </div>
        <a href="{{ route('seller.products.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
            <span class="material-symbols-outlined text-xl">add</span>
            Tambah Produk
        </a>
    </div>
</div>

@if(session('status'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/20 border border-green-300 dark:border-green-800 text-green-700 dark:text-green-300 rounded-xl flex items-center gap-3">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('status') }}
    </div>
@endif

<!-- Search & Filter -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-6">
    <form action="{{ route('seller.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari nama produk, kategori, etalase..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
                Cari
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('seller.products.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Products Grid -->
@if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($products as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Product Image -->
                <div class="relative aspect-square bg-gray-100 dark:bg-gray-700">
                    @php
                        $coverPhoto = $product->photos->where('is_cover', true)->first() ?? $product->photos->first();
                    @endphp
                    @if($coverPhoto)
                        <img src="{{ asset('storage/' . $coverPhoto->path) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-gray-300 dark:text-gray-600">image</span>
                        </div>
                    @endif
                    
                    <!-- Stock Badge -->
                    @if($product->stock < 1)
                        <div class="absolute top-2 left-2 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                            Habis
                        </div>
                    @elseif($product->stock < 5)
                        <div class="absolute top-2 left-2 px-2 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full">
                            Stok {{ $product->stock }}
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 dark:text-white truncate" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h3>
                    <p class="text-primary font-bold mt-1">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    
                    <div class="flex items-center gap-2 mt-2 text-xs text-gray-500 dark:text-gray-400">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-yellow-500">star</span>
                            {{ number_format($product->average_rating, 1) }}
                        </span>
                        <span>•</span>
                        <span>{{ $product->reviews_count }} ulasan</span>
                        <span>•</span>
                        <span>Stok: {{ $product->stock }}</span>
                    </div>

                    <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs rounded-full">
                            {{ ucfirst(str_replace('-', ' ', $product->category)) }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('seller.products.edit', $product) }}" 
                           class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-opacity">
                            <span class="material-symbols-outlined text-lg">edit</span>
                            Edit
                        </a>
                        <a href="{{ route('products.show', $product) }}" 
                           target="_blank"
                           class="flex items-center justify-center px-3 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </a>
                        <button type="button" 
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                class="flex items-center justify-center px-3 py-2 border border-red-300 dark:border-red-700 text-red-600 dark:text-red-400 text-sm rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>
@else
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
        <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">inventory_2</span>
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Belum Ada Produk</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6">
            @if(request('search'))
                Tidak ada produk yang cocok dengan pencarian "{{ request('search') }}"
            @else
                Mulai tambahkan produk pertama Anda
            @endif
        </p>
        @if(request('search'))
            <a href="{{ route('seller.products.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                Reset Pencarian
            </a>
        @else
            <a href="{{ route('seller.products.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined text-xl">add</span>
                Tambah Produk
            </a>
        @endif
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div id="deleteModal" 
     class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4"
     onclick="if(event.target === this) closeDeleteModal()">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl text-red-500">delete_forever</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Hapus Produk?</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Anda yakin ingin menghapus produk "<span id="deleteProductName" class="font-semibold"></span>"? 
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <form id="deleteForm" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" 
                    onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                Batal
            </button>
            <button type="submit" 
                    class="flex-1 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">
                Ya, Hapus
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(productId, productName) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteProductName');
        
        form.action = `/seller/products/${productId}`;
        nameSpan.textContent = productName;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endpush
