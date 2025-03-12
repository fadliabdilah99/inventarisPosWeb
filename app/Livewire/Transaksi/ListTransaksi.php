<?php

namespace App\Livewire\Transaksi;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksi_item;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class ListTransaksi extends Component
{
    public $produk_id, $id;
    public $total = 0;
    public $discount  = 0;

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
        if ($produk == null) {
            return redirect('list-transaksi/' . $this->id)->with('error', 'Produk tidak ditemukan');
        }
        $list = transaksi_item::where('transaksi_id', $this->id)->where('produk_id', $produk->id)->first();
        if ($list != null) {
            $list->qty += 1;
            $list->save();
            // return redirect()->route('list-transaksi', $this->id);
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

        $totals = 0;
        foreach ($transaksi->item as $items) {
            $items->produk->barang_masuk->first()->update([
                'stok' => $items->produk->barang_masuk->first()->stok - $items->qty,
            ]);
            $totals += $items->produk->harga * $items->qty;
        }


        $transaksi->status = 'payment';
        $transaksi->total = $totals;
        $transaksi->save();
    }

    public function render()
    {
        $data['list_transaksi'] = transaksi_item::where('transaksi_id', $this->id)->get();
        // dd($data);
        return view('livewire.transaksi.list-transaksi')->with($data);
    }
}
