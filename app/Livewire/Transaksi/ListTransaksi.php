<?php

namespace App\Livewire\Transaksi;

use App\Models\transaksi_item;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class ListTransaksi extends Component
{
    public $id;

    public function mount() {
        $this->id = session('id', '');
    }

    public function render()
    {
        $data['list_transaksi'] = transaksi_item::where('id', $this->id)->get();
        return view('livewire.transaksi.list-transaksi')->with($data);
    }
}
