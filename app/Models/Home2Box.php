<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home2Box extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon','box_heading','box_content',
    ];
}
