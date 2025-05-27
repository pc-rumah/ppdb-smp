<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = [
        'judul_madrasah',
        'deskripsi_madrasah',
        'cover_madrasah',
        'judul_smp',
        'deskripsi_smp',
        'cover_smp',
        'judul_pondok',
        'deskripsi_pondok',
        'cover_pondok',
    ];
}
