<?php

namespace App\Models;

use App\Models\Fasilitas;
use App\Models\Keunggulan;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];



    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'unit_id');
    }

    public function keunggulan()
    {
        return $this->hasMany(Keunggulan::class, 'unit_id');
    }
}
