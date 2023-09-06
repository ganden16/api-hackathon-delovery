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
        Schema::table('penjualan_produk', function (Blueprint $table) {
            $table->foreignId('produk_id')->after('id');
            $table->foreignId('pelanggan_id')->after('produk_id');
            $table->foreignId('kota_id')->after('pelanggan_id');
            $table->foreignId('status_pengiriman_id')->after('kota_id')->default(1);

            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pelanggan_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_pengiriman_id')->references('id')->on('status_pengiriman')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('penjualan_produk', ['produk_id', 'pelanggan_id']);
    }
};
