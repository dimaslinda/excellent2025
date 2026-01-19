@extends('layouts.main')

@section('banner')
    <section
        class="py-24 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-modul.webp')] bg-no-repeat bg-cover bg-center">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div> {{-- Overlay for better text readability --}}
        <div class="container mx-auto px-4 relative z-20 text-center">
            <h1 class="font-bold leading-tight text-white" data-aos="fade-down" data-aos-duration="1000">
                <span
                    class="inline-block bg-headerbanner/90 backdrop-blur-sm rounded-2xl py-4 px-8 md:px-12 shadow-2xl uppercase text-3xl md:text-5xl lg:text-7xl tracking-wider">
                    Detail E-Book
                </span>
            </h1>
        </div>
    </section>
@endsection

@section('konten')
    <section class="py-12 md:py-20 bg-gray-50 min-h-[50vh]">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 max-w-7xl">

            {{-- Breadcrumb / Back Link --}}
            <div class="mb-8" data-aos="fade-right" data-aos-delay="100">
                <a href="{{ route('ebook') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-headerbanner font-medium transition duration-300 group">
                    <div class="p-2 bg-white rounded-full shadow-sm group-hover:shadow-md transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span>Kembali ke Daftar E-Book</span>
                </a>
            </div>

            <div data-aos="fade-up" data-aos-delay="200">
                <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
                    {{-- Left Column: Cover Image --}}
                    <div class="lg:w-1/3 flex flex-col items-center">
                        @php
                            $cover = $ebook->getFirstMediaUrl('ebook_cover');
                            $fileMedia = $ebook->getFirstMedia('ebook_file');
                        @endphp

                        <div
                            class="relative z-10 w-full max-w-[350px] transform hover:scale-105 transition duration-500 perspective-1000">
                            <div class="rounded-xl overflow-hidden shadow-2xl bg-white">
                                <img src="{{ $cover ?: asset('img/general/modul.webp') }}"
                                    class="w-full h-auto object-cover aspect-[3/4]" alt="Cover {{ $ebook->name }}">
                            </div>
                            {{-- Shadow reflection effect --}}
                            <div class="absolute -bottom-6 left-6 right-6 h-6 bg-black/20 blur-2xl rounded-[100%]"></div>
                        </div>

                        <div class="mt-10 w-full max-w-[350px]">
                            @if ($fileMedia)
                                <a href="{{ route('ebook.download', $ebook) }}"
                                    class="group w-full inline-flex items-center justify-center gap-3 text-white bg-headerbanner hover:bg-orange-600 py-4 px-8 rounded-xl text-lg uppercase font-bold transition-all duration-300 shadow-lg hover:shadow-headerbanner/50 transform hover:-translate-y-1">
                                    <div
                                        class="bg-white/20 rounded-full p-1 group-hover:rotate-12 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </div>
                                    <span>Download E-Book</span>
                                </a>
                                <p class="mt-3 text-sm text-gray-500 text-center">
                                    *Klik tombol di atas untuk mengunduh file PDF
                                </p>
                            @else
                                <button
                                    class="w-full inline-flex items-center justify-center gap-3 text-gray-400 bg-gray-200 py-4 px-8 rounded-xl text-lg uppercase font-bold cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    File Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Right Column: Details --}}
                    <div class="lg:w-2/3 flex flex-col">
                        <div class="mb-2">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 font-poppins mb-6 leading-tight">
                                {{ $ebook->name }}
                            </h1>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-gray-200">
                                @if ($ebook->author)
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-1">Penulis</span>
                                            <span class="font-bold text-gray-900 text-lg">{{ $ebook->author }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xl shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-1">Tanggal
                                            Publikasi</span>
                                        <span
                                            class="font-bold text-gray-900 text-lg">{{ $ebook->created_at->format('d F Y') }}</span>
                                    </div>
                                </div>

                                @if ($ebook->level)
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center font-bold text-xl shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-1">Level</span>
                                            <span class="font-bold text-gray-900 text-lg">{{ $ebook->level }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="prose prose-lg max-w-none text-gray-700 font-poppins text-justify leading-relaxed">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h3>
                                @if ($ebook->description)
                                    {!! nl2br(e($ebook->description)) !!}
                                @else
                                    <p class="italic text-gray-400">Belum ada deskripsi untuk E-Book ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Optional: Related E-Books could go here in the future --}}

        </div>
    </section>
@endsection
