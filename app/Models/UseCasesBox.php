<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseCasesBox extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon','box_heading','box_content',
    ];
}
