<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\AddProduk;
use App\Livewire\Barang\BarangMasuk;
use App\Livewire\Dashboard;
use App\Livewire\Kategori\Index;
use App\Livewire\Kategori\kategori;
use App\Models\barang_masuk;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('login');
});




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

// kategori
Route::get('kategori', Kategori::class)->name('kategori');

// barang masuk
Route::get('barang-masuk', BarangMasuk::class)->name('barang-masuk');

// daftarkan barang
Route::get('produk', AddProduk::class)->name('produk');