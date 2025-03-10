<?php

namespace Database\Seeders;

use App\Models\produk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        produk::factory()->count(50)->create();
        // $this->call([
        //     kategoriSeeder::class
        // ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        // ]);
        // User::factory()->create([
        //     'name' => 'kasir',
        //     'email' => 'kasir@kasir.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'kasir',
        // ]);
        // User::factory()->create([
        //     'name' => 'member',
        //     'email' => 'member@member.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'member',
        // ]);
        // User::factory()->create([
        //     'name' => 'gudang',
        //     'email' => 'gudang@gudang.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'gudang',
        // ]);
    }
}
