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
        Schema::create('pengadaan_bahan', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_pengadaan');
            $table->unsignedInteger('jumlah');
            $table->unsignedInteger('total_harga');
            $table->datetime('waktu_pengadaan')->default(now());
            $table->datetime('waktu_diterima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('pengadaan_bahan');
    }
};
