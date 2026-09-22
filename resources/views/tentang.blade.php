@extends('layouts.app')

@section('title', 'Perusahaan ' . config('app.company.name', 'Naysa POS'))

@section('content')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .about-wrapper {
        max-width: 1150px;
        margin: 35px auto;
        padding: 0 20px;
    }

    .hero-card {
        position: relative;
        overflow: hidden;
        border-radius: 25px;
        padding: 50px 45px;
        color: white;
        background: linear-gradient(
            135deg,
            #0d6efd 0%,
            #2563eb 45%,
            #4f46e5 100%
        );
        box-shadow: 0 15px 40px rgba(37, 99, 235, .22);
        margin-bottom: 25px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-icon {
        width: 75px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border-radius: 22px;
        background: rgba(255,255,255,.16);
        font-size: 38px;
    }

    .hero-content h1 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .hero-content p {
        font-size: 16px;
        margin: 0;
        color: rgba(255,255,255,.9);
    }

    .section-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        margin-bottom: 25px;
        border: 1px solid #e8edf5;
        box-shadow: 0 8px 30px rgba(15,23,42,.06);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 22px;
        font-weight: 700;
        color: #172033;
        margin-bottom: 22px;
    }

    .title-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eaf2ff;
        color: #0d6efd;
        font-size: 21px;
    }

    .description {
        color: #64748b;
        font-size: 15px;
        line-height: 1.9;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 28px;
    }

    .stat-card {
        padding: 22px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #edf1f7;
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(15,23,42,.08);
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eaf2ff;
        color: #0d6efd;
        font-size: 21px;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 20px;
        font-weight: 800;
        color: #172033;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .feature-card {
        display: flex;
        gap: 17px;
        padding: 22px;
        background: #f8fafc;
        border: 1px solid #edf1f7;
        border-radius: 18px;
        transition: .3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background: white;
        box-shadow: 0 12px 28px rgba(15,23,42,.08);
    }

    .feature-icon {
        min-width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: #eaf2ff;
        color: #0d6efd;
        font-size: 24px;
    }

    .feature-card h5 {
        margin-bottom: 7px;
        color: #172033;
        font-weight: 700;
    }

    .feature-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
    }

    .profile-area {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 45px;
        align-items: center;
    }

    .profile-box {
        text-align: center;
    }

    .profile-photo {
        width: 170px;
        height: 170px;
        margin: auto;
        margin-bottom: 15px;
        border-radius: 50%;
        object-fit: cover;
        border: 7px solid #0d6efd;
        box-shadow: 0 10px 25px rgba(13,110,253,.15);
    }

    .profile-name {
        font-size: 18px;
        font-weight: 800;
        color: #172033;
    }

    .profile-role {
        color: #64748b;
        font-size: 13px;
    }

    .biodata-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .biodata-item {
        display: grid;
        grid-template-columns: 145px 20px 1fr;
        padding: 14px 16px;
        border-radius: 12px;
        background: #f8fafc;
        font-size: 14px;
    }

    .biodata-label {
        color: #64748b;
        font-weight: 650;
    }

    .biodata-value {
        color: #172033;
        font-weight: 500;
    }

    .contact-section {
        margin-top: 35px;
        padding-top: 28px;
        border-top: 1px solid #e5eaf1;
    }

    .contact-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .contact-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
        transition: .3s;
    }

    .contact-btn:hover {
        transform: translateY(-3px);
    }

    .btn-email {
        color: #dc2626;
        border: 1px solid #fecaca;
        background: #fff5f5;
    }

    .btn-instagram {
        color: #c026d3;
        border: 1px solid #f5d0fe;
        background: #fdf4ff;
    }

    .btn-github {
        color: #172033;
        border: 1px solid #d1d5db;
        background: #f8fafc;
    }

    .btn-home {
        color: white;
        background: linear-gradient(135deg, #0d6efd, #4f46e5);
        border: none;
    }

    .about-footer {
        text-align: center;
        padding: 10px 0 30px;
        color: #94a3b8;
        font-size: 13px;
    }

    @media(max-width:768px) {

        .about-wrapper {
            padding: 0 12px;
        }

        .hero-card {
            padding: 38px 20px;
        }

        .hero-content h1 {
            font-size: 27px;
        }

        .section-card {
            padding: 25px 20px;
        }

        .stats-grid,
        .feature-grid,
        .profile-area {
            grid-template-columns: 1fr;
        }

        .profile-area {
            gap: 30px;
        }

        .biodata-item {
            grid-template-columns: 110px 15px 1fr;
        }
    }
</style>

@include('layouts.navbar')

<div class="about-wrapper">

    {{-- HERO --}}
    <div class="hero-card">

        <div class="hero-content">

            <div class="hero-icon">
                <i class="bi bi-shop"></i>
            </div>

            <h1>{{ config('app.company.name', 'Naysa POS') }}</h1>

            <p>
                Sistem Point of Sale untuk Pengelolaan Transaksi & Stok
            </p>

        </div>

    </div>


    {{-- DESKRIPSI --}}
    <div class="section-card">

        <div class="section-title">
            <div class="title-icon">
                <i class="bi bi-rocket-takeoff-fill"></i>
            </div>

            <span>Tentang Perusahaan</span>
        </div>

        <p class="description">
            <strong>{{ config('app.company.name', 'Naysa POS') }}</strong> merupakan aplikasi
            Point of Sale yang dibuat untuk membantu proses
            pengelolaan penjualan, produk, stok, pengguna,
            serta transaksi dalam sebuah toko.
        </p>

        <p class="description">
            Aplikasi ini memiliki tampilan yang sederhana,
            modern, dan mudah digunakan sehingga proses
            pengelolaan data dapat dilakukan dengan lebih
            cepat dan terorganisir.
        </p>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="stat-number">
                    Produk
                </div>

                <div class="stat-label">
                    Mengelola data dan stok produk
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-cart-check"></i>
                </div>

                <div class="stat-number">
                    Penjualan
                </div>

                <div class="stat-label">
                    Mengelola transaksi penjualan
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>

                <div class="stat-number">
                    Laporan
                </div>

                <div class="stat-label">
                    Monitoring data transaksi
                </div>
            </div>

        </div>

    </div>


    {{-- FITUR --}}
    <div class="section-card">

        <div class="section-title">
            <div class="title-icon">
                <i class="bi bi-stars"></i>
            </div>

            <span>Fitur Utama</span>
        </div>

        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-box"></i>
                </div>

                <div>
                    <h5>Manajemen Produk</h5>

                    <p>
                        Menambahkan, mengedit, menghapus,
                        dan mengelola stok produk.
                    </p>
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-cart-check"></i>
                </div>

                <div>
                    <h5>Transaksi Kasir</h5>

                    <p>
                        Membantu proses transaksi penjualan
                        dengan perhitungan otomatis.
                    </p>
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <h5>Manajemen User</h5>

                    <p>
                        Mengatur data pengguna dan
                        hak akses aplikasi.
                    </p>
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <h5>Jenis Produk</h5>

                    <p>
                        Mengelompokkan produk berdasarkan
                        jenis atau kategori.
                    </p>
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>

                <div>
                    <h5>Laporan Penjualan</h5>

                    <p>
                        Memantau data transaksi dan
                        perkembangan penjualan.
                    </p>
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <h5>Keamanan Akses</h5>

                    <p>
                        Penggunaan role Admin dan Kasir
                        untuk membatasi akses fitur.
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- BIODATA --}}
    <div class="section-card">

        <div class="section-title">

            <div class="title-icon">
                <i class="bi bi-person-badge-fill"></i>
            </div>

            <span>Tentang Pembuat</span>

        </div>


        <div class="profile-area">

            <div class="profile-box">

                <img
                    src="{{ asset('nay.jpg') }}"
                    alt="Foto Profil"
                    class="profile-photo"
                    onerror="this.onerror=null; this.src='{{ asset('nay.jpg') }}';"
                >

                <div class="profile-name">
                    NAYSA FAUZIAH
                </div>

                <div class="profile-role">
                    Web Developer
                </div>

            </div>


            <div class="biodata-list">

                <div class="biodata-item">
                    <div class="biodata-label">Nama Lengkap</div>
                    <div>:</div>
                    <div class="biodata-value">
                        NAYSA FAUZIAH
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Sekolah</div>
                    <div>:</div>
                    <div class="biodata-value">
                        SMKN 4 Tasikmalaya
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Kelas / Jurusan</div>
                    <div>:</div>
                    <div class="biodata-value">
                        XII PPLG 4
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Bidang</div>
                    <div>:</div>
                    <div class="biodata-value">
                        Web Development & UI/UX
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Email</div>
                    <div>:</div>
                    <div class="biodata-value">
                        naysafau@gmail.com
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Instagram</div>
                    <div>:</div>
                    <div class="biodata-value">
                        @nysfziii_
                    </div>
                </div>

            </div>

        </div>


        {{-- KONTAK --}}
        <div class="contact-section">

            <div class="contact-title">
                <i class="bi bi-chat-dots-fill text-primary"></i>
                Hubungi Saya
            </div>

            <div class="contact-buttons">

                <a href="mailto:naysafau@gmail.com"
                   class="contact-btn btn-email">

                    <i class="bi bi-envelope-fill"></i>
                    Email

                </a>


                <a href="https://instagram.com/nysfziii_"
                   target="_blank"
                   class="contact-btn btn-instagram">

                    <i class="bi bi-instagram"></i>
                    Instagram

                </a>


                <a href="https://github.com/242510305-hub/pos_enay4"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="contact-btn btn-github">

                    <i class="bi bi-github"></i>
                    GitHub

                </a>


                <a href="{{ route('dashboard') }}"
                   class="contact-btn btn-home">

                    <i class="bi bi-house-fill"></i>
                    Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="about-footer">

        <i class="bi bi-heart-fill text-danger"></i>

        Dibuat untuk Aplikasi Point of Sale

        <br>

        © {{ date('Y') }} Naysa Fauziah

    </div>

</div>

@endsection