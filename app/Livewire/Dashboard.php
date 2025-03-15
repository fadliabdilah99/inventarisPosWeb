<?php

namespace App\Livewire;

use App\Models\barang_masuk;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Attributes\Layout;
use Livewire\Component;



#[Layout('layouts.master')]
class Dashboard extends Component
{
    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }


    public function render()
    {
        $data['member'] = User::where('role', 'member')->count(); 
        $data['valuasi'] = barang_masuk::sum(FacadesDB::raw('stok * harga_modal'));
        $data['pemasukan'] = transaksi::sum('total');
        $data['pengeluaran'] = barang_masuk::sum(FacadesDB::raw('qty * harga_modal'));
        // dd($data['valuasi']);
        return view('livewire.dashboard')->with($data);
    }
}
