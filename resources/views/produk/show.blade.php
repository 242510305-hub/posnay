@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    @include('layouts.navbar')

    <main class="container py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h1 class="h4 fw-bold mb-3">{{ $produk->nama }}</h1>
                <p class="mb-2">Harga jual: Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
                <p class="mb-3">Stok: {{ $produk->stok }}</p>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </main>
@endsection