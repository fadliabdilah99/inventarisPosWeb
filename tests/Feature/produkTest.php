<?php

namespace Tests\Feature;

use App\Livewire\Barang\AddProduk;
use App\Models\produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class produkTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStoreSuccessfully()
    {
        $kategori = produk::factory()->create(); // karena produk butuh kategori_id

        Livewire::test(AddProduk::class)
            ->set('kode', 'P001')
            ->set('produk', 'Produk Baru')
            ->set('kat', $kategori->id)
            ->set('satuan', 'pcs')
            ->set('margin', 10)
            ->set('discount', 5)
            ->call('store')
            ->skipRender();

        $this->assertDatabaseHas('produks', [
            'kode' => 'P001',
            'produk' => 'Produk Baru',
            'kategori_id' => $kategori->id,
            'satuan' => 'pcs',
            'margin' => 10,
            'discount' => 5,
        ]);
    }

    public function testUpdateSuccessfully()
    {
        $produk = produk::factory()->create([
            'produk' => 'Produk Lama',
        ]);

        Livewire::test(AddProduk::class)
            ->call('updateProduk', $produk->id, 'produk', 'Produk Update')
            ->skipRender();

        $this->assertDatabaseHas('produks', [
            'id' => $produk->id,
            'produk' => 'Produk Update',
        ]);
    }

    public function testDeleteSuccessfully()
    {
        $produk = produk::factory()->create();

        Livewire::test(AddProduk::class)
            ->call('destroy', $produk->id)
            ->skipRender();

        $this->assertDatabaseMissing('produks', [
            'id' => $produk->id,
        ]);
    }
}
