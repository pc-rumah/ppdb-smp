<?php

namespace App\Models;

use App\Models\KategoriProgramPondok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgramPondok extends Model
{
    protected $guarded = ['id'];
    protected $table = 'program_pondok';

    public function kategori(): HasMany
    {
        return $this->hasMany(KategoriProgramPondok::class, 'program_id');
    }
}
