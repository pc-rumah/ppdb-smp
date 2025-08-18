<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['master-admin', 'admin', 'ppdb', 'staff', 'madrasah', 'pondok'];

        foreach ($roles as $roleName) {
            // Buat role jika belum ada
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Buat user untuk setiap role
            $user = User::firstOrCreate(
                ['email' => $roleName . '@example.com'],
                [
                    'name' => ucfirst($roleName),
                    'password' => Hash::make('password'),
                ]
            );

            $user->assignRole($role);
        }
        $this->command->info('Seeder User Berhasil');
    }
}
