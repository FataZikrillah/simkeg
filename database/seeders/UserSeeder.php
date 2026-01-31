<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Set Faker Locale to Indonesia
        $faker = \Faker\Factory::create('id_ID');

        // 1 Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@simkeg.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => $faker->phoneNumber(),
            'is_active' => true,
        ]);

        // 1 Pimpinan
        User::create([
            'name' => $faker->name(),
            'email' => 'pimpinan@simkeg.test',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'phone' => $faker->phoneNumber(),
            'is_active' => true,
        ]);

        // 20 Staff
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => $faker->phoneNumber(),
                'is_active' => true,
            ]);
        }
    }
}
