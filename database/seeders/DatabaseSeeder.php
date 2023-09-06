<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BahanMitra;
use App\Models\ChatRoom;
use App\Models\KategoriBahan;
use App\Models\KategoriProduk;
use App\Models\Kota;
use App\Models\Obrolan;
use App\Models\PengadaanBahan;
use App\Models\PenjualanProduk;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\Role;
use App\Models\StatusPengiriman;
use App\Models\StokBahan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $insertKategoriProduk = KategoriProduk::factory(5)->create();

        $insertKategoriBahan = KategoriBahan::factory(5)->create();

        $insertProduk = Produk::factory(200)->create();

        $insertRole = collect([
            ['nama' => 'karyawan'],
            ['nama' => 'mitra'],
            ['nama' => 'pelanggan'],
        ])->each(fn ($data) => Role::create($data));

        $insertUsers = User::factory()->count(15)->create();

        $addUser = collect([
            [
                'nama' => 'Mitra2023',
                'email' => 'mitra2023@gmail.com',
                'role_id' => 2,
            ],
            [
                'nama' => 'Karyawan2023',
                'email' => 'karyawan2023@gmail.com',
                'role_id' => 1,
            ],
            [
                'nama' => 'Pelanggan2023',
                'email' => 'pelanggan2023@gmail.com',
                'role_id' => 3,
            ]
        ])->each(function ($user) {
            User::factory()->create($user);
        });

        $userNotMitra = User::where('role_id', '!=', 2)->get();

        for ($i = 1; $i < $userNotMitra->count(); $i++) {
            for ($j = $i + 1; $j < $userNotMitra->count(); $j++) {
                ChatRoom::create([
                    'user_id1' => $userNotMitra[$i]->id,
                    'user_id2' => $userNotMitra[$j]->id,
                ]);
            }
        }

        $chatRoom = ChatRoom::all();

        for ($i = 1; $i < $chatRoom->count(); $i++) {
            $insertObrolan = Obrolan::create([
                'chat_room_id' => $i,
                'pengirim_id' => $chatRoom[$i]->user_id1,
                'penerima_id' => $chatRoom[$i]->user_id2,
                'pesan' => fake()->sentence(2)
            ]);
        }

        User::where('role_id', 2)->each(function ($user) {
            $insertBahanMitra = BahanMitra::factory(5)->create([
                'mitra_id' => $user->id,
            ]);
            StokBahan::factory(1)->create([
                'mitra_id' => $user->id,
            ]);
        });

        $insertStatusPengiriman = collect(['pengemasan', 'pengiriman', 'diterima'])->each(function ($status) {
            StatusPengiriman::create([
                'nama' => $status
            ]);
        });

        User::where('role_id', 3)->each(function ($user) {
            $insertPenjualanProduk = PenjualanProduk::factory(50)->create([
                'pelanggan_id' => $user->id,
            ]);
        });

        $insertBahanMitra = BahanMitra::all()->each(function ($bahanMitra) {
            PengadaanBahan::factory(50)->create([
                'bahan_mitra_id' => $bahanMitra->id,
                'mitra_id' => $bahanMitra->mitra_id
            ]);
        });

        $jsonData = File::json('database/data/region.json');
        $region = collect($jsonData);
        $provinsi_id = 1;
        foreach ($region as $data) {
            Provinsi::create([
                'nama' => $data['provinsi']
            ]);
            foreach ($data['kota'] as $kota) {
                Kota::create([
                    'nama' => $kota,
                    'provinsi_id' => $provinsi_id
                ]);
            }
            $provinsi_id = $provinsi_id + 1;
        };
    }
}
