<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obrolan extends Model
{
    use HasFactory;
    protected $table = 'obrolan';
    protected $guarded = [];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id', 'id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id', 'id');
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id', 'id');
    }
}
