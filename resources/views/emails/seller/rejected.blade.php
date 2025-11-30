@extends('emails.seller.base')

@section('title', 'Pendaftaran Ditolak')

@section('header-title', 'Pendaftaran Tidak Dapat Diproses')

@section('status-badge')
<span class="status-badge badge-rejected">✗ Ditolak</span>
@endsection

@section('content')
<p class="greeting">Halo, <strong>{{ $user->pic_name }}</strong>,</p>

<p class="message">
    Mohon maaf, pendaftaran toko <strong>{{ $user->shop_name }}</strong> 
    belum dapat kami setujui saat ini.
</p>

<div class="rejection-box">
    <h4>📝 Alasan Penolakan:</h4>
    <p>{{ $user->rejection_reason ?? 'Tidak ada alasan spesifik yang diberikan.' }}</p>
</div>

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
            <div class="shop-info-label">Email</div>
            <div class="shop-info-value">{{ $user->pic_email }}</div>
        </div>
    </div>
</div>

<div class="highlight-box">
    <h4>💡 Apa yang bisa Anda lakukan?</h4>
    <p>Jangan khawatir! Anda masih dapat mendaftar ulang dengan memperbaiki data sesuai alasan penolakan di atas. 
    Pastikan semua dokumen dan informasi yang Anda berikan sudah lengkap dan valid.</p>
</div>

<p class="message">Tips untuk pendaftaran berikutnya:</p>

<div class="steps">
    <div class="step">
        <div class="step-number">1</div>
        <div class="step-content">
            <h4>Periksa Dokumen 📄</h4>
            <p>Pastikan foto KTP jelas, tidak blur, dan informasi terbaca dengan baik.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">2</div>
        <div class="step-content">
            <h4>Data Valid ✓</h4>
            <p>Pastikan semua data yang diisi sesuai dengan dokumen identitas.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">3</div>
        <div class="step-content">
            <h4>Daftar Ulang 🔄</h4>
            <p>Setelah memperbaiki, silakan daftar kembali melalui website kami.</p>
        </div>
    </div>
</div>

<div class="cta-center">
    <a href="{{ url('/seller/register') }}" class="cta-button">📝 Daftar Ulang</a>
</div>

<div class="divider"></div>

<p class="message" style="font-size: 14px; color: #718096; text-align: center;">
    Jika Anda merasa ada kesalahan atau membutuhkan bantuan lebih lanjut, 
    jangan ragu untuk menghubungi tim support kami.
</p>
@endsection
