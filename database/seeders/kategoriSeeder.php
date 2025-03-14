<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File as FacadesFile;
use Laravel\Pail\File;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $file = FacadesFile::get('database/data/seederKategori.json');
       $data = json_decode($file);
       foreach ($data as $item) {
        kategori::create([
            // 'id' => $item->id,
            'kategori' => $item->kategori,
        ]);
       }
    }
}
