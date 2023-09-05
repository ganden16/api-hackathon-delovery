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
        Schema::table('bahan_mitra', function (Blueprint $table) {
            $table->foreignId('mitra_id')->after('id');
            $table->foreignId('kategori_bahan_id')->after('mitra_id');

            $table->foreign('mitra_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori_bahan_id')->references('id')->on('kategori_bahan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('bahan_mitra', ['mitra_id', 'kategori_bahan_id']);
    }
};
