<?php

namespace Database\Factories;

use App\Models\Kota;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KotaProduk>
 */
class KotaProdukFactory extends Factory
{

    public function definition(): array
    {
        $maxCountKota = Kota::all()->count();
        $maxCountProduk = Produk::all()->count();
        return [
            'kota_id' => rand(1, $maxCountKota),
            'produk_id' => rand(1, $maxCountProduk)
        ];
    }
}
