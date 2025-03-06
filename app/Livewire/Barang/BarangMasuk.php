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

    public $kode, $qty, $harga;
    public $barang;


    protected $rules = [
        'kode' => 'required',
        'qty' => 'required',
        'harga' => 'required',
    ];

    public function scanDetected()
    {
        $this->validate();
        $produk = produk::where('id', $this->kode)->with('barang_masuk')->first();
        if ($produk == null) {
            $data['kode'] = $this->kode;
            return redirect()->route('add-produk')->with('error', 'Produk tidak ditemukan, silahkan masukan data terlebih dahulu')->with($data);
        }
        $produk->update([
            'stok' => $produk->stok + $this->qty
        ]);
        if ($produk != null) {
            barang_masuk::create([
                'produk_id' => $produk->id,
                'tgl_masuk' => date('Y-m-d'),
                'harga_modal' => $this->harga,
                'qty' => $this->qty,
            ]);
            return redirect('barang-masuk')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect('barang-masuk')->with('error', 'Produk tidak ditemukan');
        }
    }



    public function render()
    {
        return view('livewire.barang.barang-masuk');
    }
}
