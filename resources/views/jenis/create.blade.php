@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-tags-fill text-primary me-2"></i>
                Tambah Jenis
            </h3>
            <p class="text-muted mb-0">
                Tambahkan jenis produk baru
            </p>
        </div>

        <a href="{{ route('admin.jenis.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- Form --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.jenis.store') }}" method="POST">
                @csrf

                {{-- Nama Jenis --}}
                <div class="mb-4">
                    <label for="nama_jenis" class="form-label fw-semibold">
                        Nama Jenis
                    </label>

                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white border-0">
                            <i class="bi bi-tag-fill"></i>
                        </span>

                        <input type="text"
                               id="nama_jenis"
                               name="nama_jenis"
                               value="{{ old('nama_jenis') }}"
                               class="form-control @error('nama_jenis') is-invalid @enderror"
                               placeholder="Contoh: Makanan, Minuman, Snack"
                               required>

                        @error('nama_jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.jenis.index') }}"
                       class="btn btn-light border rounded-pill px-4">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-1"></i>
                        Simpan Jenis
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection