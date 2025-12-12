<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 0;
            size: landscape;
        }
        
        html, body {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #333;
            padding: 20mm 20mm 20mm 25mm;
        }
        
        .header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 3px solid #24aceb;
            margin-bottom: 15px;
        }
        
        .header h1 {
            font-size: 14pt;
            color: #24aceb;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 12pt;
            color: #333;
            font-weight: bold;
        }
        
        .header .srs-code {
            font-size: 9pt;
            color: #666;
            margin-top: 5px;
        }
        
        .header .date {
            font-size: 10pt;
            color: #333;
            margin-top: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        
        th, td {
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #333;
            font-size: 9pt;
        }
        
        th {
            background-color: #24aceb;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        
        td {
            vertical-align: top;
        }
        
        td.center {
            text-align: center;
        }
        
        td.right {
            text-align: right;
        }
        
        .price {
            font-weight: bold;
            color: #10b981;
        }
        
        .rating {
            font-weight: bold;
            color: #f59e0b;
        }
        
        .footer {
            position: fixed;
            bottom: 12mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #666;
        }
        
        .note {
            margin-top: 15px;
            font-size: 9pt;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPAK MAHASISWA</h1>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Tanggal dibuat: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 35px;">No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th style="width: 100px;">Harga</th>
                <th style="width: 60px;">Rating</th>
                <th>Nama Toko</th>
                <th>Propinsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $product['produk'] }}</td>
                <td>{{ $product['kategori'] }}</td>
                <td class="right price">Rp {{ number_format($product['harga'], 0, ',', '.') }}</td>
                <td class="center rating">{{ number_format($product['rating'], 1) }}</td>
                <td>{{ $product['nama_toko'] }}</td>
                <td>{{ $product['provinsi'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="note">
        ***) propinsi diisikan propinsi pemberi rating
    </div>

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
