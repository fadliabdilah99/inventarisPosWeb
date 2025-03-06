<?php

namespace App\Livewire;

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
            $this->resetForm();
        } catch (\Exception $e) {
            // You can log the error or handle it as needed
            Log::error('Error storing product: ' . $e->getMessage());
            session()->flash('error', 'There was an error saving the product');
        }
    }

    public function render()
    {
        $data['kategoris'] = kategori::all();
        $data['produks'] = produk::all();
        return view('livewire.add-produk')->with($data);
    }
}
