<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','noti_id','status',
    ];
}
