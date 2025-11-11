<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_hasils', function (Blueprint $table) {
            $table->json('minat_summary')->nullable()->after('skor_readwrite');
        });
    }

    public function down(): void
    {
        Schema::table('quiz_hasils', function (Blueprint $table) {
            $table->dropColumn('minat_summary');
        });
    }
};