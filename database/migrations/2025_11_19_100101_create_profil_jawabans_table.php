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
        Schema::create('profil_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('profil_soals')->onDelete('cascade');
            $table->string('kode', 1)->nullable();
            $table->string('label');
            $table->string('value');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_jawabans');
    }
};