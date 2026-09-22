@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<style>
    /* =========================
       GRADIENT HEADER
    ========================= */
    .header-banner {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 16px;
    }

    /* =========================
       CARD
    ========================= */
    .card {
        border-radius: 16px !important;
        border: none;
    }

    /* =========================
       TABLE
    ========================= */
    .table {
        vertical-align: middle;
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.8px;
        color: #6c757d;
        background-color: #f8f9fa;
        border-bottom: 1px solid #edf2f7;
        padding-top: 1rem;
        padding-bottom: 1rem;
        white-space: nowrap;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
    }

    /* =========================
       PRODUCT IMAGE
    ========================= */
    .product-img-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e9ecef;
    }

    .product-img-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .table tbody tr:hover .product-img-thumb {
        transform: scale(1.1);
    }

    /* =========================
       STOCK BADGES
    ========================= */
    .badge-soft-success {
        background-color: #d1e7dd;
        color: #0f5132;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 30px;
    }

    .badge-soft-warning {
        background-color: #fff3cd;
        color: #856404;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 30px;
    }

    .badge-soft-danger {
        background-color: #f8d7da;
        color: #842029;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 30px;
    }

    /* =========================
       JENIS BADGE
    ========================= */
    .badge-jenis {
        background-color: #e7f1ff;
        color: #0d6efd;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 30px;
        display: inline-block;
        white-space: nowrap;
    }

    /* =========================
       SEARCH
    ========================= */
    .search-input-group .form-control {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-color: #dee2e6;
    }

    .search-input-group .btn {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* =========================
       ACTION BUTTON
    ========================= */
    .btn-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }
</style>


