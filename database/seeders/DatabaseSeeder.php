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
        // Check if the admin already exists so it doesn't create duplicates
        if (!User::where('email', 'admin@foodexpress.com')->exists()) {
           User::create([
            'name' => 'James Rey',
            'email' => 'jamesreyquinano@gmail.com', // Your email here
            'password' => bcrypt('12345'),          // Your password here
            'gender' => 'Male',
        ]);
        }
    }
}