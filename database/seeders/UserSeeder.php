<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Admin 3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Admin 4',
            'email' => 'admin4@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->command->info('User Seeder Berhasil');
    }
}
