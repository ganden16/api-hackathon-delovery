<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanBahan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pengadaan_bahan';
    protected $guarded = [];

    public function uniqueIds()
    {
        return ['kode_pengadaan'];
    }

    public function bahanMitra()
    {
        return $this->belongsTo(BahanMitra::class, 'bahan_mitra_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengiriman::class, 'status_pengiriman_id', 'id');
    }
}
