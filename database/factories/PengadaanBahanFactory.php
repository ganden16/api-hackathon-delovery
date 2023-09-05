<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengadaanBahan>
 */
class PengadaanBahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jumlah' => rand(1, 10),
            'total_harga' => rand(10000, 100000),
            'status_pengiriman_id' => rand(1, 3)
        ];
    }
}
