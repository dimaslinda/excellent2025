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
        Schema::table('pesertas', function (Blueprint $table) {
            $table->string('jenjang')->after('sekolah'); // SD/SMP/SMA
            $table->enum('tingkatan_sd', ['rendah', 'tinggi'])->nullable()->after('jenjang'); // khusus SD
            $table->string('nisn', 20)->nullable()->after('email_guru');
            $table->string('foto_path')->nullable()->after('nisn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn(['jenjang', 'tingkatan_sd', 'nisn', 'foto_path']);
        });
    }
};