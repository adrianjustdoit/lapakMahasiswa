<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 selection:bg-sky-500 selection:text-white"
    >
        <!-- Top Bar -->
        <header class="fixed top-0 inset-x-0 z-40 bg-white/90 backdrop-blur border-b border-sky-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-md bg-sky-600"></div>
                    <span class="text-sky-700 font-bold text-lg tracking-tight">Lapak Mahasiswa</span>
                </div>
                <nav v-if="canLogin" class="flex items-center gap-4">
                    <template v-if="$page.props.auth.user">
                        <Link :href="route('dashboard')" class="text-sky-700 hover:text-sky-900 font-semibold">Dashboard</Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')" class="text-sky-700 hover:text-sky-900 font-semibold">Log in</Link>
                        <Link v-if="canRegister" :href="route('register')" class="px-3 py-1.5 rounded-lg bg-sky-600 text-white hover:bg-sky-700 font-semibold">Register</Link>
                    </template>
                </nav>
            </div>
        </header>

        <div class="max-w-7xl mx-auto p-6 lg:p-8 pt-20">
            <!-- Hero Section (custom) -->
            <div class="bg-gradient-to-r from-sky-500 to-sky-600 rounded-2xl px-8 py-14 shadow-xl text-white mb-12 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Lapak Mahasiswa</h1>
                <p class="mt-3 text-sky-100 max-w-3xl mx-auto">Temukan dan jual kebutuhan kampus dengan mudah. Marketplace bernuansa biru ala Tokopedia untuk mahasiswa.</p>
                <div class="mt-6 flex flex-col md:flex-row gap-4 md:items-center">
                    <div class="flex-1 relative max-w-3xl mx-auto">
                        <input type="text" placeholder="Cari produk (contoh: buku akuntansi, kalkulator)" class="w-full rounded-xl border border-sky-300 bg-white/95 px-5 py-3 pr-14 text-sky-800 placeholder-sky-400 shadow focus:outline-none focus:ring-2 focus:ring-white focus:border-white" />
                        <button class="absolute top-1/2 -translate-y-1/2 right-2 bg-sky-700 hover:bg-sky-800 active:bg-sky-900 text-white font-semibold px-4 py-2 rounded-lg shadow">Cari</button>
                    </div>
                    <div class="flex flex-wrap gap-2 justify-center">
                        <span class="px-3 py-1 text-sm rounded-full bg-white/20 backdrop-blur border border-sky-200/40">Buku</span>
                        <span class="px-3 py-1 text-sm rounded-full bg-white/20 backdrop-blur border border-sky-200/40">Elektronik</span>
                        <span class="px-3 py-1 text-sm rounded-full bg-white/20 backdrop-blur border border-sky-200/40">Fashion</span>
                        <span class="px-3 py-1 text-sm rounded-full bg-white/20 backdrop-blur border border-sky-200/40">Aksesoris</span>
                        <span class="px-3 py-1 text-sm rounded-full bg-white/20 backdrop-blur border border-sky-200/40">Lainnya</span>
                    </div>
                </div>
            </div>
            <!-- All Laravel default cards removed -->

            <!-- Footer removed -->
        </div>
    </div>
</template>

<!-- Removed Laravel demo background styles -->