<div class="container py-4">

    {{-- =========================
         HEADER
    ========================= --}}
    <div class="header-banner text-white p-4 mb-4 shadow-sm">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <h2 class="fw-bold mb-1">
                    Daftar Produk
                </h2>

                <p class="mb-0 text-white-50 small">
                    Kelola katalog item produk, penyesuaian harga jual/beli,
                    serta ketersediaan stok inventaris Anda.
                </p>
            </div>

            <div>

                @can('create', App\Models\Produk::class)

                    <a href="{{ route('admin.produk.create') }}"
                       class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">

                        <i class="bi bi-plus-lg fs-6"></i>

                        <span>
                            Tambah Produk
                        </span>

                    </a>

                @endcan

            </div>

        </div>

    </div>


    {{-- =========================
         CARD TABLE
    ========================= --}}
    <div class="card shadow-sm">

        <div class="card-body p-4">


            {{-- =========================
                 SEARCH
            ========================= --}}
            <form action="{{ route('admin.produk.index') }}"
                  method="GET"
                  class="mb-4">

                <div class="row g-2">

                    <div class="col-md-6 col-lg-4">

                        <div class="input-group search-input-group">

                            <span class="input-group-text bg-white border-end-0 text-muted px-3">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-start-0 ps-0"
                                placeholder="Cari nama produk..."
                            >

                            <button
                                class="btn btn-primary px-4 fw-medium"
                                type="submit">

                                Cari

                            </button>

                        </div>

                    </div>


                    @if(request('search'))

                        <div class="col-auto">

                            <a href="{{ route('admin.produk.index') }}"
                               class="btn btn-outline-secondary d-inline-flex align-items-center gap-1 rounded-3">

                                <i class="bi bi-x-circle"></i>

                                <span>
                                    Reset Filter
                                </span>

                            </a>

                        </div>

                    @endif

                </div>

            </form>


            {{-- =========================
                 TABLE
            ========================= --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th scope="col"
                                class="ps-3"
                                style="width: 5%">
                                #
                            </th>

                            <th scope="col"
                                style="width: 8%">
                                Foto
                            </th>

                            <th scope="col">
                                Nama Produk
                            </th>

                            {{-- JENIS --}}
                            <th scope="col">
                                Jenis
                            </th>

                            <th scope="col">
                                Dibuat Oleh
                            </th>

                            <th scope="col">
                                Harga pokok
                            </th>

                            <th scope="col">
                                Harga Jual
                            </th>

                            <th scope="col"
                                class="text-center">
                                Stok
                            </th>

                            <th scope="col"
                                class="text-end pe-3"
                                style="width: 12%">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($products as $product)

                            <tr>

                                {{-- NOMOR --}}
                                <th scope="row"
                                    class="ps-3 text-muted fw-normal">

                                    {{ $products->firstItem() + $loop->index }}

                                </th>


                                {{-- FOTO --}}
                                <td>

                                    <div class="product-img-wrapper">

                                        @if($product->foto)

                                            <img
                                                src="{{ asset('storage/' . $product->foto) }}"
                                                alt="{{ $product->nama }}"
                                                class="product-img-thumb">

                                        @else

                                            <i class="bi bi-image text-muted fs-5"></i>

                                        @endif

                                    </div>

                                </td>


                                {{-- NAMA PRODUK --}}
                                <td>

                                    <div class="fw-bold text-dark">

                                        {{ $product->nama }}

                                    </div>

                                </td>


                                {{-- JENIS PRODUK --}}
                                <td>

                                    @if($product->jenis)

                                        <span class="badge-jenis">

                                            <i class="bi bi-tag me-1"></i>

                                            {{ $product->jenis->nama_jenis }}

                                        </span>

                                    @else

                                        <span class="text-muted small">

                                            Belum ada jenis

                                        </span>

                                    @endif

                                </td>


                                {{-- DIBUAT OLEH --}}
                                <td>

                                    <span class="text-muted small">

                                        <i class="bi bi-person me-1"></i>

                                        {{ $product->user->name ?? '-' }}

                                    </span>

                                </td>


                                {{-- HARGA pokok --}}
                                <td class="text-muted small">

                                    Rp
                                    {{ number_format($product->harga_beli, 0, ',', '.') }}

                                </td>


                                {{-- HARGA JUAL --}}
                                <td>

                                    <span class="fw-bold text-success">

                                        Rp
                                        {{ number_format($product->harga_jual, 0, ',', '.') }}

                                    </span>

                                </td>


                                {{-- STOK --}}
                                <td class="text-center">

                                    @if($product->stok > 10)

                                        <span class="badge badge-soft-success">

                                            {{ $product->stok }}

                                        </span>

                                    @elseif($product->stok > 0)

                                        <span class="badge badge-soft-warning">

                                            {{ $product->stok }}

                                        </span>

                                    @else

                                        <span class="badge badge-soft-danger">

                                            Habis

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end pe-3">

                                    <div class="d-inline-flex gap-1">


                                        {{-- EDIT --}}
                                        @can('update', $product)

                                            <a
                                                href="{{ route('admin.produk.edit', $product) }}"
                                                class="btn btn-sm btn-outline-warning btn-action"
                                                title="Edit Produk">

                                                <i class="bi bi-pencil"></i>

                                            </a>

                                        @endcan


                                        {{-- HAPUS --}}
                                        @can('delete', $product)

                                            <form
                                                action="{{ route('admin.produk.destroy', $product) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger btn-action"
                                                    title="Hapus Produk"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        @endcan

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                {{-- 9 KOLOM --}}
                                <td colspan="9"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-box-seam display-6 d-block mb-2 text-secondary opacity-50"></i>

                                        <h6 class="fw-bold mb-1">
                                            Data Produk Tidak Ditemukan
                                        </h6>

                                        <p class="small mb-0">
                                            Coba ubah kata kunci pencarian Anda
                                            atau tambahkan produk baru.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =========================
                 PAGINATION
            ========================= --}}
            <!-- @if($products->hasPages())

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">

                    <div class="text-muted small">

                        Menampilkan

                        <strong>
                            {{ $products->firstItem() }}
                        </strong>

                        -

                        <strong>
                            {{ $products->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $products->total() }}
                        </strong>

                        produk

                    </div>


                    <div>

                        {{ $products->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>

</div> -->


@endsection