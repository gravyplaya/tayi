<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chat extends Authenticatable
{
    use HasFactory;
  
   public function chat_answers()
    {
        return $this->hasMany(ChatAnswer::class, 'chat_session');
    }
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
