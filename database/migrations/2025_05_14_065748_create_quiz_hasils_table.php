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
        Schema::create('quiz_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
            $table->enum('gaya_belajar', ['visual', 'auditori', 'kinestetik', 'readwrite']);
            $table->integer('skor_visual')->default(0);
            $table->integer('skor_auditori')->default(0);
            $table->integer('skor_kinestetik')->default(0);
            $table->integer('skor_readwrite')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_hasils');
    }
};
