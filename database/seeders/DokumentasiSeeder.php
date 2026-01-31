<?php

namespace Database\Seeders;

use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
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
            // Generate 3-6 documentation entries per kegiatan
            $count = rand(3, 6);

            for ($i = 0; $i < $count; $i++) {
                Dokumentasi::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file' => 'dokumentasi/dummy-photo-' . $faker->word . '-' . rand(1, 20) . '.jpg',
                    'keterangan' => $faker->realText(100),
                ]);
            }
        }
    }
}
