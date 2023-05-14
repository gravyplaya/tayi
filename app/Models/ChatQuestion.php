<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatQuestion extends Model
{
    use HasFactory;

    
    public function frameworks()
    {
        return $this->belongsTo(Framework::class, 'framework_id');
    }

}