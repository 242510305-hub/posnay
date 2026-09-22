@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

    body {
        background: #f5f7fb;
    }

    .users-container {
        max-width: 1400px;
        margin: auto;
    }

    /* HEADER */
    .page-header {
        background: linear-gradient(
            135deg,
            #2563eb,
            #3b82f6,
            #60a5fa
        );
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        box-shadow: 0 12px 30px rgba(37, 99, 235, .18);
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -50px;
        top: -70px;
    }

    .page-header-content {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .page-subtitle {
        margin: 0;
        color: rgba(255,255,255,.80);
        font-size: 14px;
    }

    .add-user-btn {
        position: relative;
        z-index: 2;
        background: white;
        color: #2563eb;
        border: none;
        border-radius: 12px;
        padding: 11px 18px;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(0,0,0,.10);
        transition: .2s;
    }

    .add-user-btn:hover {
        transform: translateY(-2px);
        background: #f8fafc;
        color: #1d4ed8;
    }


    /* MAIN CARD */
    .users-card {
        background: white;
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 22px rgba(15,23,42,.06);
        overflow: hidden;
    }

    .users-card-header {
        padding: 22px 24px;
        border-bottom: 1px solid #eef1f5;
    }

    .section-title {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
    }

    .section-subtitle {
        color: #8a93a3;
        font-size: 13px;
    }


    /* SEARCH */
    .search-box {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }

    .search-box input {
        border: none;
        box-shadow: none !important;
        padding: 11px 14px;
    }

    .search-box input:focus {
        border: none;
    }

    .search-btn {
        border: none;
        background: #2563eb;
        color: white;
        padding: 0 18px;
        font-weight: 600;
    }

    .search-btn:hover {
        background: #1d4ed8;
    }


    /* TABLE */
    .users-table {
        margin-bottom: 0;
    }

    .users-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: 15px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .users-table tbody td {
        padding: 15px 20px;
        border-color: #eef1f5;
        vertical-align: middle;
    }

    .users-table tbody tr {
        transition: .2s;
    }

    .users-table tbody tr:hover {
        background: #f8fbff;
    }


    /* NUMBER */
    .number-badge {
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


    /* USER */
    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(
            135deg,
            #dbeafe,
            #eff6ff
        );
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 13px;
    }

    .user-name {
        font-weight: 700;
        color: #1f2937;
    }

    .user-email {
        color: #64748b;
        font-size: 13px;
    }


    /* ROLE */
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
    }

    .role-admin {
        background: #dbeafe;
        color: #2563eb;
    }

    .role-kasir {
        background: #cffafe;
        color: #0891b2;
    }


    /* ACTION */
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: .2s;
    }

    .action-edit {
        background: #fff7ed;
        color: #f59e0b;
    }

    .action-edit:hover {
        background: #f59e0b;
        color: white;
    }

    .action-delete {
        background: #fef2f2;
        color: #ef4444;
    }

    .action-delete:hover {
        background: #ef4444;
        color: white;
    }


    /* EMPTY */
    .empty-state {
        text-align: center;
        padding: 55px 20px;
        color: #94a3b8;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        font-size: 27px;
        margin-bottom: 15px;
    }


    /* PAGINATION */
    .pagination-wrapper {
        padding: 18px 24px;
        border-top: 1px solid #eef1f5;
    }


    /* MOBILE */
    @media (max-width: 768px) {

        .page-header {
            padding: 22px;
        }

        .page-title {
            font-size: 24px;
        }

        .add-user-btn {
            width: 100%;
        }

        .users-table th,
        .users-table td {
            white-space: nowrap;
        }

    }

</style>


