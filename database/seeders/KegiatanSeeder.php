<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $staffMembers = User::where('role', 'staff')->get();

        if ($staffMembers->isEmpty()) {
            $this->command->info('No staff users found. Please run UserSeeder first.');
            return;
        }

        foreach ($staffMembers as $staff) {
            // Generate 5-8 activities per staff
            $count = rand(5, 8);

            for ($i = 0; $i < $count; $i++) {
                Kegiatan::create([
                    'judul' => $faker->sentence(rand(4, 8)),
                    'deskripsi' => $faker->realText(500),
                    'tanggal' => $faker->dateTimeBetween('-6 months', '+1 month')->format('Y-m-d'),
                    'waktu_mulai' => $faker->time('H:i'),
                    'lokasi' => $faker->address,
                    'prioritas' => $faker->randomElement(['rendah', 'sedang', 'tinggi']),
                    'user_id' => $staff->id,
                    'status' => $faker->randomElement(['draft', 'pending', 'disetujui', 'selesai']),
                    'image' => 'kegiatan/dummy-activity-' . rand(1, 10) . '.jpg',
                ]);
            }
        }
    }
}
