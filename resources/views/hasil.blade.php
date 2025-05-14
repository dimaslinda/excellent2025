@extends('layouts.main')

@section('konten')
    <section class="container mx-auto px-4 py-20 md:py-32 font-poppins">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-6">
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

                <h1 class="text-2xl font-bold text-center mb-6">Hasil Tes Gaya Belajar</h1>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Gaya Belajar Anda</h2>
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4">
                        <p class="font-bold">Gaya Belajar: {{ ucfirst($hasil->gaya_belajar) }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Skor Detail</h2>
                    <div class="grid grid-cols-2 gap-4">
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

                <div class="text-center">
                    <a href="/" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
