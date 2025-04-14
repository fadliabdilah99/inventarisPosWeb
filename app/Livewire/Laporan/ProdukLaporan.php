<?php

namespace App\Livewire\Laporan;

use App\Models\produk;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master')]
class ProdukLaporan extends Component
{


    public $produks = [];
    public $from_date;
    public $to_date;


    // set default value
    public function mount()
    {
        $this->produks = produk::with(['kategori', 'barang_masuk'])->get();
    }

    // filter berdasarkan tanggal
    public function filter()
    {
        $this->produks = produk::whereBetween('created_at', [$this->from_date, $this->to_date])->with(['kategori', 'barang_masuk'])->get();
    }


    public function render()
    {
        return view('livewire.laporan.produk-laporan');
    }
}
