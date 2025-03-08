<?php

namespace App\Livewire\Transaksi;

use App\Models\transaksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class Penjualan extends Component
{

    public function create()
    {
        $id = transaksi::create([
            'user_id' => null,
            'kasir_id' => Auth::user()->id,
            'voucher_id' => null,
            'total' => null,
            'koin' => null,
        ]);
        $data['id'] = $id->id;
        return redirect()->route('list-transaksi')->with($data);
    }
    public function render()
    {
        $data['penjualan'] = transaksi::all();
        return view('livewire.transaksi.penjualan', $data);
    }
}
