<?php

namespace Database\Seeders;

use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = Kegiatan::first();

        Dokumentasi::create([
            'kegiatan_id' => $kegiatan->id,
            'file' => 'dokumentasi/rapat-evaluasi.jpg',
            'keterangan' => 'Dokumentasi rapat evaluasi',
        ]);
    }
}
