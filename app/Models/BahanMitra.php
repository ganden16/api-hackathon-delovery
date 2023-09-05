<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanMitra extends Model
{
    use HasFactory;

    protected $table = 'bahan_mitra';
    protected $guarded = [];

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id', 'id');
    }

    public function kategoriBahan()
    {
        return $this->belongsTo(KategoriBahan::class, 'kategori_bahan_id', 'id');
    }

    public function pengadaanBahan()
    {
        return $this->hasMany(PengadaanBahan::class, 'bahan_mitra_id', 'id');
    }
}
