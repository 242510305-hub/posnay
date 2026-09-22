@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <h4 class="card-title mb-4">Edit Produk</h4>

            <form action="{{ route('admin.produk.update', $produk) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @method('PUT')
                @include('Produk._form')
            </form>
        </div>
    </div>
</div>
@endsection