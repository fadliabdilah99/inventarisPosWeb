<?php

use App\Livewire\Dashboard;
use App\Livewire\Kategori\Index;
use App\Livewire\Kategori\kategori;
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

Route::get('kategori', Kategori::class)->name('kategori');

require __DIR__ . '/auth.php';
