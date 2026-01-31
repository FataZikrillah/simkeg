<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('role', 'staff')->first();

        Kegiatan::create([
            'judul' => 'Rapat Evaluasi Bulanan',
            'deskripsi' => 'Evaluasi kegiatan dan penggunaan anggaran.',
            'tanggal' => now()->toDateString(),
            'lokasi' => 'Ruang Rapat Utama',
            'user_id' => $staff->id,
            'status' => 'disetujui',
        ]);
    }
}
