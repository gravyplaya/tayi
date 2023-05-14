<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function templatedet()
    {
        return $this->belongsTo(Template::class, 'template');
    }

    public function related_folder()
    {
        return $this->belongsTo(Folder::class, 'folder');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
