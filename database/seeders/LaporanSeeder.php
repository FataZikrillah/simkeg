<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
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
            // Generate 6-10 reports per kegiatan
            $count = rand(6, 10);

            for ($i = 0; $i < $count; $i++) {
                Laporan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'user_id' => $kegiatan->user_id,
                    'judul' => 'Laporan: ' . $faker->sentence(rand(3, 6)),
                    'isi' => $faker->realText(rand(600, 1000)),
                    'file_pdf' => 'laporan/dummy-report-' . $faker->word . '.pdf',
                    'status' => $faker->randomElement(['pending', 'disetujui', 'ditolak']),
                    'tanggal_laporan' => $kegiatan->tanggal->isFuture()
                        ? $kegiatan->tanggal
                        : $faker->dateTimeBetween($kegiatan->tanggal, 'now'),
                ]);
            }
        }
    }
}
