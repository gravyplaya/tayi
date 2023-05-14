<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_title','title','content','btn_text','heading','list_text'
    ];
}
