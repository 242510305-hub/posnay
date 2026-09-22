@extends('layouts.app')

@section('title', 'Login - POS System')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .login-container {
        background: linear-gradient(135deg, #0b0b0c 0%, #47515f 50%, #004085 100%);
    }
    .login-card {
        border-radius: 1.25rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    .input-group-text {
        border-color: #dee2e6;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    .btn-login {
        background: linear-gradient(135deg, #585a5e 0%, #0b5ed7 100%);
        transition: all 0.2s ease-in-out;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3);
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>

<div class="min-vh-100 d-flex align-items-center justify-content-center py-5 login-container">

    <div class="card border-0 login-card overflow-hidden w-100 mx-3" style="max-width: 400px;">
        
        {{-- Header Card --}}
        <div class="text-white p-4 text-center" style="background-color: #003366;">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle p-3 mb-2 shadow-sm" style="width: 65px; height: 65px;">
                <i class="bi bi-cart-check-fill fs-2 text-primary"></i>
            </div>
            <h4 class="fw-bold mb-1">Login POS</h4>
            <p class="small text-white-50 mb-0">Masuk untuk mengelola transaksi</p>
        </div>

        {{-- Body Card --}}
        <div class="card-body p-4 bg-white">

            {{-- Pesan Error Flash Session --}}
            @if(session('error'))
                <div class="alert alert-danger border-0 text-danger small py-2 px-3 mb-3 d-flex align-items-center gap-2 rounded-3" style="background-color: #f8d7da;">
                    <i class="bi bi-exclamation-circle-fill fs-6"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('auth') }}" method="POST">
                @csrf

                {{-- Input Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary small mb-1">
                        <i class="bi bi-envelope-fill me-1 text-primary"></i> Alamat Email
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror" 
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 d-flex align-items-center gap-1">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Password dengan Toggle Mata --}}
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary small mb-1">
                        <i class="bi bi-lock-fill me-1 text-primary"></i> Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0">
                            <i class="bi bi-key"></i>
                        </span>
                        <input 
                            type="password" 
                            id="passwordInput"
                            name="password" 
                            class="form-control bg-light border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" 
                            placeholder="••••••••"
                            required
                        >
                        <span class="input-group-text bg-light text-muted border-start-0 cursor-pointer" id="togglePassword">
                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 d-flex align-items-center gap-1">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="btn btn-primary btn-login w-100 py-2.5 fw-bold rounded-3 text-white border-0 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span>Masuk ke Sistem</span>
                </button>
            </form>

        </div>

        {{-- Footer Card --}}
        <div class="card-footer bg-light text-center py-3 border-0">
            <small class="text-muted" style="font-size: 12px;">
                POS System &copy; {{ date('Y') }}
            </small>
        </div>