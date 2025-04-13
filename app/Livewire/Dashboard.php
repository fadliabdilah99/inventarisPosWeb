<?php

namespace App\Livewire;

use App\Models\barang_masuk;
use App\Models\pengajuan;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Attributes\Layout;
use Livewire\Component;



#[Layout('layouts.master')]
class Dashboard extends Component
{

    // public $penjualan = [];
    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }


    public function render()
    {
        $date = date('Y-m-d');
        $totalDay = date('t', strtotime($date));

        $penjualan = [];
        for ($i = 1; $i <= $totalDay; $i++) {
            $penjualan[] = transaksi::whereDay('created_at', $i)->sum('total');
            $total_transaksi[] = transaksi::whereDay('created_at', $i)->count();
        }

        $data['penjualan'] = json_encode($penjualan); // Ubah ke JSON
        $data['total_transaksi'] = json_encode($total_transaksi); // Ubah ke JSON
        $data['labels'] = json_encode(range(1, $totalDay)); // Label tanggal dari 1 sampai akhir bulan

        $data['pemasukanBulan'] = transaksi::whereMonth('created_at', date('m'))->sum('total');

        $data['transaksis'] = transaksi::all();
        $data['member'] = User::where('role', 'member')->count();
        $data['valuasi'] = barang_masuk::sum(FacadesDB::raw('stok * harga_modal'));
        $data['pemasukan'] = transaksi::sum('total');
        $data['pengeluaran'] = barang_masuk::sum(FacadesDB::raw('qty * harga_modal'));
        // dd($data['valuasi']);
        return view('livewire.dashboard')->with($data);
    }
}
