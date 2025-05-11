<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    // Sukuriame vaidmenis
    $adminRole = Role::create(['name' => 'admin']);
    $userRole = Role::create(['name' => 'user']);

    // Sukuriame administratorių ir priskiriame vaidmenį
    $admin = User::find(1); // Gaukite naudotoją su ID 1
    $admin->roles()->attach($adminRole);

    // Sukuriame kitus naudotojus, jei reikia
    $user = User::find(2);
    $user->roles()->attach($userRole);


    }
}
