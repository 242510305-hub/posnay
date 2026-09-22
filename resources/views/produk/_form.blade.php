@csrf

{{-- FOTO LAMA --}}
@if (!empty($produk->foto))
    <div class="mb-3">
        <label class="form-label font-weight-bold">Foto Saat Ini</label><br>

        <img src="{{ asset('storage/' . $produk->foto) }}"
             width="150"
             class="img-thumbnail rounded">
    </div>
@endif


{{-- UPLOAD FOTO --}}
<div class="row mb-3">

    <div class="col-md-6">
        <label class="form-label font-weight-bold">Gambar</label>

        <input type="file"
               name="foto"
               onchange="previewImage(this)"
               class="form-control @error('foto') is-invalid @enderror">

        @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="col-md-6">

        <label class="form-label font-weight-bold">
            Preview Foto Baru
        </label>

        <br>

        <img id="preview"
             class="img-thumbnail mt-2"
             style="display:none"
             width="150">

    </div>

</div>


{{-- NAMA PRODUK --}}
<div class="mb-3">

    <label class="form-label font-weight-bold">
        Nama Produk
    </label>

    <input type="text"
           name="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $produk->nama ?? '') }}"
           required>

    @error('nama')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- JENIS PRODUK --}}
<div class="mb-3">

    <label class="form-label font-weight-bold">
        Jenis Produk
    </label>

    <select name="jenis_id"
            class="form-select @error('jenis_id') is-invalid @enderror"
            required>

        <option value="">-- Pilih Jenis Produk --</option>

        @foreach ($jenis as $item)
            <option value="{{ $item->id }}"
                {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_jenis }}
            </option>
        @endforeach

    </select>

    @error('jenis_id')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- HARGA pokok --}}
<div class="mb-3">

    <label class="form-label font-weight-bold">
        Harga Pokok
    </label>

    <input type="number"
           name="harga_beli"
           class="form-control @error('harga_beli') is-invalid @enderror"
           value="{{ old('harga_beli', $produk->harga_beli ?? '') }}"
           required>

    @error('harga_beli')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- HARGA JUAL --}}
<div class="mb-3">

    <label class="form-label font-weight-bold">
        Harga Jual
    </label>

    <input type="number"
           name="harga_jual"
           class="form-control @error('harga_jual') is-invalid @enderror"
           value="{{ old('harga_jual', $produk->harga_jual ?? '') }}"
           required>

    @error('harga_jual')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- STOK --}}
<div class="mb-3">

    <label class="form-label font-weight-bold">
        Stok
    </label>

    <input type="number"
           name="stok"
           class="form-control @error('stok') is-invalid @enderror"
           value="{{ old('stok', $produk->stok ?? '') }}"
           required>

    @error('stok')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- TOMBOL --}}
<div class="d-flex gap-2 mt-4">

    <button type="submit"
            class="btn btn-success px-4">
        Simpan
    </button>

    <a href="{{ route('admin.produk.index') }}"
       class="btn btn-secondary px-4">
        Kembali
    </a>

</div>


<script>
function previewImage(input) {

    const preview = document.getElementById('preview');
    const file = input.files[0];

    if (file) {

        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';

    } else {

        preview.style.display = 'none';

    }
}
</script>