<?php

namespace App\Livewire\Laporan;

use App\Models\produk;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master')]
class ProdukLaporan extends Component
{
    public function render()
    {
        return view('livewire.laporan.produk-laporan', [
            'produks' => produk::with(['kategori', 'barang_masuk'])->get(),
        ]);
    }
}
