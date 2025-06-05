<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak::create([
            'no_telp' => '0888888',
            'alamat' => 'semarang, jawa tengah',
            'email' => 'tes@example.com'
        ]);

        $this->command->info('Seeder Kontak Berhasil');
    }
}
