<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBahan extends Model
{
    use HasFactory;
    protected $table = 'kategori_bahan';
    protected $guarded = [];

    public function kategoriBahan()
    {
        return $this->hasMany(BahanMitra::class, 'kategori_bahan_id', 'id');
    }
}
