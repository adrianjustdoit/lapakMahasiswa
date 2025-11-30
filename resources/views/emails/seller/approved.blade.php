@extends('emails.seller.base')

@section('title', 'Akun Disetujui')

@section('header-title', 'Selamat! Akun Anda Disetujui! 🎉')

@section('status-badge')
<span class="status-badge badge-approved">✓ Disetujui</span>
@endsection

@section('content')
<p class="greeting">Halo, <strong>{{ $user->pic_name }}</strong>! 🎊</p>

<p class="message">
    Kabar gembira! Pendaftaran toko <strong>{{ $user->shop_name }}</strong> telah 
    <strong style="color: #28a745;">DISETUJUI</strong> oleh tim kami. 
    Anda sekarang dapat mulai berjualan di LapakMahasiswa!
</p>

<div class="shop-info">
    <div class="shop-info-item">
        <div class="shop-info-icon">🏪</div>
        <div>
            <div class="shop-info-label">Nama Toko</div>
            <div class="shop-info-value">{{ $user->shop_name }}</div>
        </div>
    </div>
    <div class="shop-info-item">
        <div class="shop-info-icon">📧</div>
        <div>
            <div class="shop-info-label">Email Login</div>
            <div class="shop-info-value">{{ $user->pic_email }}</div>
        </div>
    </div>
</div>

<div class="highlight-box">
    <h4>🔐 Langkah Selanjutnya</h4>
    <p>Klik tombol di bawah untuk mengaktifkan akun Anda. Setelah aktif, Anda dapat login menggunakan email di atas dan password yang sudah Anda buat saat pendaftaran.</p>
</div>

<div class="cta-center">
    <a href="{{ $activationUrl }}" class="cta-button">🚀 Aktivasi Akun Sekarang</a>
</div>

<p class="message">Setelah akun aktif, Anda dapat:</p>

<div class="steps">
    <div class="step">
        <div class="step-number">1</div>
        <div class="step-content">
            <h4>Login ke Dashboard 💻</h4>
            <p>Akses dashboard penjual untuk mengelola toko Anda.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">2</div>
        <div class="step-content">
            <h4>Tambah Produk 📦</h4>
            <p>Upload foto dan deskripsi produk yang ingin Anda jual.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">3</div>
        <div class="step-content">
            <h4>Mulai Berjualan! 💰</h4>
            <p>Produk Anda akan tampil dan bisa dilihat oleh pembeli.</p>
        </div>
    </div>
</div>

<div class="divider"></div>

<p class="message" style="font-size: 14px; color: #718096;">
    <strong>Catatan:</strong> Link aktivasi ini hanya berlaku selama 7 hari. 
    Jika link sudah kadaluarsa, silakan hubungi tim support kami.
</p>
@endsection
