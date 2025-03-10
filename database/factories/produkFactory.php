<?php

namespace Database\Factories;

use App\Models\kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produk>
 */
class produkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = kategori::all()->random()->first(); 


        return [
          'kode' => "BG" . fake()->unique()->numberBetween([1, 9999]),
          'kategori_id' => $kategori->id,
          'satuan' => fake()->randomElement(['pcs', 'Box', 'Renceng', 'Set']),
          'produk' => fake()->name(),
          'margin' => fake()->numberBetween([1, 100]),
          'discount' => fake()->numberBetween([1, 100]),
        ];
    }
}
