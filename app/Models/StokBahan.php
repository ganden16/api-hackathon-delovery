<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    use HasFactory;
    protected $table = 'stok_bahan';
    protected $guarded = [];


    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id', 'id');
    }
    public function kategoriBahan()
    {
        return $this->belongsTo(KategoriBahan::class, 'kategori_bahan_id', 'id');
    }
}
