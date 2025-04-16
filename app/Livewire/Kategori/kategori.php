<?php

namespace App\Livewire\Kategori;

use App\Models\kategori as ModelsKategori;
use App\Models\produk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.master')]
class Kategori extends Component
{

    #[Title('Kategori')]

    public $kategori, $kategoriId;

    protected $rules = [
        'kategori' => 'required'
    ];

    public function resetForm()
    {
        $this->kategori = '';
    }


    public function store()
    {
        $this->validate();
        ModelsKategori::create([
            'kategori' => $this->kategori
        ]);
        $this->resetForm();
        session()->flash('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori($id, $value)
    {   
        // dd($value);
        $kategorri = ModelsKategori::find($id);
        if ($kategorri) {
            $kategorri->kategori = $value;
            $kategorri->save();
        }
        session()->flash('success', 'Produk berhasil update');
    }

    public function delete()
    {
        $kategori = ModelsKategori::find($this->kategoriId);
        produk::where('kategori_id', $kategori->id)->update(['kategori_id' => null]);
        $kategori->delete();
        session()->flash('success', 'Kategori berhasil dihapus.');
    }


    public function render()
    {
        return view('livewire.kategori.index', [
            'kategoris' => ModelsKategori::all(),
        ]);
    }
}
