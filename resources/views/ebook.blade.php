@extends('layouts.main')

@section('banner')
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-modul.webp')] bg-no-repeat bg-cover">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    e-book
                </div>
            </h1>
        </div>
    </section>
@endsection

@section('konten')
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 place-items-center">
                @forelse ($ebooks as $item)
                    @php
                        $cover = $item->getFirstMediaUrl('ebook_cover');
                        $fileMedia = $item->getFirstMedia('ebook_file');
                    @endphp
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                        class="w-full max-w-sm rounded-2xl flex flex-col overflow-hidden bg-white shadow-lg hover:shadow-2xl transition-all duration-300 h-full group">
                        <a href="{{ route('ebook.detail', $item) }}" class="block overflow-hidden relative pt-[75%]">
                            {{-- Aspect ratio 4:3 --}}
                            <img src="{{ $cover ?: asset('img/general/modul.webp') }}"
                                class="absolute top-0 left-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-500"
                                alt="{{ $item->name }}">
                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                <span
                                    class="opacity-0 group-hover:opacity-100 bg-white/90 text-gray-800 px-4 py-2 rounded-full font-bold transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    Lihat Detail
                                </span>
                            </div>
                        </a>
                        <div class="p-6 flex flex-col gap-4 h-full relative">
                            <div
                                class="capitalize text-footer text-xl font-bold line-clamp-2 font-poppins tracking-wide leading-tight group-hover:text-headerbanner transition-colors duration-300">
                                <a href="{{ route('ebook.detail', $item) }}">
                                    {{ $item->name }}
                                </a>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                @if ($item->author)
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ Str::limit($item->author, 15) }}
                                    </span>
                                @endif
                                @if ($item->level)
                                    <span
                                        class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                        {{ $item->level }}
                                    </span>
                                @endif
                            </div>

                            @if ($item->description)
                                <p class="text-sm text-gray-600 font-poppins text-justify line-clamp-3 leading-relaxed">
                                    {{ $item->description }}
                                </p>
                            @endif

                            <div class="mt-auto pt-4 flex justify-center w-full text-center">
                                @if ($fileMedia)
                                    <a href="{{ route('ebook.download', $item) }}"
                                        class="text-white bg-headerbanner hover:bg-orange-600 py-2.5 px-6 rounded-xl w-full uppercase font-bold text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                @else
                                    <button
                                        class="text-gray-400 bg-gray-100 py-2.5 px-6 rounded-xl w-full uppercase font-bold text-sm cursor-not-allowed border border-gray-200">
                                        File Belum Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <h2 class="text-2xl font-bold text-gray-500">Mohon maaf, belum ada data E-Book yang tersedia</h2>
                        <p class="text-gray-400 mt-2">Silakan cek kembali di lain waktu</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
