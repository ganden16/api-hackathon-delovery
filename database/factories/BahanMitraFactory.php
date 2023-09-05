<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BahanMitra>
 */
class BahanMitraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'status_penawaran' => true,
            'kategori_bahan_id' => rand(1, 5),
            'harga_satuan' => rand(1000, 10000),
            'harga_kiloan' => rand(2000, 20000),
        ];
    }
}
