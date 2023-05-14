<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMembership extends Model
{
    use HasFactory;

    public function mem()
    {
        return $this->belongsTo(Membership::class, 'mem_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'mem_id');
    }

}
