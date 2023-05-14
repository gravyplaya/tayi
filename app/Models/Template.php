<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class, 'template');
    }

    public function template_fields()
    {
        return $this->hasMany(TemplateField::class, 'template_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   


}
