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
        Schema::create('quiz_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('quiz_soals')->onDelete('cascade');
            $table->text('jawaban');
            $table->enum('gaya_belajar', ['visual', 'auditori', 'kinestetik', 'readwrite'])->default('visual');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_jawabans');
    }
};
