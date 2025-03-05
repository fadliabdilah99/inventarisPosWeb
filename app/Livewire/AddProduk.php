<?php

namespace App\Livewire;

use App\Models\kategori;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.master')]
class AddProduk extends Component
{
    #[Title('Tambah Produk')]

    public $kode;
    

    public function mount()
    {
        $this->kode = session('kode', '');
    }

    public function render()
    {
        $data['kategoris'] = kategori::all();
        return view('livewire.add-produk')->with($data);
    }
}
