<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KotaProduk extends Pivot
{
    use HasFactory;
    protected $table = 'kota_produk';
    protected $guarded = [];
    public $timestamps = false;
}
