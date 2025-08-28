<?php

namespace Database\Seeders;

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
        $this->call(UserWithRolesSeeder::class);
        $this->call(DataPenyakit::class);
        $this->call(DataSaudara::class);
        $this->call(KontakSeeder::class);
        $this->call(WelcomeSeeder::class);
        $this->call(CoverSeeder::class);
        $this->call(KontakUnitSeeder::class);
        $this->call(KontakSeeder::class);
    }
}
