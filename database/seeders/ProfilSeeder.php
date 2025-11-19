<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProfilSoal;
use App\Models\ProfilJawaban;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama agar tidak duplikasi
        DB::transaction(function () {
            ProfilJawaban::query()->delete();
            ProfilSoal::query()->delete();

            // Dataset "Profil Siswa" dari Canva – 10 soal dengan opsi A–D
            // Hanya untuk jenjang: SD (tinggi)
            $dataset = [
                [
                    'pertanyaan' => 'Di rumah, saya tinggal bersama…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Ayah dan Ibu'],
                        ['kode' => 'B', 'label' => 'Hanya dengan Ayah'],
                        ['kode' => 'C', 'label' => 'Hanya dengan Ibu'],
                        ['kode' => 'D', 'label' => 'Dengan keluarga lain (kakek/nenek/paman/bibi/wali)'],
                    ],
                ],
                [
                    'pertanyaan' => 'Pekerjaan Ayah saya adalah…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak bekerja'],
                        ['kode' => 'B', 'label' => 'Pegawai/karyawan'],
                        ['kode' => 'C', 'label' => 'Usaha sendiri'],
                        ['kode' => 'D', 'label' => 'Pegawai pemerintah/ASN/TNI/Polri'],
                    ],
                ],
                [
                    'pertanyaan' => 'Pekerjaan Ibu saya adalah…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak bekerja/ibu rumah tangga'],
                        ['kode' => 'B', 'label' => 'Pegawai/karyawan'],
                        ['kode' => 'C', 'label' => 'Usaha sendiri'],
                        ['kode' => 'D', 'label' => 'Pegawai pemerintah/ASN/TNI/Polri'],
                    ],
                ],
                [
                    'pertanyaan' => 'Saat saya belajar di rumah, orang tua saya…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak mendampingi'],
                        ['kode' => 'B', 'label' => 'Mendampingi kalau saya minta'],
                        ['kode' => 'C', 'label' => 'Cukup sering mendampingi'],
                        ['kode' => 'D', 'label' => 'Selalu mendampingi'],
                    ],
                ],
                [
                    'pertanyaan' => 'Di rumah, saya punya tempat belajar yang…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak ada tempat khusus'],
                        ['kode' => 'B', 'label' => 'Ada, tapi sering ramai'],
                        ['kode' => 'C', 'label' => 'Ada dan cukup nyaman'],
                        ['kode' => 'D', 'label' => 'Ada dan sangat nyaman serta tenang'],
                    ],
                ],
                [
                    'pertanyaan' => 'Di rumah, saya punya alat belajar seperti buku, pensil, atau meja belajar…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Sangat kurang'],
                        ['kode' => 'B', 'label' => 'Ada tetapi tidak lengkap'],
                        ['kode' => 'C', 'label' => 'Cukup lengkap'],
                        ['kode' => 'D', 'label' => 'Sangat lengkap'],
                    ],
                ],
                [
                    'pertanyaan' => 'Untuk belajar online, di rumah saya punya akses internet…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak punya'],
                        ['kode' => 'B', 'label' => 'Kadang bisa dipakai'],
                        ['kode' => 'C', 'label' => 'Ada tapi tidak stabil'],
                        ['kode' => 'D', 'label' => 'Ada dan bisa dipakai kapan saja'],
                    ],
                ],
                [
                    'pertanyaan' => 'Orang tua saya biasanya membantu saya belajar dengan cara…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Tidak membantu'],
                        ['kode' => 'B', 'label' => 'Mengingatkan saja'],
                        ['kode' => 'C', 'label' => 'Menjelaskan kalau saya tidak paham'],
                        ['kode' => 'D', 'label' => 'Aktif mendampingi dan membantu menjelaskan'],
                    ],
                ],
                [
                    'pertanyaan' => 'Setelah pulang sekolah, saya biasanya…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Langsung bermain'],
                        ['kode' => 'B', 'label' => 'Membantu orang tua'],
                        ['kode' => 'C', 'label' => 'Belajar sebentar lalu bermain'],
                        ['kode' => 'D', 'label' => 'Belajar, mengerjakan tugas, atau ikut ekskul/les'],
                    ],
                ],
                [
                    'pertanyaan' => 'Menurut saya, dukungan orang tua terhadap belajar saya adalah…',
                    'options' => [
                        ['kode' => 'A', 'label' => 'Sangat sedikit'],
                        ['kode' => 'B', 'label' => 'Cukup, tapi tidak sering'],
                        ['kode' => 'C', 'label' => 'Mendukung'],
                        ['kode' => 'D', 'label' => 'Sangat mendukung dan selalu membantu'],
                    ],
                ],
            ];

            foreach ($dataset as $index => $item) {
                $soal = ProfilSoal::create([
                    'pertanyaan' => $item['pertanyaan'],
                    'jenjang' => 'SD',
                    'tingkatan_sd' => 'tinggi',
                    'urutan' => $index + 1,
                    'is_active' => true,
                ]);

                foreach ($item['options'] as $i => $opt) {
                    ProfilJawaban::create([
                        'soal_id' => $soal->id,
                        'kode' => $opt['kode'],
                        'label' => $opt['label'],
                        'value' => 0, // nilai tidak dipakai untuk profil
                        'urutan' => $i + 1,
                        'is_active' => true,
                    ]);
                }
            }
        });
    }
}