<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keunggulan extends Model
{
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
