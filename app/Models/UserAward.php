<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAward extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','award_id'
    ];
    public function awards()
   {
    return $this->hasMany(Award::class,'id','award_id');
   }
}
