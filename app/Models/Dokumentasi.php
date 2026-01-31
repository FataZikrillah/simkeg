<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi';

    protected $fillable = [
        'kegiatan_id',
        'file',
        'keterangan',
    ];

    /* ================= RELATIONS ================= */

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
