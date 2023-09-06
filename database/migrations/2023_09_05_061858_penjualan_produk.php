<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan_produk', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_penjualan');
            $table->string('nama_pembeli');
            $table->string('alamat_pengiriman');
            $table->string('kode_pos_pengiriman');
            $table->string('kota_pengiriman');
            $table->unsignedInteger('jumlah');
            $table->unsignedInteger('total_harga');
            $table->datetime('waktu_penjualan')->default(now());
            $table->datetime('waktu_diterima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('penjualan_produk');
    }
};
