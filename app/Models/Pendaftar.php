<?php

namespace App\Models;

use App\Models\Sakit;
use App\Models\Saudara;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $guarded = ['id'];

    public function riwayatPenyakit()
    {
        return $this->belongsToMany(Sakit::class, 'pendaftar_riwayat_penyakit');
    }

    public function riwayatSaudara()
    {
        return $this->belongsTo(Saudara::class, 'saudaras_id');
    }

    public function saudaras()
    {
        return $this->belongsTo(Saudara::class, 'saudaras_id');
    }
}
