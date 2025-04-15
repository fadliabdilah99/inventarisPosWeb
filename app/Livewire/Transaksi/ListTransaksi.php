<?php

namespace App\Livewire\Transaksi;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksi_item;
use App\Models\User;
use App\Services\ServiceThermal;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class ListTransaksi extends Component
{
    public $produk_id, $id;
    public $total = 0;
    public $discount  = 0;
    public $selectedMember;
    public $uang_bayar = 0;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function resetForm()
    {
        $this->produk_id = '';
    }

    public function addlist()
    {
        $produk = produk::where('kode', $this->produk_id)->first();
        if ($produk == null || $produk->stok <= 0) {
            return redirect('list-transaksi/' . $this->id)->with('error', 'Produk tidak ditemukan atau stok habis');
        }
        $list = transaksi_item::where('transaksi_id', $this->id)->where('produk_id', $produk->id)->first();
        if ($list != null) {
            $list->qty += 1;
            $list->save();
        } else {
            transaksi_item::create([
                'transaksi_id' => $this->id,
                'produk_id' => $produk->id,
                'qty' => 1,
            ]);
        }
        $this->resetForm();
    }


    public function bayar()
    {

        $transaksi = transaksi::where('id', $this->id)->first();

        if (!$transaksi) {
            return;
        }


        $totals = 0;

        foreach ($transaksi->item as $items) {


            $barangMasuk = $items->produk->barang_masuk->first();

            if (!$barangMasuk) {
                continue;
            }


            $barangMasuk->update([
                'stok' => $barangMasuk->stok - $items->qty,
            ]);

            $totals += $items->produk->margin * $items->qty;
        }



        $transaksi->koin = floor($totals / 1000);

        if($this->selectedMember != null){
          User::where('nomor', $this->selectedMember)->update(['koin' => User::where('nomor', $this->selectedMember)->first()->point + $transaksi->koin]);
        }



        $transaksi->status = 'payment';
        $transaksi->total = $totals;
        $transaksi->save();

        $thermal = new ServiceThermal();
        $thermal->cetakStruk($transaksi);
    
        // return redirect()->route('invoice', $this->id);
    }

    public function updateList($id, $field, $value)
    {
        // dd($id);
        $produk = transaksi_item::find($id);
        if ($produk) {
            $produk->qty = $value;
            $produk->save();
        }
    }

    public function add_member($kode)
    {
        $this->selectedMember = $kode;
        $member = User::where('nomor', $this->selectedMember)->first();
        transaksi::where('id', $this->id)->update(['user_id' => $member->id]);
    }


    public function render()
    {
        $data['list_transaksi'] = transaksi_item::where('transaksi_id', $this->id)->get();
        // dd($data);
        $data['members'] = User::where('role', 'member')->get();
        return view('livewire.transaksi.list-transaksi')->with($data);
    }
}
