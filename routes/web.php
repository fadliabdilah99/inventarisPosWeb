<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExportController;
use App\Livewire\Barang\AddProduk;
use App\Livewire\Barang\BarangMasuk;
use App\Livewire\Barang\Struk;
use App\Livewire\Dashboard;
use App\Livewire\Kategori\Index;
use App\Livewire\Kategori\kategori;
use App\Livewire\Laporan\BarangmasukLaporan;
use App\Livewire\Laporan\PenjualanLaporan;
use App\Livewire\Laporan\ProdukLaporan;
use App\Livewire\Pengajuan;
use App\Livewire\Transaksi\ListTransaksi;
use App\Livewire\Transaksi\Penjualan;
use App\Models\barang_masuk;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/download-pdf', [ExportController::class, 'generatePdf'])->name('download.pdf');


// auth proses

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('dashboard', Dashboard::class)->name('dashboard');



Route::group(['middleware' => ['role:admin,gudang']], function () {
    // kategori
    Route::get('kategori', Kategori::class)->name('kategori');
    // daftarkan barang
    Route::get('produk', AddProduk::class)->name('produk');
    // barang masuk
    Route::get('barang-masuk', BarangMasuk::class)->name('barang-masuk');
});

Route::group(['middleware' => ['role:admin,kasir']], function () {
    // penjualan
    Route::get('penjualan', Penjualan::class)->name('penjualan');

    // list transaksi
    Route::get('/list-transaksi/{id}', ListTransaksi::class)->name('list-transaksi');
    Route::get('/invoice/{id}', Struk::class)->name('invoice');
});


// pengajuan
Route::group(['middleware' => ['role:admin,gudang,member']], function () {
    Route::get('pengajuan', Pengajuan::class)->name('pengajuan');
});


// laporan
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('laporan/penjualan', PenjualanLaporan::class)->name('laporan-penjualan');
    Route::get('laporan/produk', ProdukLaporan::class)->name('laporan-produk');
    Route::get('laporan/barangMasuk', BarangmasukLaporan::class)->name('laporan-barangMasuk');
});
