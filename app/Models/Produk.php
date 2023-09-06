<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Produk extends Model
{
    use HasFactory;
    use Searchable;
    protected $table = 'produk';
    protected $guarded = [];

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id', 'id');
    }

    public function penjualan()
    {
        return $this->hasMany(PenjualanProduk::class, 'produk_id', 'id');
    }

    public function kota()
    {
        return $this->belongsToMany(Kota::class, 'kota_produk', 'produk_id', 'kota_id');
    }

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'kota_id' => (int) $this->kota->id,
        ];
    }
}
