<?php

namespace App\Livewire\Kategori;

use App\Models\kategori as ModelsKategori;
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

    public function update()
    {
        $this->validate();
        ModelsKategori::find($this->kategoriId)->update([
            'kategori' => $this->kategori
        ]);
        $this->resetForm();
        session()->flash('success', 'Kategori berhasil diubah.');

    }

    public function delete()
    {
        ModelsKategori::find($this->kategoriId)->delete();
        $this->resetForm();
        session()->flash('success', 'Kategori berhasil dihapus.');
    }


    public function render()
    {
        return view('livewire.kategori.index', [
            'kategoris' => ModelsKategori::all(),
        ]);
    }
}
