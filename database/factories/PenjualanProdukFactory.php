<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenjualanProduk>
 */
class PenjualanProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pembeli' => fake()->name(),
            'status_pengiriman_id' => rand(1, 3),
            'alamat_pengiriman' => fake()->address(),
            'kode_pos_pengiriman' => fake()->postcode(),
            'produk_id' => rand(1, 100),
            'jumlah' => rand(1, 10),
            'total_harga' => rand(10000, 100000),
        ];
    }
}
