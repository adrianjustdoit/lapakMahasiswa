<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Penjual - LapakMahasiswa</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#24aceb",
                        "background-light": "#f6f7f8",
                        "background-dark": "#111c21",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="font-display">
    <div class="relative flex min-h-screen w-full bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <!-- Left Panel - Fixed/Sticky -->
        <div class="hidden md:flex md:w-[40%] fixed inset-y-0 left-0 flex-col items-start justify-center p-12 bg-primary text-white">
            <a href="{{ url('/') }}" class="absolute top-12 left-12 flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20">
                            <span class="material-symbols-outlined text-white text-2xl">store</span>
                        </div>
                        <p class="text-xl font-bold">LapakMahasiswa</p>
                    </a>
                    <div class="flex flex-col gap-8">
                        <div class="flex flex-col gap-4">
                            <h1 class="text-5xl font-black leading-tight tracking-tighter">Mulai Jualan Bersama Kami</h1>
                            <p class="text-base font-normal text-white/80 max-w-md">Bergabunglah dengan ribuan mahasiswa lain dan mulailah perjalanan wirausaha Anda di platform terpercaya untuk komunitas kampus.</p>
                        </div>
                        <div class="flex flex-col gap-5">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                                    <span class="material-symbols-outlined text-white text-2xl">card_giftcard</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Gratis Pendaftaran</h3>
                                    <p class="text-sm text-white/70">Tanpa biaya pendaftaran atau biaya tersembunyi.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                                    <span class="material-symbols-outlined text-white text-2xl">groups</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Jangkauan Luas</h3>
                                    <p class="text-sm text-white/70">Jangkau ribuan mahasiswa di seluruh kampus.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                                    <span class="material-symbols-outlined text-white text-2xl">dashboard</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Mudah Dikelola</h3>
                                    <p class="text-sm text-white/70">Dashboard penjual yang intuitif dan mudah digunakan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- Right Panel -->
        <div class="w-full md:w-[60%] md:ml-[40%] min-h-screen flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-20 xl:px-32 2xl:px-48 bg-background-light dark:bg-background-dark">
            <div class="w-full max-w-2xl">
                <div class="flex flex-col gap-3 mb-8">
                    <h2 class="text-[#0e171b] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Daftar Sebagai Penjual</h2>
                    <p class="text-[#4d8199] dark:text-gray-400 text-base font-normal leading-normal">Isi formulir di bawah ini untuk memulai</p>
                </div>

                <!-- Status Messages -->
                @if(session('status'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 rounded-lg">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 rounded-lg">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined">error</span>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.register.store') }}" enctype="multipart/form-data" class="flex flex-col gap-6">
                    @csrf
                    <!-- Shop Information -->
                    <div>
                        <h3 class="text-[#0e171b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Informasi Toko</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Nama Toko<span class="text-red-500">*</span></p>
                                <input name="shop_name" value="{{ old('shop_name') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="Masukkan nama toko Anda" required="" type="text"/>
                            </label>
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Deskripsi Singkat Toko<span class="text-red-500">*</span></p>
                                <textarea name="shop_description" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary min-h-28 placeholder:text-[#4d8199] p-4 text-base font-normal leading-normal" placeholder="Jelaskan sedikit tentang toko Anda" required="">{{ old('shop_description') }}</textarea>
                            </label>
                        </div>
                    </div>
                    <!-- Responsible Person Information -->
                    <div>
                        <h3 class="text-[#0e171b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Informasi Penanggung Jawab</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Nama Lengkap<span class="text-red-500">*</span></p>
                                <input name="pic_name" value="{{ old('pic_name') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="Nama lengkap Anda" required="" type="text"/>
                            </label>
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">No. Telepon<span class="text-red-500">*</span></p>
                                <input name="pic_phone" value="{{ old('pic_phone') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="08123456789" required="" type="tel"/>
                            </label>
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Email<span class="text-red-500">*</span></p>
                                <input name="pic_email" value="{{ old('pic_email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="email@contoh.com" required="" type="email"/>
                            </label>
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">No. KTP<span class="text-red-500">*</span></p>
                                <input name="pic_id_number" value="{{ old('pic_id_number') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="3171234567890001" required="" type="text"/>
                            </label>
                        </div>
                    </div>
                    <!-- Full Address -->
                    <div>
                        <h3 class="text-[#0e171b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Alamat Lengkap</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Alamat<span class="text-red-500">*</span></p>
                                <input name="pic_address" value="{{ old('pic_address') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="Nama Jalan, No. Rumah" required="" type="text"/>
                            </label>
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">RT</p>
                                <input name="rt" value="{{ old('rt') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="001" type="text"/>
                            </label>
                            <label class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">RW</p>
                                <input name="rw" value="{{ old('rw') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="001" type="text"/>
                            </label>
                            <!-- Provinsi Dropdown -->
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Provinsi<span class="text-red-500">*</span></p>
                                <div class="relative">
                                    <select id="provinsi-select" name="provinsi" required class="form-select flex w-full min-w-0 flex-1 rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 px-4 text-base font-normal leading-normal appearance-none cursor-pointer">
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <span class="material-symbols-outlined text-xl" id="provinsi-icon">expand_more</span>
                                    </div>
                                </div>
                                <input type="hidden" id="provinsi-hidden" name="provinsi_name" value="{{ old('provinsi') }}">
                            </label>
                            <!-- Kabupaten/Kota Dropdown -->
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Kabupaten/Kota<span class="text-red-500">*</span></p>
                                <div class="relative">
                                    <select id="kota-select" name="kota" required disabled class="form-select flex w-full min-w-0 flex-1 rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 px-4 text-base font-normal leading-normal appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                        <option value="">-- Pilih Kabupaten/Kota --</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <span class="material-symbols-outlined text-xl" id="kota-icon">expand_more</span>
                                    </div>
                                </div>
                            </label>
                            <!-- Kecamatan Dropdown -->
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Kecamatan<span class="text-red-500">*</span></p>
                                <div class="relative">
                                    <select id="kecamatan-select" name="kecamatan" required disabled class="form-select flex w-full min-w-0 flex-1 rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 px-4 text-base font-normal leading-normal appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <span class="material-symbols-outlined text-xl" id="kecamatan-icon">expand_more</span>
                                    </div>
                                </div>
                            </label>
                            <!-- Kelurahan Dropdown -->
                            <label class="flex flex-col sm:col-span-2">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Kelurahan</p>
                                <div class="relative">
                                    <select id="kelurahan-select" name="kelurahan" disabled class="form-select flex w-full min-w-0 flex-1 rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 px-4 text-base font-normal leading-normal appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <span class="material-symbols-outlined text-xl" id="kelurahan-icon">expand_more</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <!-- Upload Documents -->
                    <div>
                        <h3 class="text-[#0e171b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Upload Dokumen</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Foto KTP PIC<span class="text-red-500">*</span></p>
                                <div class="w-full">
                                    <label id="ktp-label" class="flex flex-col items-center justify-center w-full h-40 border-2 border-[#d0e0e7] dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-background-dark/50 hover:bg-gray-100 dark:hover:bg-gray-800 overflow-hidden relative" for="dropzone-file-ktp">
                                        <div id="ktp-placeholder" class="flex flex-col items-center justify-center py-5">
                                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 mb-2 text-4xl">cloud_upload</span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
                                            <p class="text-xs text-gray-400 mt-1">JPG, PNG max 2MB</p>
                                        </div>
                                        <img id="ktp-preview" class="hidden w-full h-full object-cover absolute inset-0" alt="Preview KTP"/>
                                        <input class="hidden" id="dropzone-file-ktp" name="pic_id_photo" required="" type="file" accept="image/*" onchange="previewImage(this, 'ktp-preview', 'ktp-placeholder')"/>
                                    </label>
                                    <p id="ktp-filename" class="text-xs text-gray-500 mt-1 truncate"></p>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Foto Diri PIC<span class="text-red-500">*</span></p>
                                <div class="w-full">
                                    <label id="pic-label" class="flex flex-col items-center justify-center w-full h-40 border-2 border-[#d0e0e7] dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-background-dark/50 hover:bg-gray-100 dark:hover:bg-gray-800 overflow-hidden relative" for="dropzone-file-pic">
                                        <div id="pic-placeholder" class="flex flex-col items-center justify-center py-5">
                                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 mb-2 text-4xl">cloud_upload</span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
                                            <p class="text-xs text-gray-400 mt-1">JPG, PNG max 2MB</p>
                                        </div>
                                        <img id="pic-preview" class="hidden w-full h-full object-cover absolute inset-0" alt="Preview Foto Diri"/>
                                        <input class="hidden" id="dropzone-file-pic" name="pic_photo" required="" type="file" accept="image/*" onchange="previewImage(this, 'pic-preview', 'pic-placeholder')"/>
                                    </label>
                                    <p id="pic-filename" class="text-xs text-gray-500 mt-1 truncate"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="flex flex-col gap-4 pt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input aria-describedby="terms" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary/30 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary/60 dark:ring-offset-gray-800" id="terms" name="terms" required="" type="checkbox"/>
                            </div>
                            <div class="ml-3 text-sm">
                                <label class="text-gray-500 dark:text-gray-300" for="terms">Saya setuju dengan <a class="font-medium text-primary hover:underline" href="#">syarat dan ketentuan</a> yang berlaku</label>
                            </div>
                        </div>
                        <button class="w-full text-white bg-primary hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-primary/30 font-bold rounded-lg text-base px-5 py-3.5 text-center transition-opacity" type="submit">Daftar Sekarang</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                            Sudah punya akun? <a class="font-medium text-primary hover:underline" href="{{ route('login') }}">Masuk di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input, previewId, placeholderId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            const filenameEl = document.getElementById(previewId.replace('-preview', '-filename'));
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Check file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    if (filenameEl) {
                        filenameEl.textContent = file.name;
                    }
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
                if (filenameEl) {
                    filenameEl.textContent = '';
                }
            }
        }

        // API Wilayah Indonesia - Local Proxy (avoid CORS)
        const API_BASE = '/api/region';
        
        const provinsiSelect = document.getElementById('provinsi-select');
        const kotaSelect = document.getElementById('kota-select');
        const kecamatanSelect = document.getElementById('kecamatan-select');
        const kelurahanSelect = document.getElementById('kelurahan-select');
        
        // Loading indicator functions
        function setLoading(selectEl, iconId, isLoading) {
            const icon = document.getElementById(iconId);
            if (isLoading) {
                selectEl.disabled = true;
                icon.textContent = 'progress_activity';
                icon.classList.add('animate-spin');
            } else {
                selectEl.disabled = false;
                icon.textContent = 'expand_more';
                icon.classList.remove('animate-spin');
            }
        }
        
        // Format name untuk kapitalisasi yang lebih baik
        function formatName(name) {
            // Handle special cases like "DKI", "DIY", etc.
            const specialCases = ['DKI', 'DIY', 'DI'];
            return name.split(' ').map(word => {
                if (specialCases.includes(word.toUpperCase())) {
                    return word.toUpperCase();
                }
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }).join(' ');
        }

        // Load Provinsi on page load
        async function loadProvinsi() {
            setLoading(provinsiSelect, 'provinsi-icon', true);
            try {
                const response = await fetch(`${API_BASE}/provinces`);
                if (!response.ok) throw new Error('Network response was not ok');
                const result = await response.json();
                
                provinsiSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                if (result.data && result.data.length > 0) {
                    result.data.forEach(prov => {
                        const option = document.createElement('option');
                        option.value = prov.name;
                        option.dataset.code = prov.code;
                        option.textContent = formatName(prov.name);
                        provinsiSelect.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error loading provinsi:', error);
                provinsiSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }
            setLoading(provinsiSelect, 'provinsi-icon', false);
        }

        // Load Kabupaten/Kota based on selected Provinsi
        async function loadKota(provinsiCode) {
            // Reset downstream dropdowns
            kotaSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
            kecamatanSelect.disabled = true;
            kelurahanSelect.disabled = true;
            
            if (!provinsiCode) {
                kotaSelect.disabled = true;
                return;
            }
            
            setLoading(kotaSelect, 'kota-icon', true);
            try {
                const response = await fetch(`${API_BASE}/regencies/${provinsiCode}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const result = await response.json();
                
                kotaSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                if (result.data && result.data.length > 0) {
                    result.data.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota.name;
                        option.dataset.code = kota.code;
                        option.textContent = formatName(kota.name);
                        kotaSelect.appendChild(option);
                    });
                }
                kotaSelect.disabled = false;
            } catch (error) {
                console.error('Error loading kota:', error);
                kotaSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }
            setLoading(kotaSelect, 'kota-icon', false);
        }

        // Load Kecamatan based on selected Kabupaten/Kota
        async function loadKecamatan(kotaCode) {
            // Reset downstream dropdowns
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
            kelurahanSelect.disabled = true;
            
            if (!kotaCode) {
                kecamatanSelect.disabled = true;
                return;
            }
            
            setLoading(kecamatanSelect, 'kecamatan-icon', true);
            try {
                const response = await fetch(`${API_BASE}/districts/${kotaCode}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const result = await response.json();
                
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                if (result.data && result.data.length > 0) {
                    result.data.forEach(kec => {
                        const option = document.createElement('option');
                        option.value = kec.name;
                        option.dataset.code = kec.code;
                        option.textContent = formatName(kec.name);
                        kecamatanSelect.appendChild(option);
                    });
                }
                kecamatanSelect.disabled = false;
            } catch (error) {
                console.error('Error loading kecamatan:', error);
                kecamatanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }
            setLoading(kecamatanSelect, 'kecamatan-icon', false);
        }

        // Load Kelurahan based on selected Kecamatan
        async function loadKelurahan(kecamatanCode) {
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
            
            if (!kecamatanCode) {
                kelurahanSelect.disabled = true;
                return;
            }
            
            setLoading(kelurahanSelect, 'kelurahan-icon', true);
            try {
                const response = await fetch(`${API_BASE}/villages/${kecamatanCode}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const result = await response.json();
                
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                if (result.data && result.data.length > 0) {
                    result.data.forEach(kel => {
                        const option = document.createElement('option');
                        option.value = kel.name;
                        option.dataset.code = kel.code;
                        option.textContent = formatName(kel.name);
                        kelurahanSelect.appendChild(option);
                    });
                }
                kelurahanSelect.disabled = false;
            } catch (error) {
                console.error('Error loading kelurahan:', error);
                kelurahanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }
            setLoading(kelurahanSelect, 'kelurahan-icon', false);
        }

        // Event listeners
        provinsiSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const provinsiCode = selectedOption.dataset.code;
            loadKota(provinsiCode);
        });

        kotaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const kotaCode = selectedOption.dataset.code;
            loadKecamatan(kotaCode);
        });

        kecamatanSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const kecamatanCode = selectedOption.dataset.code;
            loadKelurahan(kecamatanCode);
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadProvinsi();
        });
    </script>
</body>
</html>
