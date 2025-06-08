<?php

namespace Database\Seeders;

use App\Models\Sakit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataPenyakit extends Seeder
{
    public function run(): void
    {
        Sakit::insert([
            ['nama' => 'Tidak ada'],
            ['nama' => 'Asma'],
            ['nama' => 'Tipes'],
            ['nama' => 'Darah rendah'],
            ['nama' => 'Darah tinggi'],
            ['nama' => 'Epilepsi'],
            ['nama' => 'Paru paru basah'],
            ['nama' => 'Usus buntu'],
            ['nama' => 'Asam lambung'],
        ]);

        $this->command->info('Seeder DataPenyakit Berhasil');
    }
}
