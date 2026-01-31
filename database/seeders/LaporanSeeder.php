<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = Kegiatan::first();

        Laporan::create([
            'kegiatan_id' => $kegiatan->id,
            'judul' => 'Laporan Kegiatan Rapat Evaluasi',
            'isi' => 'Kegiatan berjalan lancar dan menghasilkan beberapa keputusan strategis.',
            'file_pdf' => 'laporan/rapat-evaluasi.pdf',
        ]);
    }
}
