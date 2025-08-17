<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendaftaranStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendaftaranStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PendaftaranStatus::create([
            'tanggal_mulai'   => '2025-08-01',
            'tanggal_selesai' => '2025-08-31',
        ]);
    }
}
