<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Struk #{{ $sale->id }}</title>
	<style>
		body {
			margin: 0;
			padding: 24px;
			background: #f1f3f5;
			color: #17212b;
			font-family: Arial, sans-serif;
		}

		.receipt {
			max-width: 420px;
			margin: auto;
			padding: 28px;
			background: #fff;
			box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
		}

		.center {
			text-align: center;
		}

		.muted {
			color: #6c757d;
			font-size: 12px;
		}

		.line {
			border-bottom: 1px dashed #adb5bd;
			padding: 14px 0;
		}

		.row,
		.item {
			display: flex;
			justify-content: space-between;
			gap: 16px;
			font-size: 13px;
		}

		.row+.row {
			margin-top: 8px;
		}

		.item {
			align-items: flex-start;
			margin-bottom: 14px;
		}

		.item-name {
			flex: 1;
		}

		.subtext {
			color: #6c757d;
			margin-top: 3px;
			font-size: 12px;
		}

		.total {
			padding-top: 16px;
			font-size: 18px;
			font-weight: bold;
		}

		button {
			display: block;
			margin: 22px auto 0;
			padding: 9px 16px;
			border: 0;
			color: #fff;
			background: #0d6efd;
			cursor: pointer;
		}

		@media print {
			body {
				padding: 0;
				background: #fff;
			}

			.receipt {
				max-width: none;
				padding: 0;
				box-shadow: none;
			}

			button {
				display: none;
			}
		}
	</style>
</head>

<body>
	<main class="receipt">
		<header class="center line">
			<h2>STRUK PENJUALAN</h2>
			<div class="muted">Transaksi #{{ $sale->id }}</div>
		</header>
		<section class="line">
			<div class="row"><span>Tanggal</span><strong>{{ $sale->created_at->format('d/m/Y H:i') }}</strong></div>
			<div class="row"><span>Kasir</span><strong>{{ $sale->user->name ?? '-' }}</strong></div>
			<div class="row"><span>Pembayaran</span><strong>{{ $sale->metode_pembayaran ?? '-' }}</strong></div>
		</section>
		<section class="line">
			@foreach($sale->itemPenjualan as $item)
				<div class="item">
					<div class="item-name">
						<strong>{{ $item->produk->nama ?? 'Produk dihapus' }}</strong>
						<div class="subtext">{{ $item->kuantitas }} x Rp
							{{ number_format($item->harga_satuan, 0, ',', '.') }}</div>
					</div>
					<strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
				</div>
			@endforeach
		</section>
		<div class="row total">
			<span>Subtotal</span>
			<span>Rp {{ number_format($sale->total_pembayaran + ($sale->diskon ?? 0), 0, ',', '.') }}</span>
		</div>
		<div class="row">
			<span>Diskon</span>
			<span>Rp {{ number_format($sale->diskon ?? 0, 0, ',', '.') }}</span>
		</div>
		<div class="row total">
			<span>Total</span>
			<span>Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
		</div>
		<div class="row">
			<span>Uang Dibayar</span>
			<span>Rp {{ number_format($sale->uang_dibayar ?? $sale->total_pembayaran, 0, ',', '.') }}</span>
		</div>
		<div class="row">
			<strong>Kembalian</strong>
			<strong>Rp {{ number_format($sale->kembalian ?? 0, 0, ',', '.') }}</strong>
		</div>
		<footer class="center">
			<p class="muted">Terima kasih atas kunjungan Anda.</p>
			<button type="button" onclick="window.print()">Cetak Struk</button>
		</footer>
	</main>
</body>

</html>