<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterBlock extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_heading','heading','content','list','image'
    ];
}
