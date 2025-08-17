<?php

namespace Database\Seeders;

use App\Models\Kontak_Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontakUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak_Unit::create([
            'role_name' => 'staff',
            'telepon' => '081234567890',
            'email' => 'info@smpsekolah.com',
            'alamat' => 'Jl. Pendidikan No.1, Kota A'
        ]);

        Kontak_Unit::create([
            'role_name' => 'madrasah',
            'telepon' => '082345678901',
            'email' => 'info@madrasah.com',
            'alamat' => 'Jl. Madrasah No.2, Kota B'
        ]);

        Kontak_Unit::create([
            'role_name' => 'pondok',
            'telepon' => '083456789012',
            'email' => 'info@pondok.com',
            'alamat' => 'Jl. Pondok No.3, Kota C'
        ]);
    }
}
