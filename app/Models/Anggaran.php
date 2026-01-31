<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggaran';

    protected $fillable = [
        'kegiatan_id',
        'jumlah',
        'sumber_dana',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
    ];

    /* ================= RELATIONS ================= */

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
