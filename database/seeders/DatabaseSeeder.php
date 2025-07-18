<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DataPenyakit;
use Database\Seeders\UserWithRolesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UserWithRolesSeeder::class);
        $this->call(DataPenyakit::class);
        $this->call(DataSaudara::class);
        $this->call(KontakSeeder::class);
        $this->call(WelcomeSeeder::class);
        $this->call(CoverSeeder::class);
    }
}
