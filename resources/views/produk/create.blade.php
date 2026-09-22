@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold text-dark mb-0">Tambah Produk Baru</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-medium">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama produk" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
    <label for="jenis_id" class="form-label fw-medium">Jenis Produk <span class="text-danger">*</span></label>
    <select class="form-select @error('jenis_id') is-invalid @enderror" id="jenis_id" name="jenis_id" required>
        <option value="" disabled {{ old('jenis_id') ? '' : 'selected' }}>-- Pilih Jenis Produk --</option>
        @foreach ($jenisList as $jenis)
            <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
                {{ $jenis->nama_jenis }}
            </option>
        @endforeach
    </select>
    @error('jenis_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($jenisList->isEmpty())
        <small class="text-danger d-block mt-1">
            Belum ada data jenis. <a href="{{ route('admin.jenis.create') }}">Tambah jenis dulu</a>.
        </small>
    @endif
</div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="harga_beli" class="form-label fw-medium">Harga pokok (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" placeholder="0" required>
                                @error('harga_beli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga_jual" class="form-label fw-medium">Harga Jual (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" placeholder="0" required>
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label fw-medium">Stok Produk <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', 0) }}" placeholder="0" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="form-label fw-medium">Gambar Produk</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-3">
                                <p class="small text-muted mb-1">Preview Foto Baru:</p>
                                <div style="width: 120px; height: 120px;" class="rounded-3 border overflow-hidden bg-light d-flex align-items-center justify-content-center">
                                    <img id="img-preview" src="#" alt="Preview Foto" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    <span id="preview-placeholder" class="text-muted small">Belum ada foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4 rounded-3 fw-medium">
                                <i class="bi bi-check-lg me-1"></i> Simpan
                            </button>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary px-4 rounded-3 fw-medium">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('img-preview');
        const placeholder = document.getElementById('preview-placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection