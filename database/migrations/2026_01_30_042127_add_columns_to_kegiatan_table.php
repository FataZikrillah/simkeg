<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->time('waktu_mulai')->nullable()->after('tanggal');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang')->after('lokasi');
            // Change status to string for better flexibility in SQLite
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['waktu_mulai', 'prioritas']);
        });
    }
};
