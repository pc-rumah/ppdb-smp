<?php

namespace Database\Seeders;

use App\Models\Sakit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataPenyakit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sakit::insert([
            ['nama' => 'asma'],
            ['nama' => 'tipes'],
            ['nama' => 'darah rendah'],
            ['nama' => 'darah tinggi'],
            ['nama' => 'epilepsi'],
            ['nama' => 'paru paru basah'],
            ['nama' => 'usus buntu'],
            ['nama' => 'asam lambung'],
        ]);

        $this->command->info('Seeder DataPenyakit Berhasil');
    }
}
