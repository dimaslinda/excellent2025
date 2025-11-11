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
        Schema::create('minat_soals', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->string('jenjang')->nullable(); // SD/SMP/SMA
            $table->enum('tingkatan_sd', ['rendah', 'tinggi'])->nullable(); // khusus SD
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
        Schema::dropIfExists('minat_soals');
    }
};