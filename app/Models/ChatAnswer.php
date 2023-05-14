<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAnswer extends Model
{
    use HasFactory;

    
    public function chats()
    {
        return $this->belongsTo(Chat::class, 'chat_session');
    }

}