<?php

namespace App\Models;

use App\Models\ProgramPondok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriProgramPondok extends Model
{
    protected $guarded = ['id'];
    protected $table = 'kategori_program_pondok';

    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramPondok::class, 'program_id');
    }
}
