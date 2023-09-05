<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_room';
    protected $guarded = [];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id1', 'id');
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id2', 'id');
    }

    public function obrolan()
    {
        return $this->hasMany(Obrolan::class, 'chat_room_id', 'id');
    }
}
