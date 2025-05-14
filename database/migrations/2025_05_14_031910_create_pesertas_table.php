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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sekolah');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('nomor_whatsapp_orang_tua', 20)->regex('/^[0-9]+$/');
            $table->string('nomor_whatsapp_guru', 20)->regex('/^[0-9]+$/');
            $table->string('email_guru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
