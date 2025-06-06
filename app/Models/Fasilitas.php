<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $guarded = ['id'];
    protected $table = 'fasilitas';

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
