@extends('layouts.main')

@section('konten')
    <section class="container mx-auto px-4 py-20 md:py-32 font-poppins">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                @if (session('warning'))
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-6">
                        <div class="flex-shrink-0">
                            @if (session('registrasi.foto_path'))
                                @php $foto = session('registrasi.foto_path'); @endphp
                                @php $isUrl = \Illuminate\Support\Str::startsWith($foto, ['http://','https://']); @endphp
                                <img src="{{ $isUrl ? $foto : asset('storage/' . $foto) }}" alt="Foto Siswa" class="w-24 h-24 md:w-32 md:h-32 rounded-full object-cover border">
                            @else
                                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-100 flex items-center justify-center border">
                                    <span class="text-gray-500 text-sm">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 md:mt-0 flex-1">
                            <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ session('registrasi.name') }}</h1>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700">
                                <p><strong>Jenjang:</strong> {{ session('registrasi.jenjang') }}</p>
                                <p><strong>Asal Sekolah:</strong> {{ session('registrasi.sekolah') }}</p>
                                @if (session('registrasi.jenjang') === 'SD')
                                    <p><strong>Tingkatan SD:</strong> {{ session('registrasi.tingkatan_sd') == 'rendah' ? 'Rendah (Kelas 1–3)' : 'Tinggi (Kelas 4–6)' }}</p>
                                @endif
                                <p><strong>NISN:</strong> {{ session('registrasi.nisn') ?? '-' }}</p>
                                <p><strong>Provinsi:</strong> {{ session('registrasi.provinsi') }}</p>
                                <p><strong>Kota/Kabupaten:</strong> {{ session('registrasi.kota') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('profil_siswa'))
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Profil Siswa</h2>
                        <div class="bg-gray-50 p-4 rounded space-y-2">
                            @foreach (session('profil_siswa') as $profil)
                                @php
                                    $original = $profil['pertanyaan'] ?? '';
                                    $clean = trim(rtrim($original, '.:…'));
                                @endphp
                                <p class="flex items-start">
                                    <span class="text-gray-600 mr-2">{{ $clean }}:</span>
                                    <span class="font-semibold text-gray-900">{{ $profil['label'] }}</span>
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('minat_belajar'))
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Minat Belajar</h2>
                        @php
                            // Pemetaan copywriting agar ringkasan lebih enak dibaca
                            $minatTitles = [
                                'Saya lebih sering belajar menggunakan' => 'Perangkat belajar yang sering digunakan',
                                'Saya paling nyaman belajar di' => 'Tempat belajar paling nyaman',
                                'Tipe materi yang paling saya sukai' => 'Tipe materi favorit',
                                'Cara belajar yang paling cocok untuk saya' => 'Cara belajar yang paling cocok',
                                'Tujuan utama belajar saya saat ini' => 'Tujuan belajar saat ini',
                                'Metode evaluasi yang paling saya sukai' => 'Metode evaluasi yang disukai',
                                'Durasi sesi belajar ideal saya' => 'Durasi sesi belajar ideal',
                                'Saya lebih mudah memahami materi ketika' => 'Kondisi belajar yang memudahkan',
                                'Waktu belajar yang paling tersedia untuk saya' => 'Waktu belajar yang tersedia',
                                'Media pencatatan favorit saya' => 'Media pencatatan favorit',
                            ];
                        @endphp
                        <div class="bg-gray-50 p-4 rounded space-y-2">
                            @foreach (session('minat_belajar') as $minat)
                                @php
                                    $original = $minat['pertanyaan'] ?? '';
                                    // Bersihkan tanda baca di akhir pertanyaan
                                    $clean = trim(rtrim($original, '.:…'));
                                    $title = $clean;
                                    foreach ($minatTitles as $needle => $friendly) {
                                        if (\Illuminate\Support\Str::contains($clean, $needle)) {
                                            $title = $friendly;
                                            break;
                                        }
                                    }
                                @endphp
                                <p class="flex items-start">
                                    <span class="text-gray-600 mr-2">{{ $title }}:</span>
                                    <span class="font-semibold text-gray-900">{{ $minat['label'] }}</span>
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <h2 class="text-xl font-bold text-center mb-6">Hasil Tes Gaya Belajar</h2>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Gaya Belajar Anda</h2>
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4">
                        <p class="font-bold">Gaya Belajar: {{ ucfirst($hasil->gaya_belajar) }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Skor Detail</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="font-semibold">Visual</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $skor['visual'] }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="font-semibold">Auditori</p>
                            <p class="text-2xl font-bold text-green-600">{{ $skor['auditori'] }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="font-semibold">Kinestetik</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $skor['kinestetik'] }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="font-semibold">Read/Write</p>
                            <p class="text-2xl font-bold text-purple-600">{{ $skor['readwrite'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Penjelasan Gaya Belajar</h2>
                    <div class="prose max-w-none">
                        @if ($hasil->gaya_belajar == 'visual')
                            <p>Anda memiliki gaya belajar visual yang dominan. Ini berarti Anda lebih mudah memahami
                                informasi melalui gambar, diagram, dan visualisasi. Beberapa tips belajar untuk Anda:</p>
                            <ul>
                                <li>Gunakan mind map atau diagram untuk mengorganisir informasi</li>
                                <li>Buat catatan dengan warna dan simbol</li>
                                <li>Gunakan video pembelajaran</li>
                                <li>Visualisasikan konsep yang sulit</li>
                            </ul>
                        @elseif($hasil->gaya_belajar == 'auditori')
                            <p>Anda memiliki gaya belajar auditori yang dominan. Ini berarti Anda lebih mudah memahami
                                informasi melalui suara dan diskusi. Beberapa tips belajar untuk Anda:</p>
                            <ul>
                                <li>Rekam materi pembelajaran</li>
                                <li>Diskusikan materi dengan teman</li>
                                <li>Gunakan podcast atau audio pembelajaran</li>
                                <li>Baca materi dengan suara keras</li>
                            </ul>
                        @elseif($hasil->gaya_belajar == 'kinestetik')
                            <p>Anda memiliki gaya belajar kinestetik yang dominan. Ini berarti Anda lebih mudah memahami
                                informasi melalui aktivitas fisik dan praktik langsung. Beberapa tips belajar untuk Anda:
                            </p>
                            <ul>
                                <li>Lakukan eksperimen atau praktikum</li>
                                <li>Buat model atau prototipe</li>
                                <li>Gunakan gerakan untuk mengingat informasi</li>
                                <li>Belajar sambil berjalan atau bergerak</li>
                            </ul>
                        @else
                            <p>Anda memiliki gaya belajar read/write yang dominan. Ini berarti Anda lebih mudah memahami
                                informasi melalui teks dan tulisan. Beberapa tips belajar untuk Anda:</p>
                            <ul>
                                <li>Buat catatan terstruktur</li>
                                <li>Baca dan tulis ulang materi</li>
                                <li>Buat rangkuman</li>
                                <li>Gunakan flashcard</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="text-center space-x-2">
                    <a href="{{ route('assessment.hasil.download') }}" class="inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                        Unduh PDF
                    </a>
                    <a href="/" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
