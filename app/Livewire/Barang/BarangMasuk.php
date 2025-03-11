<?php

namespace App\Livewire\Barang;

use App\Models\barang_masuk;
use App\Models\produk;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.master')]
class BarangMasuk extends Component
{

    #[Title('barang masuk')]

    public $kode, $qty, $harga, $expired;
    public $barang;
    public $history;


    protected $rules = [
        'kode' => 'required',
        'qty' => 'required',
        'harga' => 'required',
    ];

    public function refreshForm(){
        $this->kode = '';
        $this->qty = '';
        $this->harga = '';
        $this->expired = '';
    }
    

    public function scanDetected()
    {
        $this->validate();
        $produk = produk::where('kode', $this->kode)->with('barang_masuk')->first();
        if ($produk == null) {
            $data['kode'] = $this->kode;
            return redirect()->route('produk')->with('error', 'Produk tidak ditemukan, silahkan masukan data terlebih dahulu')->with($data);
        }
        if ($produk != null) {
            barang_masuk::create([
                'produk_id' => $produk->id,
                'tgl_masuk' => date('Y-m-d'),
                'harga_modal' => $this->harga,
                'qty' => $this->qty,
                'stok' => $this->qty,
                'expired' => $this->expired,
            ]);
            $this->refreshForm();
            // return redirect('barang-masuk')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect('barang-masuk')->with('error', 'Produk tidak ditemukan');
        }
    }



    public function render()
    {
        $this->history = barang_masuk::with('produk')->get();
        return view('livewire.barang.barang-masuk')->with('listBarang', $this->history);
    }
}
