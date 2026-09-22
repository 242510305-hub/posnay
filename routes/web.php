<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route tentang (Hanya bisa diakses setelah login)
    Route::get('/jenis', function () {
        return redirect()->route('admin.jenis.index'); })->name('jenis');
    Route::get('/tentang', function () {
        return view('tentang'); })->name('tentang');
    Route::get('/perusahaan', function () {
        return view('perusahaan'); })->name('perusahaan');

    // Admin Only
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('jenis', JenisController::class)->except(['index', 'show']);
    });

    // Admin & Kasir
    Route::middleware('role:admin,kasir')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.index');
        Route::get('/jenis/{jeni}', [JenisController::class, 'show'])->name('jenis.show');
        Route::resource('produk', ProdukController::class);
        Route::get('/penjualan/{penjualan}/barcode', [PenjualanController::class, 'barcode'])->name('penjualan.barcode');
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);
    });
});