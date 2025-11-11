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
        Schema::table('quiz_soals', function (Blueprint $table) {
            $table->string('jenjang')->nullable()->after('pertanyaan'); // SD/SMP/SMA
            $table->enum('tingkatan_sd', ['rendah', 'tinggi'])->nullable()->after('jenjang'); // khusus SD
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_soals', function (Blueprint $table) {
            $table->dropColumn(['jenjang', 'tingkatan_sd']);
        });
    }
};