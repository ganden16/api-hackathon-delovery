<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokBahan>
 */
class StokBahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategori_bahan_id' => rand(1, 5),
            'nama' => fake()->name(),
            'total_satuan' => rand(10, 1000),
            'total_berat' => rand(1, 20),
        ];
    }
}
