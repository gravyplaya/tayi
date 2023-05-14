<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowToBoxes extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id','icon','box_color','box_heading','box_content','box_list','box_image'
    ];
    public function howtosection()
    {
        return $this->belongsTo(HowTo::class, 'section_id','id');
    }
}
