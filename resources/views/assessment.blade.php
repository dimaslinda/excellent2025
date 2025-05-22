@extends('layouts.main')
@section('konten')
    <section class="min-h-screen py-20 md:py-32">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p><strong>Nama Siswa:</strong> {{ session('registrasi.name') }}</p>
                                <p><strong>Asal Sekolah:</strong> {{ session('registrasi.sekolah') }}</p>
                                <p><strong>Provinsi:</strong> {{ session('registrasi.provinsi') }}</p>
                                <p><strong>Kota/Kabupaten:</strong> {{ session('registrasi.kota') }}</p>
                            </div>
                            <div>
                                <p><strong>No. WhatsApp Orang Tua:</strong>
                                    {{ session('registrasi.nomor_whatsapp_orang_tua') }}</p>
                                <p><strong>No. WhatsApp Guru:</strong> {{ session('registrasi.nomor_whatsapp_guru') }}</p>
                                <p><strong>Email Guru:</strong> {{ session('registrasi.email_guru') }}</p>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-xl font-bold font-poppins mb-4">JAWAB PERTANYAAN DI BAWAH INI SESUAI KEPRIBADIAN ANDA!
                    </h1>

                    @if ($soals->isEmpty())
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                            Belum ada soal quiz yang tersedia.
                        </div>
                    @else
                        <form method="POST" action="{{ route('assessment.hasil') }}">
                            @csrf
                            @foreach ($soals as $index => $soal)
                                <div class="mb-6 p-4 border rounded-lg">
                                    <label class="block text-lg font-medium mb-2">
                                        {{ $index + 1 }}. {{ $soal->pertanyaan }}
                                    </label>
                                    <div class="space-y-2">
                                        @foreach ($soal->jawaban as $jawaban)
                                            <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                                <input type="radio" name="jawaban[{{ $soal->id }}]"
                                                    value="{{ $jawaban->id }}"
                                                    class="mr-3 text-headerbanner focus:ring-headerbanner" required>
                                                <span class="text-gray-700">{{ $jawaban->jawaban }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit"
                                class="mt-6 w-full bg-headerbanner uppercase font-poppins text-white py-3 rounded-full hover:bg-footer transition-colors">
                                Kirim Jawaban
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
