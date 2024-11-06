<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'chatroom_id', 'message','attachment_path'];
    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
