<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kota_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_id');
            $table->foreignId('produk_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kota_produk');
    }
};