<div class="container-fluid px-3 px-md-4 py-4 users-container">


    {{-- ================================
         HEADER
    ================================= --}}

    <div class="page-header mb-4">

        <div class="d-flex flex-column flex-md-row
                    justify-content-between
                    align-items-md-center
                    gap-3">

            <div class="page-header-content">

                <div class="mb-2">

                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill">

                        <i class="bi bi-people-fill me-1"></i>

                        Manajemen Pengguna

                    </span>

                </div>

                <h1 class="page-title">
                    Halaman Users
                </h1>

                <p class="page-subtitle">

                    Kelola pengguna dan hak akses sistem POS Naysa.

                </p>

            </div>


            {{-- TAMBAH USER --}}
            <div>

                <a href="{{ route('admin.users.create') }}"
                   class="add-user-btn d-inline-flex
                          align-items-center gap-2
                          text-decoration-none">

                    <i class="bi bi-person-plus-fill"></i>

                    Tambah User

                </a>

            </div>

        </div>

    </div>


    {{-- ================================
         USERS CARD
    ================================= --}}

    <div class="users-card">


        {{-- CARD HEADER --}}
        <div class="users-card-header">

            <div class="d-flex flex-column flex-lg-row
                        justify-content-between
                        align-items-lg-center
                        gap-3">

                <div>

                    <div class="section-title">

                        <i class="bi bi-people-fill text-primary me-2"></i>

                        Daftar Pengguna

                    </div>

                    <div class="section-subtitle">

                        Daftar akun yang terdaftar dalam sistem.

                    </div>

                </div>


                {{-- SEARCH --}}
                <form
                    action="{{ route('admin.users') }}"
                    method="GET"
                    class="d-flex"
                >

                    <div class="input-group search-box">

                        <span class="input-group-text bg-white border-0">

                            <i class="bi bi-search text-primary"></i>

                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari nama atau email user..."
                        >

                        <button
                            type="submit"
                            class="search-btn"
                        >

                            Cari

                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- ================================
             TABLE
        ================================= --}}

        <div class="table-responsive">

            <table class="table users-table align-middle">

                <thead>

                    <tr>

                        <th style="width: 70px;">
                            #
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th class="text-center" style="width: 140px;">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $index => $user)

                        @php

                            $name = $user->name ?? 'User';

                            $initials = collect(
                                explode(' ', trim($name))
                            )
                            ->filter()
                            ->take(2)
                            ->map(function ($word) {
                                return strtoupper(
                                    substr($word, 0, 1)
                                );
                            })
                            ->implode('');

                            $roleName = strtolower(
                                $user->role->name ?? 'user'
                            );

                        @endphp


                        <tr>


                            {{-- NOMOR --}}
                            <td>

                                <div class="number-badge">

                                    {{ method_exists($users, 'firstItem')
                                        ? $users->firstItem() + $index
                                        : $index + 1
                                    }}

                                </div>

                            </td>


                            {{-- USER --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="user-avatar">

                                        {{ $initials }}

                                    </div>

                                    <div>

                                        <div class="user-name">

                                            {{ $user->name }}

                                        </div>

                                        <small class="text-muted">

                                            ID #{{ $user->id }}

                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td>

                                <span class="user-email">

                                    <i class="bi bi-envelope me-1"></i>

                                    {{ $user->email }}

                                </span>

                            </td>


                            {{-- ROLE --}}
                            <td>

                                @if($roleName === 'admin')

                                    <span class="role-badge role-admin">

                                        <i class="bi bi-shield-fill-check"></i>

                                        Admin

                                    </span>

                                @elseif($roleName === 'kasir')

                                    <span class="role-badge role-kasir">

                                        <i class="bi bi-person-badge-fill"></i>

                                        Kasir

                                    </span>

                                @else

                                    <span class="role-badge bg-light text-secondary">

                                        <i class="bi bi-person-fill"></i>

                                        {{ ucfirst($roleName) }}

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="d-flex
                                            justify-content-center
                                            gap-2">


                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.users.edit', $user->id) }}"
                                        class="action-btn action-edit"
                                        title="Edit User"
                                    >

                                        <i class="bi bi-pencil-fill"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn action-delete"
                                            title="Hapus User"
                                            onclick="return confirm(
                                                'Apakah Anda yakin ingin menghapus user ini?'
                                            )"
                                        >

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="empty-state">

                                    <div class="empty-icon">

                                        <i class="bi bi-people"></i>

                                    </div>

                                    <strong class="d-block text-dark mb-1">

                                        Belum ada pengguna

                                    </strong>

                                    <small>

                                        Silakan tambahkan user baru
                                        menggunakan tombol
                                        "Tambah User".

                                    </small>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ================================
             PAGINATION
        ================================= --}}

        @if(method_exists($users, 'hasPages') && $users->hasPages())

            <div class="pagination-wrapper">

                <div class="d-flex
                            flex-column
                            flex-md-row
                            justify-content-between
                            align-items-center
                            gap-3">

                    <small class="text-muted">

                        Menampilkan

                        <strong>
                            {{ $users->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $users->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $users->total() }}
                        </strong>

                        user

                    </small>


                    <div>

                        {{ $users->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>


    {{-- FOOTER --}}
    <div class="text-center text-muted small mt-4 pb-3">

        <i class="bi bi-shield-check me-1"></i>

        POS Naysa &copy; {{ date('Y') }}

        <span class="mx-2">•</span>

        Manajemen Pengguna

    </div>

</div>

@endsection