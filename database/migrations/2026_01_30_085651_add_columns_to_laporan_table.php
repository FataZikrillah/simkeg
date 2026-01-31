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
        Schema::table('laporan', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('kegiatan_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pending')->after('file_pdf');
            $table->date('tanggal_laporan')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'status', 'tanggal_laporan']);
        });
    }
};
