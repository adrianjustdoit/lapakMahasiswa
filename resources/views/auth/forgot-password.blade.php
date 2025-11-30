@extends('layouts.guest')

@section('title', 'Lupa Password - LapakMahasiswa')

@section('content')
<h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Lupa Password?</h2>
<p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
    Masukkan email Anda dan kami akan mengirimkan kode verifikasi untuk reset password.
</p>

@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email -->
    <div class="mb-6">
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autofocus
            autocomplete="off"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
            placeholder="email@contoh.com"
        >
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
        Kirim Kode Verifikasi
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
    <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">← Kembali ke login</a>
</p>
@endsection
