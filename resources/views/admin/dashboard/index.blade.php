@extends('layouts.admin')

@section('title', 'Admin Dashboard - LapakMahasiswa')
@section('page-title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-primary to-[#1a8bc7] rounded-2xl p-6 lg:p-8 mb-8 text-white">
    <h1 class="text-2xl lg:text-3xl font-black font-display">Dashboard Analytics</h1>
    <p class="text-white/80 mt-2">Pantau statistik dan performa platform LapakMahasiswa</p>
</div>

<!-- Quick Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-4 lg:p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center gap-3 lg:gap-4">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary text-xl lg:text-2xl">inventory_2</span>
            </div>
            <div class="min-w-0">
                <p class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">{{ $totalProducts }}</p>
                <p class="text-xs lg:text-sm text-[#4d8199]">Total Produk</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center gap-3 lg:gap-4">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-green-600 text-xl lg:text-2xl">storefront</span>
            </div>
            <div class="min-w-0">
                <p class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">{{ $activeSellers }}</p>
                <p class="text-xs lg:text-sm text-[#4d8199]">Toko Aktif</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center gap-3 lg:gap-4">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-yellow-600 text-xl lg:text-2xl">reviews</span>
            </div>
            <div class="min-w-0">
                <p class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">{{ $totalReviews }}</p>
                <p class="text-xs lg:text-sm text-[#4d8199]">Total Review</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 lg:p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center gap-3 lg:gap-4">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-purple-600 text-xl lg:text-2xl">group</span>
            </div>
            <div class="min-w-0">
                <p class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">{{ $uniqueReviewers }}</p>
                <p class="text-xs lg:text-sm text-[#4d8199]">Pengunjung Review</p>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Produk per Kategori -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold font-display text-[#0e171b]">Sebaran Produk per Kategori</h2>
                <p class="text-sm text-[#4d8199]">Jumlah produk berdasarkan kategori</p>
            </div>
            <span class="material-symbols-outlined text-primary">pie_chart</span>
        </div>
        <div class="h-64">
            <canvas id="categoryChart"></canvas>
        </div>
        <!-- Legend -->
        @php
            $chartColors = [
                '#24aceb', '#1a8bc7', '#0f6a9e', '#064875', '#03364d',
                '#10b981', '#059669', '#047857', '#065f46', '#064e3b',
                '#f59e0b', '#d97706', '#b45309', '#92400e', '#78350f',
                '#ef4444', '#dc2626', '#b91c1c', '#991b1b', '#7f1d1d',
                '#8b5cf6', '#7c3aed', '#6d28d9', '#5b21b6', '#4c1d95'
            ];
        @endphp
        <div class="mt-4 grid grid-cols-2 gap-2 max-h-32 overflow-y-auto">
            @foreach($productsByCategory as $index => $item)
            <div class="flex items-center gap-2 text-xs">
                <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $chartColors[$index % count($chartColors)] }}"></div>
                <span class="text-[#4d8199] truncate">{{ ucwords(str_replace('-', ' ', $item->category)) }}</span>
                <span class="font-semibold text-[#0e171b]">({{ $item->total }})</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Toko per Provinsi -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold font-display text-[#0e171b]">Sebaran Toko per Provinsi</h2>
                <p class="text-sm text-[#4d8199]">Jumlah toko aktif berdasarkan lokasi</p>
            </div>
            <span class="material-symbols-outlined text-primary">map</span>
        </div>
        <div class="h-64">
            <canvas id="provinceChart"></canvas>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Status Penjual -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold font-display text-[#0e171b]">Status Penjual</h2>
                <p class="text-sm text-[#4d8199]">Aktif vs Tidak Aktif</p>
            </div>
            <span class="material-symbols-outlined text-primary">person</span>
        </div>
        <div class="h-64">
            <canvas id="sellerStatusChart"></canvas>
        </div>
        <!-- Status Cards -->
        <div class="mt-4 grid grid-cols-3 gap-3">
            <div class="bg-green-50 rounded-xl p-3 text-center">
                <p class="text-xl lg:text-2xl font-bold text-green-600">{{ $activeSellers }}</p>
                <p class="text-xs text-green-700">Aktif</p>
            </div>
            <div class="bg-yellow-50 rounded-xl p-3 text-center">
                <p class="text-xl lg:text-2xl font-bold text-yellow-600">{{ $pendingSellers }}</p>
                <p class="text-xs text-yellow-700">Pending</p>
            </div>
            <div class="bg-red-50 rounded-xl p-3 text-center">
                <p class="text-xl lg:text-2xl font-bold text-red-600">{{ $rejectedSellers }}</p>
                <p class="text-xs text-red-700">Ditolak</p>
            </div>
        </div>
    </div>

    <!-- Rating Distribution -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7] shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold font-display text-[#0e171b]">Distribusi Rating</h2>
                <p class="text-sm text-[#4d8199]">Rating dari pengunjung</p>
            </div>
            <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-yellow-500">star</span>
                <span class="text-lg font-bold text-[#0e171b]">{{ number_format($averageRating, 1) }}</span>
            </div>
        </div>
        <div class="h-64">
            <canvas id="ratingChart"></canvas>
        </div>
        <!-- Rating Bars -->
        <div class="mt-4 space-y-2">
            @for($i = 5; $i >= 1; $i--)
            @php
                $count = $ratingDistribution[$i] ?? 0;
                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            @endphp
            <div class="flex items-center gap-2 text-sm">
                <span class="w-4 text-[#4d8199]">{{ $i }}</span>
                <span class="material-symbols-outlined text-yellow-500 text-sm">star</span>
                <div class="flex-grow h-2 bg-[#e8eef3] rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-500 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
                <span class="w-8 text-right text-[#0e171b] font-medium">{{ $count }}</span>
            </div>
            @endfor
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-2xl p-6 border border-[#d0e0e7] shadow-sm">
    <h2 class="text-lg font-bold font-display text-[#0e171b] mb-4">Aksi Cepat</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <a href="{{ route('admin.sellers.index') }}" class="flex items-center gap-3 p-4 bg-[#f6f7f8] rounded-xl hover:bg-[#e8eef3] transition-colors group">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-primary group-hover:text-white">verified_user</span>
            </div>
            <div>
                <p class="font-semibold text-[#0e171b]">Verifikasi Seller</p>
                <p class="text-xs text-[#4d8199]">{{ $pendingSellers }} menunggu</p>
            </div>
        </a>

        <a href="{{ route('admin.reports.seller-status', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" class="flex items-center gap-3 p-4 bg-[#f6f7f8] rounded-xl hover:bg-[#e8eef3] transition-colors group">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-500 transition-colors">
                <span class="material-symbols-outlined text-green-600 group-hover:text-white">download</span>
            </div>
            <div>
                <p class="font-semibold text-[#0e171b]">Laporan Seller</p>
                <p class="text-xs text-[#4d8199]">Download PDF</p>
            </div>
        </a>

        <a href="{{ route('admin.reports.sellers-by-province', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" class="flex items-center gap-3 p-4 bg-[#f6f7f8] rounded-xl hover:bg-[#e8eef3] transition-colors group">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                <span class="material-symbols-outlined text-blue-600 group-hover:text-white">download</span>
            </div>
            <div>
                <p class="font-semibold text-[#0e171b]">Laporan Provinsi</p>
                <p class="text-xs text-[#4d8199]">Download PDF</p>
            </div>
        </a>

        <a href="{{ route('admin.reports.product-ratings', ['token' => now()->format('YmdHis') . '-' . substr(md5(uniqid(mt_rand(), true)), 0, 8)]) }}" class="flex items-center gap-3 p-4 bg-[#f6f7f8] rounded-xl hover:bg-[#e8eef3] transition-colors group">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-500 transition-colors">
                <span class="material-symbols-outlined text-yellow-600 group-hover:text-white">download</span>
            </div>
            <div>
                <p class="font-semibold text-[#0e171b]">Laporan Rating</p>
                <p class="text-xs text-[#4d8199]">Download PDF</p>
            </div>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Color palette
    const colors = [
        '#24aceb', '#1a8bc7', '#0f6a9e', '#064875', '#03364d',
        '#10b981', '#059669', '#047857', '#065f46', '#064e3b',
        '#f59e0b', '#d97706', '#b45309', '#92400e', '#78350f',
        '#ef4444', '#dc2626', '#b91c1c', '#991b1b', '#7f1d1d',
        '#8b5cf6', '#7c3aed', '#6d28d9', '#5b21b6', '#4c1d95'
    ];

    // Category Chart (Doughnut)
    const categoryData = @json($productsByCategory);
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: categoryData.map(item => item.category.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())),
            datasets: [{
                data: categoryData.map(item => item.total),
                backgroundColor: colors.slice(0, categoryData.length),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '60%'
        }
    });

    // Province Chart (Bar)
    const provinceData = @json($shopsByProvince);
    new Chart(document.getElementById('provinceChart'), {
        type: 'bar',
        data: {
            labels: provinceData.map(item => item.provinsi ? item.provinsi.substring(0, 15) + (item.provinsi.length > 15 ? '...' : '') : 'N/A'),
            datasets: [{
                label: 'Jumlah Toko',
                data: provinceData.map(item => item.total),
                backgroundColor: '#24aceb',
                borderRadius: 8,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Seller Status Chart (Doughnut)
    new Chart(document.getElementById('sellerStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Pending', 'Ditolak'],
            datasets: [{
                data: [{{ $activeSellers }}, {{ $pendingSellers }}, {{ $rejectedSellers }}],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '65%'
        }
    });

    // Rating Chart (Bar)
    const ratingData = @json($ratingDistribution);
    new Chart(document.getElementById('ratingChart'), {
        type: 'bar',
        data: {
            labels: ['1 ★', '2 ★', '3 ★', '4 ★', '5 ★'],
            datasets: [{
                label: 'Jumlah Review',
                data: Object.values(ratingData),
                backgroundColor: ['#ef4444', '#f97316', '#f59e0b', '#84cc16', '#10b981'],
                borderRadius: 8,
                barThickness: 32
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
