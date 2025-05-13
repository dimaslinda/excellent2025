@extends('layouts.main')
@section('kepala')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection
@section('banner')
    {{-- banner --}}
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-ekskul.webp')] bg-no-repeat bg-cover">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    ekskul
                </div>
            </h1>
        </div>
    </section>
    {{-- end banner --}}
@endsection
@section('konten')
    <section>
        <div class="container mx-auto p-6">
            @forelse ($ekskul as $item)
                <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                    <div class="md:flex-1 mb-12 xl:mb-0 xl:pr-10">
                        <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                            {{ $item->name }}
                        </h2>
                        <div class="font-poppins text-cardhitam text-justify">
                            {!! $item->deskripsi !!}
                        </div>
                        <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                            <a href="https://wa.me/+6285213298462" target="_blank"
                                class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                                daftarkan sekolahmu
                            </a>
                        </div>
                    </div>
                    <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                        <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                            <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                        </div>
                        <img src="{{ $item->getFirstMediaUrl('ekskul') }}"
                            class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]"
                            alt="iht">
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center min-h-[400px]">
                    <div class="font-poppins font-bold text-2xl text-footer mt-5 text-center">Tidak ada data ekskul</div>
                </div>
            @endforelse

        </div>
    </section>

    {{-- testimoni --}}
    <section class="bg-[url('../../public/img/general/bg-testi.webp')] bg-no-repeat bg-cover bg-center min-h-screen">
        <div class="container mx-auto p-6">
            <div
                class="mb-10 text-3xl font-poppins font-bold leading-normal uppercase md:text-4xl md:leading-normal text-footer">
                yang <span class="px-2 text-white bg-headerbanner font-poppins">mereka katakan</span> <br> tentang
                kami
            </div>

            <!-- Swiper -->
            <div class="swiper mySwiper3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-2">
                            <div
                                class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                                <div class="rounded-full w-40 h-40 mb-5">
                                    <img src="{{ asset('img/general/riska.webp') }}"
                                        class="rounded-full w-40 h-40 object-cover" alt="testimoni">
                                </div>
                                <div class="font-poppins text-center">
                                    <div class="font-bold text-3xl text-footer">
                                        Riska Tania, SE.M.A.B.
                                    </div>
                                    <div class="text-lg text-cardhitam mb-5">
                                        Kepala Bidang Pendidikan Dasar Disdikporapar Kab. Mempawah
                                    </div>
                                    <div class="text-justify italic text-cardhitam">
                                        Terima kasih kepada Excellent Team atas pelatihan dan workshop yang membuka
                                        wawasan guru-guru Kabupaten Mempawah tentang pemanfaatan AI, sehingga
                                        membantu meringankan tugas administrasi dan meningkatkan kreativitas dalam
                                        mengajar.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                <img src="{{ asset('img/general/testimoni.webp') }}" class="object-cover w-full h-full"
                                    alt="testimoni">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-2">
                            <div
                                class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                                <div class="rounded-full w-40 h-40 mb-5">
                                    <img src="{{ asset('img/general/juhairiyah.webp') }}"
                                        class="rounded-full w-40 h-40 object-cover" alt="testimoni">
                                </div>
                                <div class="font-poppins text-center">
                                    <div class="font-bold text-3xl text-footer">
                                        Juhairiyah, S. Pd, M. Pd
                                    </div>
                                    <div class="text-lg text-cardhitam mb-5">
                                        Kepala UPT SDN Poris Pelawad 2
                                    </div>
                                    <div class="text-justify italic text-cardhitam">
                                        Bekerjasama dengan Excellent Team dalam pelatihan guru sangat luar biasa.
                                        Materi pelatihan berbasis teknologi disampaikan secara profesional dan
                                        benar-benar membantu guru dalam menyiapkan perangkat ajar dan media
                                        pembelajaran.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                <img src="{{ asset('img/general/testimoni.webp') }}" class="object-cover w-full h-full"
                                    alt="testimoni">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-2">
                            <div
                                class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                                <div class="rounded-full w-40 h-40 mb-5">
                                    <img src="{{ asset('img/general/riska.webp') }}"
                                        class="rounded-full w-40 h-40 object-cover" alt="testimoni">
                                </div>
                                <div class="font-poppins text-center">
                                    <div class="font-bold text-3xl text-footer">
                                        Riska Tania, SE.M.A.B.
                                    </div>
                                    <div class="text-lg text-cardhitam mb-5">
                                        Kepala Bidang Pendidikan Dasar Disdikporapar Kab. Mempawah
                                    </div>
                                    <div class="text-justify italic text-cardhitam">
                                        Terima kasih kepada Excellent Team atas pelatihan dan workshop yang membuka
                                        wawasan guru-guru Kabupaten Mempawah tentang pemanfaatan AI, sehingga
                                        membantu meringankan tugas administrasi dan meningkatkan kreativitas dalam
                                        mengajar.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                <img src="{{ asset('img/general/testimoni.webp') }}" class="object-cover w-full h-full"
                                    alt="testimoni">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-2">
                            <div
                                class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                                <div class="rounded-full w-40 h-40 mb-5">
                                    <img src="{{ asset('img/general/juhairiyah.webp') }}"
                                        class="rounded-full w-40 h-40 object-cover" alt="testimoni">
                                </div>
                                <div class="font-poppins text-center">
                                    <div class="font-bold text-3xl text-footer">
                                        Juhairiyah, S. Pd, M. Pd
                                    </div>
                                    <div class="text-lg text-cardhitam mb-5">
                                        Kepala UPT SDN Poris Pelawad 2
                                    </div>
                                    <div class="text-justify italic text-cardhitam">
                                        Bekerjasama dengan Excellent Team dalam pelatihan guru sangat luar biasa.
                                        Materi pelatihan berbasis teknologi disampaikan secara profesional dan
                                        benar-benar membantu guru dalam menyiapkan perangkat ajar dan media
                                        pembelajaran.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                <img src="{{ asset('img/general/testimoni.webp') }}" class="object-cover w-full h-full"
                                    alt="testimoni">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="paginat2 hidden md:flex"></div>
                <div class="button-next3 justify-center items-center self-center p-2 hidden md:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                        <path
                            d="M1.18311 1.44897L5.01445 5.28032C5.29714 5.56301 5.29714 6.02134 5.01445 6.30402L1.18311 10.1354"
                            stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="button-prev3 justify-center items-center self-center p-2 hidden md:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                        <path
                            d="M5.77881 10.1355L1.94746 6.30415C1.66478 6.02146 1.66478 5.56314 1.94746 5.28045L5.77881 1.4491"
                            stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
    {{-- end testimoni --}}
@endsection
@section('kaki')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper3", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
            navigation: {
                nextEl: ".button-next3",
                prevEl: ".button-prev3",
            },
            pagination: {
                el: ".paginat2",
            },
        });
    </script>
@endsection
