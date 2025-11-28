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
    </style>
</head>
<body class="font-display">
    <div class="relative flex min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="flex flex-1">
            <div class="grid w-full grid-cols-1 md:grid-cols-10">
                <!-- Left Panel - Selaras dengan primary color (#24aceb) -->
                <div class="relative hidden md:flex md:col-span-4 flex-col items-start justify-center p-12 bg-primary text-white">
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
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/10">
                                    <span class="material-symbols-outlined text-white text-2xl">card_giftcard</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Gratis Pendaftaran</h3>
                                    <p class="text-sm text-white/70">Tanpa biaya pendaftaran atau biaya tersembunyi.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/10">
                                    <span class="material-symbols-outlined text-white text-2xl">groups</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Jangkauan Luas</h3>
                                    <p class="text-sm text-white/70">Jangkau ribuan mahasiswa di seluruh kampus.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/10">
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
                <div class="md:col-span-6 flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-20 bg-background-light dark:bg-background-dark">
                    <div class="mx-auto w-full max-w-lg">
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
                                    <label class="flex flex-col sm:col-span-2">
                                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Provinsi<span class="text-red-500">*</span></p>
                                        <input name="provinsi" value="{{ old('provinsi') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="Pilih provinsi" required="" type="text"/>
                                    </label>
                                    <label class="flex flex-col sm:col-span-2">
                                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Kabupaten/Kota<span class="text-red-500">*</span></p>
                                        <input name="kota" value="{{ old('kota') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="Pilih kabupaten/kota" required="" type="text"/>
                                    </label>
                                </div>
                            </div>
                            <!-- Upload Documents -->
                            <div>
                                <h3 class="text-[#0e171b] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Upload Dokumen</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col">
                                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Foto KTP<span class="text-red-500">*</span></p>
                                        <div class="flex items-center justify-center w-full">
                                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#d0e0e7] dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-background-dark/50 hover:bg-gray-100 dark:hover:bg-gray-800" for="dropzone-file-ktp">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 mb-2">cloud_upload</span>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
                                                </div>
                                                <input class="hidden" id="dropzone-file-ktp" name="pic_id_photo" required="" type="file" accept="image/*"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Foto Diri<span class="text-red-500">*</span></p>
                                        <div class="flex items-center justify-center w-full">
                                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#d0e0e7] dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-background-dark/50 hover:bg-gray-100 dark:hover:bg-gray-800" for="dropzone-file-pic">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 mb-2">cloud_upload</span>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
                                                </div>
                                                <input class="hidden" id="dropzone-file-pic" name="pic_photo" required="" type="file" accept="image/*"/>
                                            </label>
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
        </div>
    </div>
</body>
</html>
