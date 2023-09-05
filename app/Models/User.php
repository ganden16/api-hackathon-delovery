<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bahanMitra()
    {
        return $this->hasMany(BahanMitra::class, 'mitra_id', 'id');
    }

    public function stokBahan()
    {
        return $this->hasMany(StokBahan::class, 'mitra_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function pembelian()
    {
        return $this->hasMany(PenjualanProduk::class, 'pelanggan_id', 'id');
    }

    public function mengirimPesan()
    {
        return $this->hasMany(Obrolan::class, 'pengirim_id', 'id');
    }

    public function menerimaPesan()
    {
        return $this->hasMany(Obrolan::class, 'penerima_id', 'id');
    }
}
