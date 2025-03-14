<?php

namespace App\Livewire\Barang;

use App\Models\produk;
use App\Models\transaksi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')] 
class Struk extends Component
{
    public $id;
    public function mount($id){
        $this->id = $id;
    }
    public function render()
    {
        $produk = transaksi::where('id', $this->id)->with('item')->first();
        // dd($produk->item);
        return view('livewire.barang.struk')->with('produks', $produk);
    }
}
