<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
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
            padding: 25mm 25mm 25mm 30mm;
        }
        
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #24aceb;
            margin-bottom: 20px;
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
        
        .header .date {
            font-size: 10pt;
            color: #333;
            margin-top: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        th, td {
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #333;
            font-size: 10pt;
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
        
        .stock {
            font-weight: bold;
        }
        
        .footer {
            position: fixed;
            bottom: 15mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #666;
        }
        
        .note {
            margin-top: 20px;
            font-size: 9pt;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $shopName }}</h1>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Tanggal dibuat: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th style="width: 100px;">Harga</th>
                <th style="width: 60px;">Rating</th>
                <th style="width: 60px;">Stock</th>
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
                <td class="center stock">{{ $product['stock'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="note">
        ***) diurutkan berdasarkan stock
    </div>

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
