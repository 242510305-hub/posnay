@extends('layouts.app')

@section('title', 'Perusahaan ' . config('app.company.name', 'Naysa POS'))

@section('content')
    @include('layouts.navbar')

    <style>
        .company-page {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .company-card {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 32px;
            align-items: center;
            padding: 36px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
        }

        .company-logo {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 18px;
            border: 5px solid #0d6efd;
        }

        .company-name {
            margin-bottom: 8px;
            color: #172033;
            font-size: 32px;
            font-weight: 800;
        }

        .company-label {
            margin-bottom: 20px;
            color: #0d6efd;
            font-weight: 600;
        }

        .company-detail {
            margin-bottom: 10px;
            color: #64748b;
        }

        .company-detail strong {
            display: inline-block;
            min-width: 90px;
            color: #172033;
        }

        .company-section {
            margin-top: 24px;
            padding: 28px 32px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06);
        }

        .company-section h2 {
            margin-bottom: 10px;
            color: #172033;
            font-size: 22px;
            font-weight: 800;
        }

        .company-section p {
            margin-bottom: 0;
            color: #64748b;
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 20px;
        }

        .feature-item {
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #edf1f7;
            border-radius: 12px;
        }

        .feature-item i {
            color: #0d6efd;
            font-size: 24px;
        }

        .feature-item strong {
            display: block;
            margin-top: 9px;
            color: #172033;
        }

        .feature-item span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .company-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-top: 24px;
        }

        .info-list {
            margin: 14px 0 0;
            padding-left: 20px;
            color: #64748b;
            line-height: 1.8;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 9px 0;
            color: #64748b;
            border-bottom: 1px solid #edf1f7;
        }

        .hours-row:last-child {
            border-bottom: 0;
        }

        .hours-row strong {
            color: #172033;
        }

        @media (max-width: 575px) {
            .company-card {
                grid-template-columns: 1fr;
                text-align: center;
                justify-items: center;
                padding: 24px;
            }

            .company-section {
                padding: 24px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .company-info-grid {
                grid-template-columns: 1fr;
            }

            .company-detail strong {
                display: block;
                margin-bottom: 3px;
            }
        }
    </style>

    <main class="company-page">
        <section class="company-card">
            <img src="{{ asset('nay.jpg') }}"
                 alt="{{ config('app.company.name', 'Naysa POS') }}"
                 class="company-logo">

            <div>
                <div class="company-label">INFORMASI PERUSAHAAN</div>
                <h1 class="company-name">{{ config('app.company.name', 'Naysa POS') }}</h1>

                @if(config('app.company.address'))
                    <div class="company-detail">
                        <strong>Alamat</strong>
                        {{ config('app.company.address') }}
                    </div>
                @endif

                @if(config('app.company.phone'))
                    <div class="company-detail">
                        <strong>Telepon</strong>
                        {{ config('app.company.phone') }}
                    </div>
                @endif

                @if(config('app.company.email'))
                    <div class="company-detail">
                        <strong>Email</strong>
                        {{ config('app.company.email') }}
                    </div>
                @endif
            </div>
        </section>

        <section class="company-section">
            <h2>Tentang {{ config('app.company.name', 'Naysa POS') }}</h2>
            <p>
                {{ config('app.company.name', 'Naysa POS') }} adalah sistem kasir untuk membantu
                mengelola produk, stok, transaksi penjualan, pembayaran, dan laporan toko dengan lebih cepat.
            </p>

            <div class="feature-grid">
                <div class="feature-item">
                    <i class="bi bi-cart-check-fill"></i>
                    <strong>Kasir</strong>
                    <span>Proses transaksi dan pembayaran dengan praktis.</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-box-seam-fill"></i>
                    <strong>Stok Produk</strong>
                    <span>Pantau stok rendah dan produk yang habis.</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-receipt-cutoff"></i>
                    <strong>Struk</strong>
                    <span>Cetak struk dan barcode transaksi secara terpisah.</span>
                </div>
            </div>
        </section>

        <div class="company-info-grid">
            <section class="company-section mt-0">
                <h2><i class="bi bi-bullseye text-primary me-2"></i>Visi</h2>
                <p>
                    Menjadi solusi kasir yang sederhana, cepat, dan dapat diandalkan untuk membantu
                    toko berkembang dengan pengelolaan yang lebih teratur.
                </p>
            </section>

            <section class="company-section mt-0">
                <h2><i class="bi bi-stars text-primary me-2"></i>Misi</h2>
                <ul class="info-list">
                    <li>Memudahkan pencatatan transaksi penjualan.</li>
                    <li>Membantu pemantauan stok secara akurat.</li>
                    <li>Menyediakan informasi penjualan yang mudah dipahami.</li>
                </ul>
            </section>
        </div>

        <section class="company-section">
            <h2><i class="bi bi-clock text-primary me-2"></i>Jam Operasional</h2>
            <div class="hours-row"><span>Senin - Jumat</span><strong>08.00 - 21.00</strong></div>
            <div class="hours-row"><span>Sabtu</span><strong>08.00 - 22.00</strong></div>
            <div class="hours-row"><span>Minggu</span><strong>09.00 - 20.00</strong></div>
        </section>
    </main>
@endsection
