<?php

namespace Tests\Feature;

use App\Livewire\Absensi\Absensi;
use App\Livewire\Kategori\Kategori;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AbsensiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStoreSuccessfully()
    {
        // store karyawan baru
        Livewire::test(Absensi::class)
            ->set('name', 'Karyawan baru') // set karyawan baru
            ->call('store'); // panggil fungsi store
        $this->assertDatabaseHas('karyawans', [
            'name' => 'Karyawan baru',
        ]);
        // $this->assertSessionHas('success', 'Karyawan berhasil ditambahkan.');
    }

    public function testUpdateSuccessfully()
    {
        // buat data karyawan langsung di database
        $karyawan = \App\Models\Karyawan::create([
            'name' => 'Karyawan lama',
            // tambahkan kolom lain jika ada kolom yang wajib
        ]);
    
        Livewire::test(Absensi::class)
            ->set('karyawanId', $karyawan->id)
            ->set('name', 'Karyawan baru')
            ->call('update');
    
        $this->assertDatabaseHas('karyawans', [
            'id' => $karyawan->id,
            'name' => 'Karyawan baru',
        ]);
    }
    
    public function testDeleteSuccessfully()
    {
        // buat data karyawan langsung di database
        $karyawan = \App\Models\Karyawan::create([
            'name' => 'Karyawan lama',
            // tambahkan kolom lain jika ada kolom yang wajib
        ]);
    
        Livewire::test(Absensi::class)
            ->set('karyawanId', $karyawan->id)
            ->call('delete');
    
        $this->assertDatabaseMissing('karyawans', [
            'id' => $karyawan->id,
        ]);
    }
    
}
