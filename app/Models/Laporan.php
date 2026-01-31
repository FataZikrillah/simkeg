<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'judul',
        'isi',
        'file_pdf',
        'status',
        'tanggal_laporan',
    ];

    /* ================= RELATIONS ================= */

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
