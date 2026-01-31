<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();

            // informasi utama kegiatan
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->string('lokasi');

            // relasi ke user (staff yang input)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // status kegiatan
            $table->enum('status', ['draft', 'disetujui'])
                  ->default('draft');

            // waktu dibuat & diupdate
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
