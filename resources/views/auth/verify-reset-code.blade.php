@extends('layouts.guest')

@section('title', 'Verifikasi Kode - LapakMahasiswa')

@section('content')
<h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Masukkan Kode Verifikasi</h2>
<p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
    Kami telah mengirimkan kode 6 digit ke <span class="font-semibold text-primary">{{ $email }}</span>
</p>

@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.verify-code.submit') }}" id="verify-form">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <!-- OTP Code Input -->
    <div class="mb-6">
        <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 text-center">Kode Verifikasi</label>
        <div class="flex justify-center gap-2" id="otp-container">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="0" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="1" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="2" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="3" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="4" inputmode="numeric" autocomplete="off">
            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" data-index="5" inputmode="numeric" autocomplete="off">
        </div>
        <input type="hidden" name="code" id="code-hidden">
        @error('code')
            <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
        Verifikasi Kode
    </button>
</form>

<!-- Resend Code -->
<div class="mt-6 text-center">
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Tidak menerima kode?</p>
    <form method="POST" action="{{ route('password.resend-code') }}" class="inline">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="text-primary font-medium hover:underline text-sm">
            Kirim Ulang Kode
        </button>
    </form>
</div>

<p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
    <a href="{{ route('password.request') }}" class="text-primary font-medium hover:underline">← Ganti email</a>
</p>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('code-hidden');
    const form = document.getElementById('verify-form');

    // Focus first input
    otpInputs[0].focus();

    otpInputs.forEach((input, index) => {
        // Handle input
        input.addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value.length === 1) {
                // Move to next input
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }

            updateHiddenInput();
        });

        // Handle backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
            
            pastedData.split('').forEach((char, i) => {
                if (otpInputs[i]) {
                    otpInputs[i].value = char;
                }
            });

            // Focus the next empty input or the last one
            const nextEmpty = Array.from(otpInputs).findIndex(inp => !inp.value);
            if (nextEmpty !== -1) {
                otpInputs[nextEmpty].focus();
            } else {
                otpInputs[otpInputs.length - 1].focus();
            }

            updateHiddenInput();
        });
    });

    function updateHiddenInput() {
        hiddenInput.value = Array.from(otpInputs).map(input => input.value).join('');
    }

    // Update hidden input before form submit
    form.addEventListener('submit', function() {
        updateHiddenInput();
    });
});
</script>
@endsection
