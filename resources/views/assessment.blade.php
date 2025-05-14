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

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-lg font-semibold">Data Registrasi:</h2>
                            <a href="{{ route('registrasi') }}"
                                class="inline-flex items-center px-4 py-2 bg-headerbanner text-white rounded-full hover:bg-footer transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit Data
                            </a>
                        </div>
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
                    <form method="POST" action="{{ route('assessment.store') }}">
                        @csrf
                        @for ($i = 1; $i <= 30; $i++)
                            <div class="mb-4">
                                <label class="block">
                                    {{ $i }}. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </label>
                                @for ($j = 1; $j <= 5; $j++)
                                    <label class="block mt-1 font-poppins">
                                        <input type="radio" name="question_{{ $i }}"
                                            value="{{ $j }}"
                                            class="mr-2 text-headerbanner focus:ring-headerbanner">
                                        Lorem ipsum pilihan {{ $j }}
                                    </label>
                                @endfor
                            </div>
                        @endfor
                        <button type="submit"
                            class="mt-4 w-full bg-headerbanner uppercase font-poppins text-white py-2 rounded-full hover:bg-footer">
                            submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
