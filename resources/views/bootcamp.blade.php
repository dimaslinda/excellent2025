@extends('layouts.main')
@section('banner')
    {{-- banner --}}
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-bootcamp.webp')] bg-no-repeat bg-cover">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    bootcamp
                </div>
            </h1>
        </div>
    </section>
    {{-- end banner --}}
@endsection
@section('konten')
    <section class="py-10">
        <div class="container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 place-items-center">
                @forelse ($bootcamp as $item)
                    <div
                        class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                        <div class="max-h-[250px] overflow-hidden">
                            <img src="{{ $item->getFirstMediaUrl('bootcamp') }}" class="h-full w-full object-cover"
                                alt="modul">
                        </div>
                        <div class="p-6">
                            <div
                                class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                                {{ $item->name }}
                            </div>
                            <div class="font-bold font-poppins mb-5 text-2xl">
                                @currency($item->price)
                            </div>
                            <div class="flex justify-center w-full text-center group">
                                <a href="https://wa.me/+{{ $item->link }}" target="_blank"
                                    class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                    daftar
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <h2 class="text-2xl font-bold text-gray-500">Mohon maaf, belum ada data bootcamp yang tersedia
                        </h2>
                        <p class="text-gray-400 mt-2">Silakan cek kembali di lain waktu</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
