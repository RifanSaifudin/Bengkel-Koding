<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder agar data user masuk
        $this->call([
            PoliSeeder::class,
            UserSeeder::class,
        ]);
    }
}
