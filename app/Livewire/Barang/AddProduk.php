<?php

namespace App\Livewire\Barang;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.master')]
class AddProduk extends Component
{
    #[Title('Tambah Produk')]

    public $kode, $produk, $kat, $satuan, $margin, $discount;


    public function mount()
    {
        $this->kode = session('kode', '');
    }

    protected $rules = [
        'kode' => 'required',
        'kat' => 'required',
        'satuan' => 'required',
        'margin' => 'required',
    ];

    public function resetForm()
    {
        $this->kode = '';
        $this->produk = '';
        $this->kat = '';
        $this->satuan = '';
        $this->margin = '';
        $this->discount = '';
    }

    public function store()
    {
        if (empty($this->discount)) {
            $this->discount = 0;
        }
        try {
            $this->validate();
            produk::create([
                'kode' => $this->kode,
                'produk' => $this->produk,
                'kategori_id' => $this->kat,
                'satuan' => $this->satuan,
                'margin' => $this->margin,
                'discount' => $this->discount
            ]);
            session()->flash('success', 'Produk berhasil ditambahkan');
            return redirect('produk')->with('');
        } catch (\Exception $e) {
            // You can log the error or handle it as needed
            Log::error('Error storing product: ' . $e->getMessage());
            session()->flash('error', 'There was an error saving the product');
        }
    }

    public function updateProduk($id, $field, $value)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->$field = $value;
            $produk->save();
        }
        session()->flash('success', 'Produk berhasil ditambahkan');
    }

    public function destroy($id){
        produk::where('id', $id)->delete();
        session()->flash('success', 'Produk berhasil dihapus!');
    }

    public function render()
    {
        $data['kategoris'] = kategori::all();
        $data['produks'] = produk::all();
        return view('livewire.barang.add-produk')->with($data);
    }
}
