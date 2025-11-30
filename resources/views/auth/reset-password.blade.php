@extends('layouts.guest')

@section('title', 'Reset Password - LapakMahasiswa')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
@endpush

@section('content')
<h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">Reset Password</h2>
<p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
    Buat password baru untuk akun Anda
</p>

@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.store') }}" id="reset-form">
    @csrf

    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="code" value="{{ $code }}">

    <!-- Email Display -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
        <div class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
            {{ $email }}
        </div>
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
        <div class="relative">
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                autocomplete="new-password"
                class="w-full px-4 py-2 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                placeholder="Masukkan password baru"
            >
            <button type="button" onclick="togglePassword('password', 'password-toggle-icon')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                <span class="material-symbols-outlined text-xl" id="password-toggle-icon">visibility_off</span>
            </button>
        </div>
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
        <div class="relative">
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                required
                autocomplete="new-password"
                class="w-full px-4 py-2 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                placeholder="Konfirmasi password baru"
            >
            <button type="button" onclick="togglePassword('password_confirmation', 'password-confirm-toggle-icon')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                <span class="material-symbols-outlined text-xl" id="password-confirm-toggle-icon">visibility_off</span>
            </button>
        </div>
        @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password Requirements -->
    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Persyaratan Password:</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="flex items-center gap-2" id="req-lowercase">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-lowercase">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Minimal 1 huruf kecil (a-z)</span>
            </div>
            <div class="flex items-center gap-2" id="req-uppercase">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-uppercase">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Minimal 1 huruf besar (A-Z)</span>
            </div>
            <div class="flex items-center gap-2" id="req-number">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-number">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Minimal 1 angka (0-9)</span>
            </div>
            <div class="flex items-center gap-2" id="req-symbol">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-symbol">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Minimal 1 simbol (!@#$%^&*)</span>
            </div>
            <div class="flex items-center gap-2" id="req-length">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-length">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Minimal 8 karakter</span>
            </div>
            <div class="flex items-center gap-2" id="req-match">
                <span class="material-symbols-outlined text-lg text-red-500" id="icon-match">close</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">Password cocok</span>
            </div>
        </div>
    </div>

    <button type="submit" id="submit-btn" disabled class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed">
        Reset Password
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
    <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">← Kembali ke login</a>
</p>

<script>
    // Toggle password visibility
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }

    // Password validation
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submit-btn');

    function updateRequirement(iconId, isValid) {
        const icon = document.getElementById(iconId);
        if (isValid) {
            icon.textContent = 'check';
            icon.classList.remove('text-red-500');
            icon.classList.add('text-green-500');
        } else {
            icon.textContent = 'close';
            icon.classList.remove('text-green-500');
            icon.classList.add('text-red-500');
        }
    }

    function validatePassword() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        // Check lowercase
        const hasLowercase = /[a-z]/.test(password);
        updateRequirement('icon-lowercase', hasLowercase);

        // Check uppercase
        const hasUppercase = /[A-Z]/.test(password);
        updateRequirement('icon-uppercase', hasUppercase);

        // Check number
        const hasNumber = /[0-9]/.test(password);
        updateRequirement('icon-number', hasNumber);

        // Check symbol
        const hasSymbol = /[@$!%*#?&^]/.test(password);
        updateRequirement('icon-symbol', hasSymbol);

        // Check length
        const hasLength = password.length >= 8;
        updateRequirement('icon-length', hasLength);

        // Check match
        const isMatch = password === confirm && password.length > 0;
        updateRequirement('icon-match', isMatch);

        // Enable/disable submit button
        const allValid = hasLowercase && hasUppercase && hasNumber && hasSymbol && hasLength && isMatch;
        submitBtn.disabled = !allValid;

        return allValid;
    }

    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validatePassword);
</script>
@endsection
