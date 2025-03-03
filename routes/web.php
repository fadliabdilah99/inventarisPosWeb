<?php

use App\Livewire\Barang\BarangMasuk;
use App\Livewire\Dashboard;
use App\Livewire\Kategori\Index;
use App\Livewire\Kategori\kategori;
use App\Models\barang_masuk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('dashboard', Dashboard::class)->name('dashboard');

// kategori
Route::get('kategori', Kategori::class)->name('kategori');

// barang masuk
Route::get('barang-masuk', BarangMasuk::class)->name('barang-masuk');

require __DIR__ . '/auth.php';
