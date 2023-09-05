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
        Schema::table('pengadaan_bahan', function (Blueprint $table) {
            $table->foreignId('bahan_mitra_id')->after('id');
            $table->foreignId('mitra_id')->after('bahan_mitra_id');
            $table->foreignId('status_pengiriman_id')->after('bahan_mitra_id')->default(1);

            $table->foreign('bahan_mitra_id')->references('id')->on('bahan_mitra')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mitra_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_pengiriman_id')->references('id')->on('status_pengiriman')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('pengadaan_bahan', 'bahan_mitra_id');
    }
};
