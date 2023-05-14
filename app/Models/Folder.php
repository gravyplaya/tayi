<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class, 'folder');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
