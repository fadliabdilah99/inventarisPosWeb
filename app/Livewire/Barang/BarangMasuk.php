<?php

namespace App\Livewire\Barang;

use App\Models\barang_masuk;
use App\Models\produk;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master')]
class BarangMasuk extends Component
{
    public $qr_code;
    public $barang;
    
    protected $listeners = ['scanDetected' => 'handleScan'];

    public function handleScan($qr_code)
    {
        $this->qr_code = $qr_code;
        $this->barang = barang_masuk::where('kode_barang', $qr_code)->first();

        if ($this->barang) {
            session()->flash('message', 'Barang ditemukan: ' . $this->barang->nama_barang);
        } else {
            session()->flash('error', 'Barang tidak ditemukan.');
        }
    }



    public function render()
    {
        return view('livewire.barang.barang-masuk');
    }
}
