<?php

namespace App\Livewire\Laporan;

use App\Models\transaksi;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('layouts.master')]
class PenjualanLaporan extends Component
{
    public $penjualan = [];


    public function render()
    {
        return view('livewire.laporan.penjualan-laporan')->with([
            'penjualan' => transaksi::with(['user', 'item'])->get(),
        ]);
    }
}
