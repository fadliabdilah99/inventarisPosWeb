<?php

namespace App\Livewire\Laporan;

use App\Models\barang_masuk;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class BarangmasukLaporan extends Component
{

    public $barang_masuk = [];
    public $from_date;
    public $to_date;


    // set default value
    public function mount()
    {
        $this->barang_masuk = barang_masuk::with('produk')->get();
    }

    // filter berdasarkan tanggal
    public function filter()
    {
        $this->barang_masuk = barang_masuk::whereBetween('created_at', [$this->from_date, $this->to_date])->with('produk')->get();
    }

    public function render()
    {
        return view('livewire.laporan.barangmasuk-laporan');
    }
}
