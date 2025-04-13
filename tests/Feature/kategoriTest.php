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
    }

    // public function testUpdateSuccessfully()
    // {
    //     // update kategori yang ada
    //     $kategori = ModelsKategori::factory()->create(['kategori' => 'kategori lama']);
    //     Livewire::test('kategori.index')
    //         ->set('kategoriId', $kategori->id) // set id kategori
    //         ->set('kategori', 'kategori baru') // set kategori baru
    //         ->call('update') // panggil fungsi update
    //         ->skipRender()
    //         ->assertRedirect('/kategori') // assert redirect ke halaman kategori
    //         ->assertDatabaseHas('kategori', [ // assert database memiliki data kategori
    //             'kategori' => 'kategori baru',
    //         ]);
    // }

    // public function testDeleteSuccessfully()
    // {
    //     // delete kategori yang ada
    //     $kategori = ModelsKategori::factory()->create(['kategori' => 'kategori lama']);
    //     Livewire::test('kategori.index')
    //         ->set('kategoriId', $kategori->id) // set id kategori
    //         ->call('delete') // panggil fungsi delete
    //         ->skipRender()
    //         ->assertRedirect('/kategori') // assert redirect ke halaman kategori
    //         ->assertDatabaseMissing('kategori', [ // assert database tidak memiliki data kategori
    //             'kategori' => 'kategori lama',
    //         ]);
    // }
}
