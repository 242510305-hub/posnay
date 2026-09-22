@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<style>

    body {
        background: #f5f7fb;
    }

    /* =========================
       GLOBAL
    ========================= */

    .dashboard-container {
        max-width: 1400px;
        margin: auto;
    }

    .text-muted-custom {
        color: #7b8494;
    }


    /* =========================
       WELCOME HEADER
    ========================= */

    .welcome-card {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        padding: 30px;
        background: linear-gradient(
            135deg,
            #2563eb,
            #3b82f6,
            #60a5fa
        );
        box-shadow: 0 15px 35px rgba(37, 99, 235, 0.20);
    }

    .welcome-card::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -70px;
        top: -90px;
    }

    .welcome-card::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        right: 120px;
        bottom: -90px;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .welcome-title {
        font-size: 30px;
        font-weight: 800;
        color: white;
        margin-bottom: 6px;
    }

    .welcome-subtitle {
        color: rgba(255,255,255,.80);
        margin-bottom: 0;
    }


    /* =========================
       PROFILE BOX
    ========================= */

    .profile-box {
        position: relative;
        z-index: 2;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.16);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 12px 16px;
        min-width: 280px;
    }

    .profile-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: white;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        font-weight: 800;
    }

    .profile-name {
        color: white;
        font-weight: 700;
        font-size: 14px;
    }

    .profile-role {
        color: rgba(255,255,255,.65);
        font-size: 12px;
    }


    /* =========================
       PAGE TITLE
    ========================= */

    .page-title {
        font-size: 30px;
        font-weight: 800;
        color: #111827;
    }

    .date-text {
        color: #6b7280;
        font-size: 14px;
    }


    /* =========================
       STAT CARDS
    ========================= */

    .stat-card {
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 18px;
        background: white;
        box-shadow: 0 6px 20px rgba(15,23,42,.06);
        transition: all .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(15,23,42,.10);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        right: -35px;
        bottom: -40px;
        background: rgba(37,99,235,.05);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #111827;
    }

    .stat-label {
        font-size: 13px;
        color: #7b8494;
        font-weight: 600;
    }


    /* =========================
       SECTION TITLE
    ========================= */

    .section-title {
        font-size: 19px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .section-subtitle {
        color: #8a93a3;
        font-size: 13px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* =========================
       CONTENT CARD
    ========================= */

    .content-card {
        background: white;
        border: 0;
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(15,23,42,.06);
        overflow: hidden;
    }

    .content-header {
        padding: 20px 22px 12px;
    }


    /* =========================
       TABLE
    ========================= */

    .dashboard-table {
        margin-bottom: 0;
    }

    .dashboard-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: 14px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .dashboard-table tbody td {
        padding: 14px 20px;
        border-color: #eef1f5;
        vertical-align: middle;
        font-size: 14px;
    }

    .dashboard-table tbody tr {
        transition: background .2s ease;
    }

    .dashboard-table tbody tr:hover {
        background: #f8fbff;
    }


    /* =========================
       STOCK BADGE
    ========================= */

    .stock-badge {
        min-width: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 9px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
    }

    .stock-low {
        background: #fff4cc;
        color: #d97706;
    }

    .stock-empty {
        background: #fee2e2;
        color: #dc2626;
    }


    /* =========================
       PRODUCT NAME
    ========================= */

    .product-name {
        font-weight: 700;
        color: #1f2937;
    }

    .product-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* =========================
       BEST SELLER RANK
    ========================= */

    .rank-number {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
    }

    .sales-number {
        color: #2563eb;
        font-weight: 800;
    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: #94a3b8;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #ecfdf5;
        color: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        font-size: 25px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .welcome-card {
            padding: 22px;
        }

        .welcome-title {
            font-size: 24px;
        }

        .profile-box {
            min-width: 100%;
        }

        .page-title {
            font-size: 25px;
        }

        .dashboard-table thead th,
        .dashboard-table tbody td {
            white-space: nowrap;
        }

    }

</style>


<div class="container-fluid px-3 px-md-4 py-4 dashboard-container">


    {{-- =====================================================
         WELCOME HEADER
    ====================================================== --}}

    <div class="welcome-card mb-4">

        <div class="d-flex flex-column flex-lg-row
                    justify-content-between
                    align-items-lg-center
                    gap-4">

            <div class="welcome-content">

                <div class="d-flex align-items-center gap-2 mb-2">

                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                        <i class="bi bi-shop me-1"></i>
                      
                    </span>

                </div>

                <h1 class="welcome-title">

                    Selamat Datang,
                    {{ auth()->user()->name ?? 'Admin' }}! 👋

                </h1>

                <p class="welcome-subtitle">

                    Pantau performa toko dan kondisi inventaris
                    Anda hari ini.

                </p>

            </div>


            {{-- PROFILE --}}
            <div class="profile-box">

                <div class="d-flex align-items-center gap-3">

                    <div class="profile-avatar">

                        {{ strtoupper(
                            substr(
                                auth()->user()->name ?? 'A',
                                0,
                                1
                            )
                        ) }}

                    </div>

                    <div>

                        <div class="profile-name">

                            {{ auth()->user()->name ?? 'Admin' }}

                        </div>

                        <div class="profile-role">

                            <i class="bi bi-person-badge me-1"></i>

                            {{ auth()->user()->role->name ?? 'Admin' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PAGE TITLE
    ====================================================== --}}

    <div class="text-center mb-4">

        <h2 class="page-title mb-1">
            Ringkasan Hari Ini
        </h2>

        <div class="date-text">

            <i class="bi bi-calendar3 me-1"></i>

            {{ now()->translatedFormat('l, d F Y') }}

        </div>

    </div>


    {{-- =====================================================
         STATISTIC CARDS
    ====================================================== --}}

    <div class="row g-3 mb-4">

        {{-- TOTAL PRODUK --}}
        <div class="col-6 col-xl-3">

            <div class="stat-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="stat-label mb-2">
                                Total Produk
                            </div>

                            <div class="stat-number">

                                {{ $totalProduk ?? 0 }}

                            </div>

                        </div>

                        <div class="stat-icon bg-primary-subtle text-primary">

                            <i class="bi bi-box-seam-fill"></i>

                        </div>

                    </div>

                    <div class="small text-muted-custom mt-3">

                        <i class="bi bi-box me-1"></i>
                        Produk tersedia di toko

                    </div>

                </div>

            </div>

        </div>


        {{-- STOK RENDAH --}}
        <div class="col-6 col-xl-3">

            <div class="stat-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="stat-label mb-2">
                                Stok Rendah
                            </div>

                            <div class="stat-number text-warning">

                                {{ $jumlahLowStock ?? 0 }}

                            </div>

                        </div>

                        <div class="stat-icon bg-warning-subtle text-warning">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                        </div>

                    </div>

                    <div class="small text-muted-custom mt-3">

                        <i class="bi bi-arrow-down-circle me-1"></i>
                        Perlu segera diperhatikan

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUK HABIS --}}
        <div class="col-6 col-xl-3">

            <div class="stat-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="stat-label mb-2">
                                Produk Habis
                            </div>

                            <div class="stat-number text-danger">

                                {{ $jumlahOutOfStock ?? 0 }}

                            </div>

                        </div>

                        <div class="stat-icon bg-danger-subtle text-danger">

                            <i class="bi bi-x-circle-fill"></i>

                        </div>

                    </div>

                    <div class="small text-muted-custom mt-3">

                        <i class="bi bi-box-seam me-1"></i>
                        Produk perlu restock

                    </div>

                </div>

            </div>

        </div>


        {{-- BEST SELLER --}}
        <div class="col-6 col-xl-3">

            <div class="stat-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="stat-label mb-2">
                                Best Seller
                            </div>

                            <div class="stat-number text-info">

                                {{ $jumlahBestSellers ?? 0 }}

                            </div>

                        </div>

                        <div class="stat-icon bg-info-subtle text-info">

                            <i class="bi bi-trophy-fill"></i>

                        </div>

                    </div>

                    <div class="small text-muted-custom mt-3">

                        <i class="bi bi-graph-up-arrow me-1"></i>
                        Produk dengan penjualan tertinggi

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         CRITICAL INVENTORY
    ====================================================== --}}

    <div class="d-flex align-items-center gap-3 mb-3">

        <div class="section-icon bg-warning-subtle text-warning">

            <i class="bi bi-box-seam-fill"></i>

        </div>

        <div>

            <div class="section-title">
                Critical Inventory Status
            </div>

            <div class="section-subtitle">
                Pantau produk yang membutuhkan perhatian
            </div>

        </div>

    </div>


    <div class="row g-4 mb-5">


        {{-- STOK RENDAH --}}
        <div class="col-lg-6">

            <div class="content-card h-100">

                <div class="content-header">

                    <div class="d-flex align-items-center gap-2">

                        <i class="bi bi-exclamation-triangle-fill text-warning"></i>

                        <strong>
                            Produk Stok Rendah
                        </strong>

                    </div>

                    <small class="text-muted-custom">
                        Produk dengan stok di bawah batas aman
                    </small>

                </div>


                <div class="table-responsive">

                    <table class="table dashboard-table">

                        <thead>

                            <tr>

                                <th style="width: 60px;">
                                    #
                                </th>

                                <th>
                                    Nama Produk
                                </th>

                                <th class="text-end">
                                    Sisa Stok
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($lowStock ?? [] as $index => $product)

                                <tr>

                                    <td>

                                        <div class="rank-number">
                                            {{ $index + 1 }}
                                        </div>

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="product-icon">

                                                <i class="bi bi-box"></i>

                                            </div>

                                            <span class="product-name">

                                                {{ $product->nama }}

                                            </span>

                                        </div>

                                    </td>

                                    <td class="text-end">

                                        <span class="stock-badge stock-low">

                                            {{ $product->stok }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3">

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bi bi-check-lg"></i>

                                            </div>

                                            <strong class="d-block text-dark">
                                                Stok aman
                                            </strong>

                                            <small>
                                                Tidak ada produk dengan stok rendah.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- PRODUK HABIS --}}
        <div class="col-lg-6">

            <div class="content-card h-100">

                <div class="content-header">

                    <div class="d-flex align-items-center gap-2">

                        <i class="bi bi-x-circle text-danger"></i>

                        <strong>
                            Produk Habis Stok
                        </strong>

                    </div>

                    <small class="text-muted-custom">
                        Produk yang saat ini tidak tersedia
                    </small>

                </div>


                <div class="table-responsive">

                    <table class="table dashboard-table">

                        <thead>

                            <tr>

                                <th style="width: 60px;">
                                    #
                                </th>

                                <th>
                                    Nama Produk
                                </th>

                                <th class="text-end">
                                    Stok
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($outOfStock ?? [] as $index => $product)

                                <tr>

                                    <td>

                                        <div class="rank-number">

                                            {{ $index + 1 }}

                                        </div>

                                    </td>


                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="product-icon"
                                                 style="
                                                    background:#fef2f2;
                                                    color:#ef4444;
                                                 ">

                                                <i class="bi bi-box-seam"></i>

                                            </div>

                                            <span class="product-name">

                                                {{ $product->nama }}

                                            </span>

                                        </div>

                                    </td>


                                    <td class="text-end">

                                        <span class="stock-badge stock-empty">

                                            {{ $product->stok }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3">

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bi bi-check-circle"></i>

                                            </div>

                                            <strong class="d-block text-dark">

                                                Stok masih tersedia

                                            </strong>

                                            <small>

                                                Tidak ada produk yang habis.

                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         BEST SELLER
    ====================================================== --}}

    <div class="d-flex align-items-center gap-3 mb-3">

        <div class="section-icon bg-info-subtle text-info">

            <i class="bi bi-trophy-fill"></i>

        </div>

        <div>

            <div class="section-title">
                Best Seller Products
            </div>

            <div class="section-subtitle">
                Produk dengan jumlah penjualan tertinggi
            </div>

        </div>

    </div>


    <div class="content-card mb-5">

        <div class="table-responsive">

            <table class="table dashboard-table">

                <thead>

                    <tr>

                        <th style="width: 70px;">
                            Rank
                        </th>

                        <th>
                            Nama Produk
                        </th>

                        <th class="text-center">
                            Sisa Stok
                        </th>

                        <th class="text-end">
                            Unit Terjual
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($bestSellers ?? [] as $index => $product)

                        <tr>

                            <td>

                                <div class="rank-number">

                                    {{ $index + 1 }}

                                </div>

                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="product-icon">

                                        <i class="bi bi-star-fill"></i>

                                    </div>

                                    <span class="product-name">

                                        {{ $product->nama }}

                                    </span>

                                </div>

                            </td>


                            <td class="text-center">

                                <span class="stock-badge
                                    {{ $product->stok <= 5
                                        ? 'stock-low'
                                        : 'bg-light text-dark'
                                    }}">

                                    {{ $product->stok }}

                                </span>

                            </td>


                            <td class="text-end">

                                <span class="sales-number">

                                    {{ $product->unit_terjual ?? 0 }}

                                </span>

                                <small class="text-muted">
                                    unit
                                </small>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                <div class="empty-state">

                                    <div class="empty-icon">

                                        <i class="bi bi-bar-chart"></i>

                                    </div>

                                    <strong class="d-block text-dark">

                                        Belum ada data penjualan

                                    </strong>

                                    <small>

                                        Data best seller akan muncul setelah ada transaksi.

                                    </small>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="text-center text-muted-custom small pb-3">

        <i class="bi bi-shield-check me-1"></i>

        POS Naysa &copy; {{ date('Y') }}

        <span class="mx-2">•</span>

        Sistem Manajemen Penjualan

    </div>


</div>

@endsection