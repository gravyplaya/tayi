<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowTo extends Model
{
    use HasFactory;
    protected $table ='home_page_howto';
    protected $fillable = [
        'main_heading','main_content','name'
    ];
    
}
