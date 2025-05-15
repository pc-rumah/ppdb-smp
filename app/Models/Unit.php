<?php

namespace App\Models;

use App\Models\Fasilitas;
use App\Models\Keunggulan;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];



    public function facilities()
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function strengths()
    {
        return $this->hasMany(Keunggulan::class);
    }
}
