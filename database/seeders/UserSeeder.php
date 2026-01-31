<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@simkeg.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0811111111',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Staff Kegiatan',
            'email' => 'staff@simkeg.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'phone' => '0822222222',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@simkeg.test',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'is_active' => true,
        ]);
    }
}
