@extends('layouts.app')

@section('content')

    <div class="container py-4">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-tags-fill text-primary me-2"></i>
                    Data Jenis Produk
                </h3>

                <p class="text-muted mb-0">
                    Kelola jenis atau kategori produk yang tersedia.
                </p>
            </div>

            @if(auth()->user()->role?->name === 'admin')
                <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">

                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Jenis

                </a>
            @endif

        </div>


        {{-- ================= CARD ================= --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            {{-- Card Header --}}
            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Daftar Jenis
                        </h5>

                        <small class="text-muted">
                            Total {{ $jenis->total() }} jenis
                        </small>
                    </div>

                    <div class="bg-primary-subtle text-primary rounded-3 p-2">

                        <i class="bi bi-tags-fill fs-5"></i>

                    </div>

                </div>

            </div>


            {{-- ================= TABLE ================= --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4 py-3" style="width: 80px;">
                                No
                            </th>

                            <th class="py-3">
                                Nama Jenis
                            </th>

                            <th class="py-3">
                                Dibuat
                            </th>

                            <th class="text-center py-3" style="width: 180px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        {{-- Jika ada data --}}
                        @forelse($jenis as $item)

                            <tr>

                                {{-- Nomor --}}
                                <td class="px-4 fw-semibold text-muted">

                                    {{ $jenis->firstItem() + $loop->index }}

                                </td>


                                {{-- Nama Jenis --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="bg-primary-subtle text-primary rounded-3
                                                        d-flex align-items-center justify-content-center"
                                            style="width: 42px; height: 42px;">

                                            <i class="bi bi-tag-fill"></i>

                                        </div>


                                        <div>

                                            <div class="fw-semibold">
                                                {{ $item->nama_jenis }}
                                            </div>

                                            <small class="text-muted">
                                                ID #{{ $item->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Tanggal Dibuat --}}
                                <td>

                                    <span class="text-muted">

                                        {{ $item->created_at?->format('d M Y') }}

                                    </span>

                                </td>


                                {{-- Aksi --}}
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        @if(auth()->user()->role?->name === 'admin')
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.jenis.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Edit">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.jenis.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus jenis ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    title="Hapus">

                                                    <i class="bi bi-trash3-fill"></i>

                                                </button>

                                            </form>
                                        @else
                                            <span class="text-muted small">Lihat saja</span>
                                        @endif

                                    </div>

                                </td>

                            </tr>


                            {{-- Jika belum ada data --}}
                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-tags fs-1 d-block mb-3"></i>

                                        <h5 class="fw-semibold">
                                            Belum ada jenis
                                        </h5>

                                        <p class="mb-3">
                                            Belum ada data jenis produk.
                                        </p>

                                        <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary rounded-pill px-4">

                                            <i class="bi bi-plus-lg me-1"></i>
                                            Tambah Jenis

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= PAGINATION ================= --}}
            @if($jenis->hasPages())

                <div class="card-footer bg-white border-0 px-4 py-3">

                    {{ $jenis->links() }}

                </div>

            @endif

        </div>


        {{-- ================= KEMBALI ================= --}}
        <div class="mt-4">

            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">

                <i class="bi bi-house-fill me-2"></i>
                Kembali ke Dashboard

            </a>

        </div>

    </div>

@endsection