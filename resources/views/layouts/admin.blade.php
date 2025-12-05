<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin - LapakMahasiswa')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#24aceb',
                    },
                    fontFamily: {
                        'display': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'sans': ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-[#f6f7f8]" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden"
             style="display: none;">
        </div>

        <!-- Sidebar (Fixed Position) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#d0e0e7] transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-[#d0e0e7]">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
                        <span class="material-symbols-outlined text-white">store</span>
                    </div>
                    <div>
                        <span class="text-lg font-bold font-display text-[#0e171b]">LapakMahasiswa</span>
                        <span class="block text-xs text-[#4d8199] -mt-1">Admin Panel</span>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-lg hover:bg-gray-100">
                    <span class="material-symbols-outlined text-[#4d8199]">close</span>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="px-3 text-xs font-semibold text-[#4d8199] uppercase tracking-wider mb-3">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200
                          @if(request()->routeIs('admin.dashboard')) bg-primary text-white shadow-lg shadow-primary/30 @else text-[#4d8199] hover:bg-[#e8eef3] hover:text-[#0e171b] @endif">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    Dashboard
                </a>

                <a href="{{ route('admin.sellers.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200
                          @if(request()->routeIs('admin.sellers.*')) bg-primary text-white shadow-lg shadow-primary/30 @else text-[#4d8199] hover:bg-[#e8eef3] hover:text-[#0e171b] @endif">
                    <span class="material-symbols-outlined text-xl">verified_user</span>
                    Verifikasi Seller
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.reports.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200
                          @if(request()->routeIs('admin.reports.*')) bg-primary text-white shadow-lg shadow-primary/30 @else text-[#4d8199] hover:bg-[#e8eef3] hover:text-[#0e171b] @endif">
                    <span class="material-symbols-outlined text-xl">description</span>
                    Laporan
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-[#d0e0e7]">
                <div class="flex items-center gap-3 p-3 bg-[#f6f7f8] rounded-xl">
                    <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-[#0e171b] truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-[#4d8199]">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Logout">
                            <span class="material-symbols-outlined text-xl">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area (dengan margin-left untuk sidebar fixed) -->
        <div class="flex-1 flex flex-col min-w-0 lg:ml-64">
            <!-- Top Bar (Mobile) -->
            <header class="sticky top-0 z-30 bg-white border-b border-[#d0e0e7] lg:hidden">
                <div class="flex items-center justify-between h-16 px-4">
                    <button @click="sidebarOpen = true" class="p-2 rounded-lg hover:bg-gray-100">
                        <span class="material-symbols-outlined text-[#0e171b]">menu</span>
                    </button>
                    <span class="text-lg font-bold font-display text-[#0e171b]">@yield('page-title', 'Admin')</span>
                    <div class="w-10"></div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8 overflow-x-hidden">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
