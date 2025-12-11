<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        /* Margin standar surat formal: atas 3cm, bawah 3cm, kiri 4cm, kanan 3cm */
        @page {
            margin: 0;
        }
        
        html, body {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            /* Padding sebagai pengganti margin @page */
            padding: 30mm 30mm 30mm 40mm;
        }
        
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #24aceb;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 16pt;
            color: #24aceb;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 13pt;
            color: #333;
            font-weight: bold;
        }
        
        .header .date {
            font-size: 10pt;
            color: #666;
            margin-top: 8px;
        }
        
        .province-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .province-header {
            font-size: 12pt;
            font-weight: bold;
            color: #ffffff;
            padding: 10px 15px;
            background-color: #24aceb;
            margin-bottom: 12px;
        }
        
        .province-count {
            float: right;
            background-color: #1a8bc7;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 10pt;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        th, td {
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 10pt;
        }
        
        th {
            background-color: #e8f4fc;
            color: #24aceb;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .summary-box {
            background-color: #f0f7fc;
            border: 2px solid #24aceb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .summary-box h3 {
            font-size: 11pt;
            color: #24aceb;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
        }
        
        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            border-right: 1px solid #ddd;
        }
        
        .summary-item:last-child {
            border-right: none;
        }
        
        .summary-number {
            font-size: 20pt;
            font-weight: bold;
            color: #24aceb;
        }
        
        .summary-label {
            font-size: 9pt;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
        
        .empty-province-section {
            margin-bottom: 25px;
        }
        
        .empty-province-title {
            font-size: 12pt;
            font-weight: bold;
            color: #ffffff;
            padding: 10px 15px;
            background-color: #6b7280;
            margin-bottom: 12px;
        }
        
        .empty-province-list {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
        }
        
        .empty-province-item {
            display: inline-block;
            padding: 5px 12px;
            margin: 3px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            font-size: 9pt;
            color: #374151;
        }
    </style>
</head>
<body>
    <div style="text-align: center; padding-bottom: 15px; border-bottom: 3px solid #24aceb; margin-bottom: 25px;">
        <h1 style="font-size: 16pt; color: #24aceb; margin-bottom: 5px;">LAPAK MAHASISWA</h1>
        <div style="font-size: 13pt; color: #333333; font-weight: bold;">{{ $title }}</div>
        <div style="font-size: 10pt; color: #666666; margin-top: 8px;">Dibuat pada: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    <!-- Summary -->
    <div style="background-color: #f0f7fc; border: 2px solid #24aceb; padding: 15px; margin-bottom: 20px;">
        <h3 style="font-size: 11pt; color: #24aceb; margin-bottom: 15px; text-align: center;">RINGKASAN SEBARAN PENJUAL PER PROVINSI</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: center; padding: 10px; border-right: 1px solid #ddd; width: 33%;">
                    <div style="font-size: 20pt; font-weight: bold; color: #24aceb;">{{ count($allProvinces) }}</div>
                    <div style="font-size: 9pt; color: #666666;">Total Provinsi</div>
                </td>
                <td style="text-align: center; padding: 10px; border-right: 1px solid #ddd; width: 33%;">
                    <div style="font-size: 20pt; font-weight: bold; color: #24aceb;">{{ $provincesWithSellersCount }}</div>
                    <div style="font-size: 9pt; color: #666666;">Provinsi Memiliki Penjual</div>
                </td>
                <td style="text-align: center; padding: 10px; width: 33%;">
                    <div style="font-size: 20pt; font-weight: bold; color: #24aceb;">{{ $totalSellers }}</div>
                    <div style="font-size: 9pt; color: #666666;">Total Penjual</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- BAGIAN 1: Provinsi yang Memiliki Penjual -->
    @php $provinceNumber = 1; @endphp
    @foreach($provincesWithSellersData as $province => $sellers)
    <div class="province-section">
        <table style="width: 100%; margin-bottom: 12px;">
            <tr>
                <td style="background-color: #24aceb; color: #ffffff; font-size: 12pt; font-weight: bold; padding: 10px 15px;">
                    {{ $provinceNumber }}. {{ $province }}
                </td>
                <td style="background-color: #1a8bc7; color: #ffffff; font-size: 10pt; padding: 10px 15px; width: 100px; text-align: center;">
                    {{ $sellers->count() }} Penjual
                </td>
            </tr>
        </table>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Email</th>
                    <th>Kota/Kabupaten</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $index => $seller)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $seller->shop_name ?? '-' }}</strong></td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->kota ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @php $provinceNumber++; @endphp
    @endforeach

    <!-- BAGIAN 2: Provinsi yang Belum Memiliki Penjual -->
    @if($provincesWithoutSellers->count() > 0)
    <div class="empty-province-section">
        <table style="width: 100%; margin-bottom: 12px;">
            <tr>
                <td style="background-color: #6b7280; color: #ffffff; font-size: 12pt; font-weight: bold; padding: 10px 15px;">
                    PROVINSI BELUM MEMILIKI PENJUAL ({{ $provincesWithoutSellers->count() }} Provinsi)
                </td>
            </tr>
        </table>
        <div class="empty-province-list">
            @foreach($provincesWithoutSellers as $index => $province)
            <span class="empty-province-item">{{ $index + 1 }}. {{ $province }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
