@extends('layouts.app')

@section('title', 'Detail Penjual - Admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <header class="flex items-center justify-between py-6">
        <a href="{{ url('/') }}" class="text-3xl font-bold font-display text-[#0e171b] dark:text-white">
            LapakMahasiswa
        </a>
        
        <div class="flex items-center space-x-4">
            <span class="text-sm text-[#4d8199]">Admin Panel</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 border border-red-500 text-red-500 rounded-full font-semibold hover:bg-red-500 hover:text-white transition-colors text-sm">
                    <span class="material-symbols-outlined text-lg align-middle mr-1">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-4 pb-12">
        <!-- Back Button -->
        <a href="{{ route('admin.sellers.index') }}" class="inline-flex items-center gap-2 text-primary hover:underline mb-6">
            <span class="material-symbols-outlined">arrow_back</span>
            Kembali ke Dashboard
        </a>

        <!-- Page Title -->
        <div class="bg-primary rounded-2xl p-8 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-3xl">store</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black font-display text-white">{{ $user->shop_name }}</h1>
                    <p class="text-white/80 mt-1">Detail pendaftaran penjual</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Shop & Personal Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shop Information -->
                <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">storefront</span>
                        </div>
                        <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Informasi Toko</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">Nama Toko</p>
                            <p class="text-[#0e171b] dark:text-white font-medium">{{ $user->shop_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">Deskripsi Toko</p>
                            <p class="text-[#0e171b] dark:text-white">{{ $user->shop_description }}</p>
                        </div>
                    </div>
                </section>

                <!-- Personal Information -->
                <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Informasi Penanggung Jawab</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">Nama Lengkap</p>
                            <p class="text-[#0e171b] dark:text-white font-medium">{{ $user->pic_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">No. Telepon</p>
                            <p class="text-[#0e171b] dark:text-white font-medium">{{ $user->pic_phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">Email</p>
                            <p class="text-[#0e171b] dark:text-white font-medium">{{ $user->pic_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[#4d8199] mb-1">No. KTP</p>
                            <p class="text-[#0e171b] dark:text-white font-medium">{{ $user->pic_id_number }}</p>
                        </div>
                    </div>
                </section>

                <!-- Address Information -->
                <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                        </div>
                        <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Alamat</h2>
                    </div>
                    <div class="space-y-2">
                        <p class="text-[#0e171b] dark:text-white">{{ $user->pic_address }}</p>
                        <p class="text-[#4d8199]">RT {{ $user->rt }} / RW {{ $user->rw }}</p>
                        <p class="text-[#4d8199]">Kel. {{ $user->kelurahan }}, Kec. {{ $user->kecamatan }}</p>
                        <p class="text-[#4d8199]">{{ $user->kota }}, {{ $user->provinsi }}</p>
                    </div>
                </section>
            </div>

            <!-- Right Column - Documents & Actions -->
            <div class="space-y-6">
                <!-- Documents -->
                <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">folder</span>
                        </div>
                        <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Dokumen</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-[#4d8199] mb-2">Foto KTP PIC</p>
                            @if($user->pic_id_photo_path)
                                <a href="{{ asset('storage/'.$user->pic_id_photo_path) }}" target="_blank" class="block">
                                    <div class="relative w-full aspect-[4/3] bg-gray-100 dark:bg-gray-800 rounded-lg border border-[#d0e0e7] dark:border-gray-700 overflow-hidden hover:opacity-90 transition-opacity">
                                        <img src="{{ asset('storage/'.$user->pic_id_photo_path) }}" alt="Foto KTP" class="w-full h-full object-contain"/>
                                    </div>
                                </a>
                                <p class="text-xs text-[#4d8199] mt-1">Klik untuk melihat ukuran penuh</p>
                            @else
                                <div class="w-full h-32 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                                    <span class="text-[#4d8199]">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-[#4d8199] mb-2">Foto Diri</p>
                            @if($user->pic_photo_path)
                                <a href="{{ asset('storage/'.$user->pic_photo_path) }}" target="_blank" class="block">
                                    <div class="relative w-full aspect-[3/4] bg-gray-100 dark:bg-gray-800 rounded-lg border border-[#d0e0e7] dark:border-gray-700 overflow-hidden hover:opacity-90 transition-opacity">
                                        <img src="{{ asset('storage/'.$user->pic_photo_path) }}" alt="Foto Diri" class="w-full h-full object-contain"/>
                                    </div>
                                </a>
                                <p class="text-xs text-[#4d8199] mt-1">Klik untuk melihat ukuran penuh</p>
                            @else
                                <div class="w-full h-32 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                                    <span class="text-[#4d8199]">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- Status & Actions -->
                <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">task_alt</span>
                        </div>
                        <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Status & Aksi</h2>
                    </div>

                    @if($user->seller_status === 'pending')
                        <div class="mb-6">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-full text-sm font-semibold">
                                <span class="material-symbols-outlined text-lg">hourglass_empty</span>
                                Menunggu Verifikasi
                            </span>
                        </div>

                        <div class="space-y-4">
                            <form method="POST" action="{{ route('admin.sellers.approve', $user) }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-green-500 text-white rounded-full font-bold hover:bg-green-600 transition-colors">
                                    <span class="material-symbols-outlined">check_circle</span>
                                    Setujui Pendaftaran
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.sellers.reject', $user) }}" class="space-y-3">
                                @csrf
                                <textarea 
                                    name="reason" 
                                    placeholder="Masukkan alasan penolakan..." 
                                    required
                                    class="w-full p-3 border border-[#d0e0e7] dark:border-gray-700 rounded-lg bg-background-light dark:bg-background-dark text-[#0e171b] dark:text-white placeholder:text-[#4d8199] focus:ring-2 focus:ring-red-500/50 focus:border-red-500 resize-none"
                                    rows="3"
                                ></textarea>
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-red-500 text-white rounded-full font-bold hover:bg-red-600 transition-colors">
                                    <span class="material-symbols-outlined">cancel</span>
                                    Tolak Pendaftaran
                                </button>
                            </form>
                        </div>
                    @elseif($user->seller_status === 'approved')
                        <div class="text-center py-4">
                            <span class="inline-flex items-center gap-2 px-6 py-3 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-lg font-bold">
                                <span class="material-symbols-outlined text-2xl">verified</span>
                                Disetujui
                            </span>
                        </div>
                    @elseif($user->seller_status === 'rejected')
                        <div class="text-center py-4">
                            <span class="inline-flex items-center gap-2 px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full text-lg font-bold">
                                <span class="material-symbols-outlined text-2xl">block</span>
                                Ditolak
                            </span>
                            @if($user->rejection_reason)
                                <p class="mt-4 text-sm text-red-600 dark:text-red-400">
                                    <strong>Alasan:</strong> {{ $user->rejection_reason }}
                                </p>
                            @endif
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-[#d0e0e7] dark:border-gray-700">
        <div class="text-center text-[#4d8199] text-sm">
            &copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.
        </div>
    </footer>
</div>
@endsection
