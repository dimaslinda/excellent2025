@extends('layouts.main')
@section('banner')
    {{-- banner --}}
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-webinar.webp')] bg-no-repeat bg-cover">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    webinar
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
                @forelse ($webinar as $item)
                    <div
                        class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                        <div class="max-h-[550px] overflow-hidden">
                            <img src="{{ asset('img/general/excellentteach-1.webp') }}" class="h-full w-full object-cover"
                                alt="modul">
                        </div>
                        <div class="p-6">
                            <div
                                class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                                pengembangan kualitas kompetensi guru melalui asesmen profiling modalitas siswa dan optimasi
                                teknologi artifical intelegence
                            </div>
                            <div class="flex justify-center w-full text-center group">
                                @if ($item->publish)
                                    <a href="{{ $item->link }}"
                                        class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                        daftar
                                    </a>
                                @else
                                    <button disabled
                                        class="text-white bg-[#C0B39E] py-2 px-5 rounded-full w-full uppercase font-bold cursor-not-allowed">
                                        Daftar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                {{-- <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-1.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            pengembangan kualitas kompetensi guru melalui asesmen profiling modalitas siswa dan optimasi
                            teknologi artifical intelegence
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-2.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            membangun karakter pancasila: peran AI dalam implementasi P5 di sekolah
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-3.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            implementasi soal lots & hots dalam meningkatkan literasi numerasi siswa
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-4.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            STEAM: Inovasi Pembelajaran Masa Depan
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-5.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            Pembelajaran Paradigma Baru untuk Guru Paud...
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-6.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            Pembuatan Konten Digital untuk Guru Paud
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="max-w-sm rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                    <div class="max-h-[550px] overflow-hidden">
                        <img src="{{ asset('img/general/excellentteach-7.webp') }}" class="h-full w-full object-cover"
                            alt="modul">
                    </div>
                    <div class="p-6">
                        <div
                            class="capitalize text-footer text-xl font-semibold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                            Konselor Pendidik Karakter
                        </div>
                        <div class="flex justify-center w-full text-center group">
                            <a href="#"
                                class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                                daftar
                            </a>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
@endsection
