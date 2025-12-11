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
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            color: #fff;
            padding: 10px 15px;
            margin-bottom: 12px;
        }
        
        .section-title.active {
            background-color: #10b981;
        }
        
        .section-title.inactive {
            background-color: #f59e0b;
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
            background-color: #24aceb;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: bold;
        }
        
        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
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
            text-align: center;
        }
        
        .summary-box h3 {
            font-size: 11pt;
            color: #24aceb;
            margin-bottom: 15px;
        }
        
        .summary-stats {
            display: table;
            width: 100%;
        }
        
        .stat-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
        }
        
        .stat-number {
            font-size: 24pt;
            font-weight: bold;
        }
        
        .stat-number.green { color: #10b981; }
        .stat-number.yellow { color: #f59e0b; }
        .stat-number.red { color: #ef4444; }
        
        .stat-label {
            font-size: 9pt;
            color: #666;
            margin-top: 5px;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPAK MAHASISWA</h1>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Dibuat pada: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    <!-- Summary -->
    <div class="summary-box">
        <h3>RINGKASAN DATA PENJUAL</h3>
        <div class="summary-stats">
            <div class="stat-item">
                <div class="stat-number green">{{ $activeSellers->count() }}</div>
                <div class="stat-label">Penjual Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number yellow">{{ $inactiveSellers->where('seller_status', 'pending')->count() }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number red">{{ $inactiveSellers->where('seller_status', 'rejected')->count() }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>

    <!-- Active Sellers -->
    <div class="section">
        <div class="section-title active">DAFTAR PENJUAL AKTIF ({{ $activeSellers->count() }})</div>
        
        @if($activeSellers->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Provinsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activeSellers as $index => $seller)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $seller->shop_name ?? '-' }}</strong></td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->pic_phone ?? '-' }}</td>
                    <td>{{ $seller->provinsi ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">Belum ada penjual aktif</div>
        @endif
    </div>

    <!-- Inactive Sellers -->
    <div class="section">
        <div class="section-title inactive">DAFTAR PENJUAL TIDAK AKTIF ({{ $inactiveSellers->count() }})</div>
        
        @if($inactiveSellers->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Provinsi</th>
                    <th>Alasan Penolakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inactiveSellers as $index => $seller)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $seller->shop_name ?? '-' }}</strong></td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>
                        @if($seller->seller_status === 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($seller->seller_status === 'rejected')
                            <span class="badge badge-rejected">Ditolak</span>
                        @else
                            <span class="badge">-</span>
                        @endif
                    </td>
                    <td>{{ $seller->provinsi ?? '-' }}</td>
                    <td>{{ $seller->rejection_reason ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">Tidak ada penjual tidak aktif</div>
        @endif
    </div>

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
