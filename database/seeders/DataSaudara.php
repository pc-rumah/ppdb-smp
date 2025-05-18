<?php

namespace Database\Seeders;

use App\Models\Saudara;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSaudara extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saudara::insert([
            ['nama' => 'tidak ada'],
            ['nama' => 'kakak kandung'],
            ['nama' => 'saudara'],
            ['nama' => 'sepupu'],
            ['nama' => 'alumni'],
        ]);

        $this->command->info('Seeder DataSaudara Berhasil');
    }
}
