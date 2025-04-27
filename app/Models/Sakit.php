<?php

namespace App\Models;

use App\Models\Pendaftar;
use Illuminate\Database\Eloquent\Model;

class Sakit extends Model
{
    protected $guarded = [];

    public function pendaftar()
    {
        return $this->belongsToMany(Pendaftar::class, 'pendaftar_riwayat_penyakit');
    }
}
