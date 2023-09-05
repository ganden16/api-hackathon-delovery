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
        Schema::table('obrolan', function (Blueprint $table) {
            $table->foreignId('chat_room_id')->after('id');
            $table->foreignId('pengirim_id')->after('chat_room_id');
            $table->foreignId('penerima_id')->after('pengirim_id');

            $table->foreign('pengirim_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('chat_room_id')->references('id')->on('chat_room')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('obrolan', ['pengirim_id', 'penerima_id']);
    }
};
