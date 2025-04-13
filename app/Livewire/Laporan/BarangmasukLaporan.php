<?php

namespace App\Livewire\Laporan;

use App\Models\barang_masuk;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class BarangmasukLaporan extends Component
{
    public function render()
    {
        return view('livewire.laporan.barangmasuk-laporan', [
            'barang_masuk' => barang_masuk::with([ 'produk'])->get(),
        ]);
    }
}
