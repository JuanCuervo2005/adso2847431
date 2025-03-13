<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders
       $this ->call([
            UserSeeder::class,
            PetSeeder::class
       ]);
       // Factories
       Pet  :: factory(100)->create();
       User :: factory(25)->create();
    }
}
