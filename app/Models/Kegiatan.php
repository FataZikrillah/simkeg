<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'waktu_mulai',
        'lokasi',
        'prioritas',
        'user_id',
        'status',
        'image',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /* ================= RELATIONS ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class);
    }

    public function anggaran()
    {
        return $this->hasMany(Anggaran::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
