<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MinatSoal;
use App\Models\MinatJawaban;

class MinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama agar tidak duplikasi
        MinatJawaban::query()->delete();
        MinatSoal::query()->delete();

        // Pertanyaan minat bersifat global (tanpa jenjang)

        $dataset = [
            [
                'pertanyaan' => 'Saya lebih sering belajar menggunakan...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Laptop', 'value' => 'device_laptop'],
                    ['kode' => 'B', 'label' => 'PC Desktop', 'value' => 'device_pc'],
                    ['kode' => 'C', 'label' => 'Smartphone/Tablet', 'value' => 'device_mobile'],
                    ['kode' => 'D', 'label' => 'Offline (buku cetak)', 'value' => 'device_offline'],
                ],
            ],
            [
                'pertanyaan' => 'Saya paling nyaman belajar di...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Rumah', 'value' => 'place_home'],
                    ['kode' => 'B', 'label' => 'Sekolah/Kampus', 'value' => 'place_school'],
                    ['kode' => 'C', 'label' => 'Perpustakaan', 'value' => 'place_library'],
                    ['kode' => 'D', 'label' => 'Kafe/Co-working', 'value' => 'place_cowork'],
                ],
            ],
            [
                'pertanyaan' => 'Tipe materi yang paling saya sukai...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Video', 'value' => 'content_video'],
                    ['kode' => 'B', 'label' => 'Artikel/Teks', 'value' => 'content_text'],
                    ['kode' => 'C', 'label' => 'Slide/Presentasi', 'value' => 'content_slide'],
                    ['kode' => 'D', 'label' => 'Interaktif/Kuis', 'value' => 'content_quiz'],
                ],
            ],
            [
                'pertanyaan' => 'Cara belajar yang paling cocok untuk saya...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Belajar mandiri', 'value' => 'method_self'],
                    ['kode' => 'B', 'label' => 'Diskusi kelompok', 'value' => 'method_group'],
                    ['kode' => 'C', 'label' => 'Bimbingan tutor', 'value' => 'method_tutor'],
                    ['kode' => 'D', 'label' => 'Praktik langsung', 'value' => 'method_practice'],
                ],
            ],
            [
                'pertanyaan' => 'Tujuan utama belajar saya saat ini...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Meningkatkan nilai', 'value' => 'goal_grade'],
                    ['kode' => 'B', 'label' => 'Menguasai skill baru', 'value' => 'goal_skill'],
                    ['kode' => 'C', 'label' => 'Persiapan ujian/sertifikasi', 'value' => 'goal_exam'],
                    ['kode' => 'D', 'label' => 'Menyelesaikan tugas/proyek', 'value' => 'goal_project'],
                ],
            ],
            [
                'pertanyaan' => 'Metode evaluasi yang paling saya sukai...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Kuis singkat', 'value' => 'eval_quiz'],
                    ['kode' => 'B', 'label' => 'Ujian tertulis', 'value' => 'eval_test'],
                    ['kode' => 'C', 'label' => 'Presentasi', 'value' => 'eval_presentation'],
                    ['kode' => 'D', 'label' => 'Proyek/Praktikum', 'value' => 'eval_project'],
                ],
            ],
            [
                'pertanyaan' => 'Durasi sesi belajar ideal saya...',
                'options' => [
                    ['kode' => 'A', 'label' => '< 30 menit', 'value' => 'duration_lt_30'],
                    ['kode' => 'B', 'label' => '30–60 menit', 'value' => 'duration_30_60'],
                    ['kode' => 'C', 'label' => '60–90 menit', 'value' => 'duration_60_90'],
                    ['kode' => 'D', 'label' => '> 90 menit', 'value' => 'duration_gt_90'],
                ],
            ],
            [
                'pertanyaan' => 'Saya lebih mudah memahami materi ketika...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Diberi contoh nyata', 'value' => 'understand_example'],
                    ['kode' => 'B', 'label' => 'Visualisasi/grafik', 'value' => 'understand_visual'],
                    ['kode' => 'C', 'label' => 'Penjelasan terstruktur', 'value' => 'understand_structured'],
                    ['kode' => 'D', 'label' => 'Diskusi tanya jawab', 'value' => 'understand_discussion'],
                ],
            ],
            [
                'pertanyaan' => 'Waktu belajar yang paling tersedia untuk saya...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Pagi', 'value' => 'time_morning'],
                    ['kode' => 'B', 'label' => 'Siang', 'value' => 'time_noon'],
                    ['kode' => 'C', 'label' => 'Sore', 'value' => 'time_evening'],
                    ['kode' => 'D', 'label' => 'Malam', 'value' => 'time_night'],
                ],
            ],
            [
                'pertanyaan' => 'Media pencatatan favorit saya...',
                'options' => [
                    ['kode' => 'A', 'label' => 'Buku catatan', 'value' => 'note_book'],
                    ['kode' => 'B', 'label' => 'Aplikasi catatan', 'value' => 'note_app'],
                    ['kode' => 'C', 'label' => 'Spreadsheet', 'value' => 'note_sheet'],
                    ['kode' => 'D', 'label' => 'Mind map/diagram', 'value' => 'note_mindmap'],
                ],
            ],
        ];

        foreach ($dataset as $index => $item) {
            $soal = MinatSoal::create([
                'pertanyaan' => $item['pertanyaan'],
                'jenjang' => null,
                'tingkatan_sd' => null,
                'urutan' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($item['options'] as $i => $opt) {
                MinatJawaban::create([
                    'soal_id' => $soal->id,
                    'kode' => $opt['kode'],
                    'label' => $opt['label'],
                    'value' => $opt['value'],
                    'urutan' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}