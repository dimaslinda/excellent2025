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
    <section class="py-10">
        <div class="container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 place-items-center">
                @forelse ($ebooks as $item)
                    @php
                        $cover = $item->getFirstMediaUrl('ebook_cover');
                        $fileMedia = $item->getFirstMedia('ebook_file');
                    @endphp
                    <div
                        class="max-w-sm rounded-xl flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl h-full">
                        <div class="max-h-[350px] overflow-hidden">
                            <img src="{{ $cover ?: asset('img/general/modul.webp') }}" class="h-full w-full object-cover"
                                alt="ebook">
                        </div>
                        <div class="p-6 flex flex-col gap-4 h-full">
                            <div
                                class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins tracking-wide leading-normal">
                                {{ $item->name }}
                            </div>
                            @if ($item->author)
                                <div class="text-sm font-poppins text-gray-600">
                                    Oleh <span class="font-semibold">{{ $item->author }}</span>
                                </div>
                            @endif
                            @if ($item->level)
                                <div
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 w-max">
                                    {{ $item->level }}
                                </div>
                            @endif
                            @if ($item->description)
                                <p class="text-sm text-cardhitam font-poppins text-justify line-clamp-3">
                                    {{ $item->description }}
                                </p>
                            @endif
                            <div class="mt-auto flex justify-center w-full text-center group">
                                @if ($fileMedia)
                                    <a href="{{ route('ebook.download', $item) }}"
                                        class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                        download e-book
                                    </a>
                                @else
                                    <button
                                        class="text-gray-500 bg-gray-200 py-2 px-5 rounded-full w-full uppercase font-bold cursor-not-allowed">
                                        file belum tersedia
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
