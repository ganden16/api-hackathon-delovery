<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProduk extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'penjualan_produk';
    protected $guarded = [];

    public function uniqueIds()
    {
        return ['kode_penjualan'];
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produck_id', 'id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengiriman::class, 'status_pengiriman_id', 'id');
    }
}
