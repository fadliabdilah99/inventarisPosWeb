<?php

namespace Tests\Feature;

use App\Livewire\Kategori\Kategori;
use App\Models\kategori as ModelsKategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    // use RefreshDatabase;


    public function testStoreSuccessfully()
    {
        // store kategori baru
        Livewire::test(Kategori::class)
            ->set('kategori', 'kategori baru') // set kategori baru
            ->call('store'); // panggil fungsi store
        $this->assertDatabaseHas('kategoris', [
            'kategori' => 'kategori baru',
        ]);
        // $this->assertSessionHas('success', 'Kategori berhasil ditambahkan.');
    }

    public function testUpdateSuccessfully()
    {
        // update kategori yang sudah ada
        $kategori = ModelsKategori::factory()->create(['kategori' => 'kategori lama']);
        Livewire::test(Kategori::class)
            ->set('kategoriId', $kategori->id) // set id kategori
            ->set('kategori', 'kategori baru') // set kategori baru
            ->call('updateKategori', $kategori->id, 'kategori baru'); // panggil fungsi updateKategori
        $this->assertDatabaseHas('kategoris', [
            'id' => $kategori->id,
            'kategori' => 'kategori baru',
        ]);
        // $this->assertSessionHas('success', 'Produk berhasil update');
    }

    public function testDeleteSuccessfully()
    {
        // delete kategori yang sudah ada
        $kategori = ModelsKategori::factory()->create(['kategori' => 'kategori lama']);
        Livewire::test(Kategori::class)
            ->set('kategoriId', $kategori->id) // set id kategori
            ->call('delete'); // panggil fungsi delete
        $this->assertDatabaseMissing('kategoris', [
            'id' => $kategori->id,
            'kategori' => 'kategori lama',
        ]);
        // $this->assertSessionHas('success', 'Kategori berhasil dihapus.');
    }
}
