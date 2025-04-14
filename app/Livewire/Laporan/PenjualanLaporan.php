<?php

namespace App\Livewire\Laporan;

use App\Models\transaksi;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout('layouts.master')]
class PenjualanLaporan extends Component
{
    public $penjualan = [];
    public $from_date;
    public $to_date;


    // set default value
    public function mount()
    {
        $this->penjualan = transaksi::with(['user', 'item'])->get();
    }

    // filter berdasarkan tanggal
    public function filter()
    {
        $this->penjualan = transaksi::whereBetween('created_at', [$this->from_date, $this->to_date])->with(['user', 'item'])->get();
    }

    public function render()
    {
        return view('livewire.laporan.penjualan-laporan');
    }
}
