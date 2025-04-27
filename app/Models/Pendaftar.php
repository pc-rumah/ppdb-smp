<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $guarded = [];
    public function riwayatPenyakit()
    {
        return $this->belongsToMany(Sakit::class, 'pendaftar_riwayat_penyakit');
    }

    public function riwayatSaudara()
    {
        return $this->belongsTo(Saudara::class);
    }
}
