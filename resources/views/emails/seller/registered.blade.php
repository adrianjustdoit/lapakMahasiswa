@extends('emails.seller.base')

@section('title', 'Pendaftaran Berhasil')

@section('header-title', 'Pendaftaran Berhasil!')

@section('status-badge')
<span class="status-badge badge-pending">⏳ Menunggu Verifikasi</span>
@endsection

@section('content')
<p class="greeting">Halo, <strong>{{ $user->pic_name }}</strong>! 👋</p>

<p class="message">
    Terima kasih telah mendaftar sebagai penjual di <strong>LapakMahasiswa</strong>! 
    Kami sangat senang Anda bergabung dengan komunitas wirausaha mahasiswa kami.
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
            <div class="shop-info-label">Email</div>
            <div class="shop-info-value">{{ $user->pic_email }}</div>
        </div>
    </div>
    <div class="shop-info-item">
        <div class="shop-info-icon">📅</div>
        <div>
            <div class="shop-info-label">Tanggal Pendaftaran</div>
            <div class="shop-info-value">{{ $user->created_at->format('d F Y, H:i') }} WIB</div>
        </div>
    </div>
</div>

<div class="highlight-box">
    <h4>📋 Apa Selanjutnya?</h4>
    <p>Tim kami akan memverifikasi data pendaftaran Anda dalam waktu <strong>1-3 hari kerja</strong>. 
    Kami akan mengirimkan email pemberitahuan setelah proses verifikasi selesai.</p>
</div>

<p class="message">Berikut adalah proses yang akan dilalui:</p>

<div class="steps">
    <div class="step">
        <div class="step-number">1</div>
        <div class="step-content">
            <h4>Verifikasi Data ✅</h4>
            <p>Tim kami akan memeriksa kelengkapan dan kevalidan data yang Anda kirimkan.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">2</div>
        <div class="step-content">
            <h4>Notifikasi Email 📧</h4>
            <p>Anda akan menerima email berisi hasil verifikasi (disetujui/ditolak).</p>
        </div>
    </div>
    <div class="step">
        <div class="step-number">3</div>
        <div class="step-content">
            <h4>Aktivasi Akun 🚀</h4>
            <p>Jika disetujui, Anda dapat mengaktifkan akun dan mulai berjualan!</p>
        </div>
    </div>
</div>

<div class="divider"></div>

<p class="message" style="text-align: center; color: #718096;">
    Sambil menunggu, Anda bisa mempersiapkan foto produk dan deskripsi toko yang menarik! 📸
</p>
@endsection
