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

    public $kategori, $id;

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
    }


    public function render()
    {
        return view('livewire.kategori.index', [
            'kategoris' => ModelsKategori::all(),
        ]);
    }
}
