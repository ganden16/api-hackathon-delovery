<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    use HasFactory;
    protected $table = 'status_pengiriman';
    protected $guarded = [];

    public function penjualanProduk()
    {
        return $this->hasMany(PenjualanProduk::class, 'status_pengiriman_id', 'id');
    }
    public function PengadaanBahan()
    {
        return $this->hasMany(PengadaanBahan::class, 'status_pengiriman_id', 'id');
    }
}
