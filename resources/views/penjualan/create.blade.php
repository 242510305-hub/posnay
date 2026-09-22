@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 text-dark fw-bold mb-0">Tambah Transaksi Penjualan</h1>
                <a href="{{ route('admin.penjualan.index') }}" class="btn btn-outline-secondary btn-sm">
                    Kembali
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">

                    {{-- PERHATIKAN: action diarahkan ke admin.penjualan.store (BUKAN create) --}}
                    <form action="{{ route('admin.penjualan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal Transaksi</label>
                            <input 
                                type="date" 
                                name="tanggal" 
                                id="tanggal" 
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                required
                            >
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label fw-semibold">Catatan</label>
                            <textarea 
                                name="catatan" 
                                id="catatan" 
                                rows="3" 
                                class="form-control @error('catatan') is-invalid @enderror"
                                placeholder="Masukkan catatan transaksi jika ada..."
                            >{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.penjualan.index') }}" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                Simpan Penjualan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection