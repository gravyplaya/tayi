<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateField extends Model
{
    use HasFactory;

    
    public function templates()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

}
