<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public function submem()
    {
        return $this->hasMany(SubMembership::class, 'mem_id');
    }

}
