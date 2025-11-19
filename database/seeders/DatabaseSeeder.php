<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MinatSeeder;
use Database\Seeders\ProfilSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed contoh pertanyaan minat belajar
        $this->call(MinatSeeder::class);

        // Seed pertanyaan Profil Siswa (SD Tinggi)
        $this->call(ProfilSeeder::class);
    }
}
