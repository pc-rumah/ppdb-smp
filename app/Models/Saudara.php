<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saudara extends Model
{
    protected $guarded = [];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class, 'saudara_id');
    }
}
