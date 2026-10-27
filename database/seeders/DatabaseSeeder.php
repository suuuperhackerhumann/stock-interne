<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // C'est ici qu'on appelle les autres seeders
        $this->call([
            InitialDataSeeder::class,
        ]);
    }
}