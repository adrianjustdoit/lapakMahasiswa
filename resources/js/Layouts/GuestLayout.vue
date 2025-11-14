<script setup>
// Simplified guest layout without Laravel default logo block
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-sky-50 to-sky-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-5 bg-white/90 backdrop-blur rounded-xl shadow-lg border border-sky-200">
            <slot />
        </div>
    </div>
</template>
