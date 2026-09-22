<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Transaksi #{{ $sale->id }}</title>
    <style>
        body {
            margin: 0;
            padding: 24px;
            background: #f1f3f5;
            color: #17212b;
            font-family: Arial, sans-serif;
        }

        .barcode-card {
            max-width: 420px;
            margin: auto;
            padding: 32px 24px;
            text-align: center;
            background: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
        }

        .barcode {
            width: 260px;
            height: 260px;
            object-fit: contain;
            margin: 24px 0 12px;
        }

        .muted {
            color: #6c757d;
            font-size: 13px;
        }

        button,
        a {
            display: inline-block;
            margin: 20px 4px 0;
            padding: 9px 16px;
            border: 0;
            color: #fff;
            background: #0d6efd;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        a {
            background: #6c757d;
        }

        @media print {
            body {
                padding: 0;
                background: #fff;
            }

            .barcode-card {
                max-width: none;
                padding: 20px 0;
                box-shadow: none;
            }

            button,
            a {
                display: none;
            }
        }
    </style>
</head>
<body>
    <main class="barcode-card">
        <h2>{{ config('app.company.name', 'Naysa POS') }}</h2>
        <div class="muted">Barcode Transaksi #{{ $sale->id }}</div>
           <img src="{{ asset('storage/products/bar.png') }}"
               alt="Barcode transaksi {{ $sale->id }}"
               class="barcode">
        <strong>TRX-{{ $sale->id }}</strong>
        <div>
            <button type="button" onclick="window.print()">Cetak Barcode</button>
            <a href="{{ route('admin.penjualan.show', $sale) }}">Kembali ke Struk</a>
        </div>
    </main>

</body>
</html>
