<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon1','icon1_name','icon2','icon2_name','icon3','icon3_name','icon4','icon4_name','banner','content','multi_logo',
    ];
}
