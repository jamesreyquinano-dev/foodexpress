<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // Create a standard login account without any extra role columns
        if (!User::where('email', 'admin@foodexpress.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@foodexpress.com',
                'password' => bcrypt('password'), // Password is: password
            ]);
        }
    }
}