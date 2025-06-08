<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        Kontak::create([
            'no_telp' => '0888888',
            'alamat' => 'Dsn. Blater, Desa Jimbaran, Kec. Bandungan, Kab. Semarang 50661',
            'email' => 'smpblater01@gmail.com'
        ]);

        $this->command->info('Seeder Kontak Berhasil');
    }
}
