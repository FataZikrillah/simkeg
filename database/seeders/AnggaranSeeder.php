<?php

namespace Database\Seeders;

use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class AnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = Kegiatan::first();

        Anggaran::create([
            'kegiatan_id' => $kegiatan->id,
            'jumlah' => 7500000,
            'sumber_dana' => 'Kas Kantor',
            'keterangan' => 'Biaya konsumsi dan operasional',
            'status' => 'disetujui',
        ]);
    }
}
