<?php

namespace Database\Seeders;

use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class AnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $kegiatans = Kegiatan::all();

        if ($kegiatans->isEmpty()) {
            $this->command->info('No Kegiatan found. Please run KegiatanSeeder first.');
            return;
        }

        foreach ($kegiatans as $kegiatan) {
            // Generate 2-5 budget items per kegiatan
            $count = rand(2, 5);

            for ($i = 0; $i < $count; $i++) {
                Anggaran::create([
                    'kegiatan_id' => $kegiatan->id,
                    'jumlah' => $faker->numberBetween(500000, 20000000),
                    'sumber_dana' => $faker->randomElement(['Kas Kantor', 'APBD', 'Sponsor Internal', 'Hibah']),
                    'keterangan' => $faker->realText(50),
                    'status' => $faker->randomElement(['pending', 'disetujui']),
                ]);
            }
        }
    }
}
