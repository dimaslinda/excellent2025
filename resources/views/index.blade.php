<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excellent Team</title>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="relative">
        {{-- navbar --}}
        <nav class="bg-transparent top-0 fixed w-full z-20">
            <div
                class="flex flex-wrap justify-between items-center p-4 mx-auto max-w-screen-xl bg-bgnavbar backdrop-blur-md rounded-lg md:rounded-full border-2 border-navbar shadow-xl drop-shadow-xl md:px-8 md:mt-5">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('img/general/logo.webp') }}" class="h-8 xl:h-10" alt="logo ET" />
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" type="button"
                        class="text-white font-poppins cursor-pointer capitalize bg-tombol hover:bg-tombol focus:ring-4 focus:outline-none focus:ring-navbar font-medium rounded-full text-sm px-9 py-2 text-center">
                        daftar
                    </button>

                    <button data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-tombol rounded-lg md:hidden hover:bg-tombol focus:outline-none focus:ring-2 focus:ring-tombol"
                        aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul
                        class="flex flex-col font-poppins text-base xl:text-xl capitalize p-4 md:p-0 mt-4 font-medium border border-navbar rounded-lg bg-cardhitam md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                        <li>
                            <a href="#karir"
                                class="block py-2 px-3 text-white bg-tombol rounded-sm md:bg-transparent md:text-cardhitam capitalize"
                                aria-current="page">
                                beranda
                            </a>
                        </li>
                        <li>
                            <a href="#mentor"
                                class="block py-2 px-3 text-white md:text-cardhitam capitalize rounded-sm hover:bg-tombol hover:text-white md:hover:bg-transparent md:hover:text-tombol">
                                layanan kami
                            </a>
                        </li>
                        <li>
                            <a href="#modul"
                                class="block py-2 px-3 text-white md:text-cardhitam capitalize rounded-sm hover:bg-tombol hover:text-white md:hover:bg-transparent md:hover:text-tombol">
                                gallery
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-3 text-white md:text-cardhitam capitalize rounded-sm hover:bg-tombol hover:text-white md:hover:bg-transparent md:hover:text-tombol">
                                artikel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- end navbar --}}
        {{-- banner --}}
        <section
            class="pt-20 md:pt-52 relative z-10 bg-[url('../../public/img/general/bg-banner.webp')] bg-no-repeat bg-cover bg-right-top">
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
                <h1 class="md:mb-23 lg:mb-52 font-bold leading-none text-logo tracking-wide">
                    <div data-aos="fade-up" class="text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">
                        SDM Berkualitas Mewujudkan
                    </div>
                    <div data-aos="fade-down" class="text-headerbanner text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl">
                        Indonesia Emas 2045
                    </div>
                </h1>
            </div>
        </section>
        {{-- end banner --}}
    </header>

    <main>
        {{-- about --}}
        <section>
            <div class="container mx-auto p-6">
                <div class="flex flex-col-reverse lg:flex-row">
                    <div class="flex-1 mx-auto md:p-10">
                        <h2 class="text-4xl mb-10 font-poppins font-bold uppercase">
                            excellent team
                        </h2>
                        <div class="mb-10 text-lg md:text-2xl font-poppins text-justify text-cardhitam">
                            Setiap anak bangsa memiliki potensi besar yang perlu dikembangkan. Namun, di tengah dinamika
                            pendidikan, pendidik sering menghadapi tantangan seperti tekanan kurikulum, tuntutan
                            teknologi, dan kebutuhan membangun hubungan bermakna dengan siswa.
                        </div>
                        <div class="mb-10 text-lg md:text-2xl font-poppins text-justify text-cardhitam">
                            Excellent Team hadir sebagai mitra terbaik bagi pendidik, siswa, dan individu yang ingin
                            mengembangkan keterampilan. Dengan pendekatan kreatif dan inovatif, kami menawarkan
                            <span class="font-bold">Training, Mentoring, Coaching, Consulting,</span> dan
                            <span class="font-bold">Bootcamp</span> untuk
                            membangun karakter, mengenali
                            bakat, dan memperkuat kompetensi.
                        </div>
                    </div>
                    <div class="flex-1 flex justify-center">
                        <img src="{{ asset('img/general/profile-about.webp') }}" class="w-full h-full object-contain"
                            alt="profile about">
                    </div>
                </div>
            </div>
        </section>
        {{-- end about --}}

        {{-- section layanan kami --}}
        <section class="p-6 md:p-10">
            <div class="container mx-auto p-6 md:p-10 bg-headerbanner rounded-xl max-w-5xl relative">
                <div>
                    <h2
                        class="text-2xl text-center md:text-left md:text-4xl mb-10 font-poppins font-bold uppercase text-white">
                        layanan kami
                    </h2>
                </div>
                <div class="hidden md:block absolute top-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[400px] lg:w-[517px]" viewBox="0 0 517 129"
                        fill="none">
                        <path
                            d="M0 0H517V129V107.105C517 89.0345 502.467 74.3249 484.398 74.1072L156.8 70.1602C148.267 70.0574 140.105 66.6532 134.029 60.6621L82.1363 9.50057C75.9616 3.41283 67.6389 0 58.9678 0H0Z"
                            fill="white" />
                    </svg>
                </div>
                <div class="grid grid-cols-2 xl:grid-cols-3 gap-5">
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/iht.webp') }}" class="rounded-lg w-full h-full object-cover"
                                alt="iht">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            in house training
                        </div>
                    </div>
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/bootcamp.webp') }}"
                                class="rounded-lg w-full h-full object-cover" alt="bootcamp">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            bootcamp
                        </div>
                    </div>
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/e-course.webp') }}"
                                class="rounded-lg w-full h-full object-cover" alt="e-course">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            e-course
                        </div>
                    </div>
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/modul.webp') }}"
                                class="rounded-lg w-full h-full object-cover" alt="modul">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            modul
                        </div>
                    </div>
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/ekstrakulikuler.webp') }}"
                                class="rounded-lg w-full h-full object-cover" alt="ekstrakulikuler">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            ekstrakulikuler
                        </div>
                    </div>
                    <div class="grayscale group hover:grayscale-0 cursor-pointer transition duration-300">
                        <div class="bg-white rounded-lg h-24 md:h-52 group-hover:scale-105 transition duration-300">
                            <img src="{{ asset('img/general/webinar.webp') }}"
                                class="rounded-lg w-full h-full object-cover" alt="webinar">
                        </div>
                        <div class="font-poppins capitalize text-white text-center mt-3">
                            webinar
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end section layanan kami --}}

        {{-- section portofolio --}}
        <section class="bg-[url('../../public/img/general/bg-portofolio.webp')] bg-no-repeat bg-cover h-auto">
            <div class="container mx-auto p-6">
                <div class="text-center text-2xl md:text-4xl font-poppins font-bold uppercase">
                    Portofolio
                </div>
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="flex flex-col lg:flex-row mt-10">
                                <div class="flex-1 flex justify-center w-full lg:justify-end py-6">
                                    <div class="flex flex-col items-center self-center rounded-xl max-w-xl">
                                        <img src="{{ asset('img/general/portofolio.png') }}"
                                            class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                    </div>
                                </div>
                                <div class="flex-1 flex justify-center w-full py-6">
                                    <div
                                        class="flex flex-col justify-center items-center lg:items-start lg:justify-start gap-6 w-full">
                                        <div
                                            class="flex flex-row justify-center lg:justify-start w-full gap-6 max-w-xl">
                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>

                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>
                                        </div>

                                        <div
                                            class="bg-white rounded-lg font-poppins p-4 md:p-10 min-h-52 max-w-xl flex flex-col justify-between shadow-2xl drop-shadow-2xl">
                                            <div class="text-cardhitam font-bold text-3xl md:text-4xl">
                                                Pembelajaran Paradigma Baru dengan AI
                                            </div>
                                            <div class="text-lg">
                                                Sukasari 7 - Tangerang
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="flex flex-col lg:flex-row mt-10">
                                <div class="flex-1 flex justify-center w-full lg:justify-end py-6">
                                    <div class="flex flex-col items-center self-center rounded-xl max-w-xl">
                                        <img src="{{ asset('img/general/portofolio.png') }}"
                                            class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                    </div>
                                </div>
                                <div class="flex-1 flex justify-center w-full py-6">
                                    <div
                                        class="flex flex-col justify-center items-center lg:items-start lg:justify-start gap-6 w-full">
                                        <div
                                            class="flex flex-row justify-center lg:justify-start w-full gap-6 max-w-xl">
                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>

                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>
                                        </div>

                                        <div
                                            class="bg-white rounded-lg font-poppins p-4 md:p-10 min-h-52 max-w-xl flex flex-col justify-between shadow-2xl drop-shadow-2xl">
                                            <div class="text-cardhitam font-bold text-3xl md:text-4xl">
                                                Pembelajaran Paradigma Baru dengan AI
                                            </div>
                                            <div class="text-lg">
                                                Sukasari 7 - Tangerang
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="flex flex-col lg:flex-row mt-10">
                                <div class="flex-1 flex justify-center w-full lg:justify-end py-6">
                                    <div class="flex flex-col items-center self-center rounded-xl max-w-xl">
                                        <img src="{{ asset('img/general/portofolio.png') }}"
                                            class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                    </div>
                                </div>
                                <div class="flex-1 flex justify-center w-full py-6">
                                    <div
                                        class="flex flex-col justify-center items-center lg:items-start lg:justify-start gap-6 w-full">
                                        <div
                                            class="flex flex-row justify-center lg:justify-start w-full gap-6 max-w-xl">
                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>

                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>
                                        </div>

                                        <div
                                            class="bg-white rounded-lg font-poppins p-4 md:p-10 min-h-52 max-w-xl flex flex-col justify-between shadow-2xl drop-shadow-2xl">
                                            <div class="text-cardhitam font-bold text-3xl md:text-4xl">
                                                Pembelajaran Paradigma Baru dengan AI
                                            </div>
                                            <div class="text-lg">
                                                Sukasari 7 - Tangerang
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="flex flex-col lg:flex-row mt-10">
                                <div class="flex-1 flex justify-center w-full lg:justify-end py-6">
                                    <div class="flex flex-col items-center self-center rounded-xl max-w-xl">
                                        <img src="{{ asset('img/general/portofolio.png') }}"
                                            class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                    </div>
                                </div>
                                <div class="flex-1 flex justify-center w-full py-6">
                                    <div
                                        class="flex flex-col justify-center items-center lg:items-start lg:justify-start gap-6 w-full">
                                        <div
                                            class="flex flex-row justify-center lg:justify-start w-full gap-6 max-w-xl">
                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>

                                            <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                <img src="{{ asset('img/general/portofolio.png') }}"
                                                    class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                            </div>
                                        </div>

                                        <div
                                            class="bg-white rounded-lg font-poppins p-4 md:p-10 min-h-52 max-w-xl flex flex-col justify-between shadow-2xl drop-shadow-2xl">
                                            <div class="text-cardhitam font-bold text-3xl md:text-4xl">
                                                Pembelajaran Paradigma Baru dengan AI
                                            </div>
                                            <div class="text-lg">
                                                Sukasari 7 - Tangerang
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="paginat hidden md:flex"></div>
                    <div class="button-next justify-center items-center self-center p-2 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                            <path
                                d="M1.18311 1.44897L5.01445 5.28032C5.29714 5.56301 5.29714 6.02134 5.01445 6.30402L1.18311 10.1354"
                                stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="button-prev justify-center items-center self-center p-2 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                            <path
                                d="M5.77881 10.1355L1.94746 6.30415C1.66478 6.02146 1.66478 5.56314 1.94746 5.28045L5.77881 1.4491"
                                stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
        </section>
        {{-- end section portofolio --}}

        {{-- section kunjungi --}}
        <section class="h-auto">
            <div class="container mx-auto p-6">
                <div class="text-center text-2xl md:text-4xl font-poppins text-footer font-bold uppercase">
                    kunjungi channel kami
                </div>
                <div class="text-center font-poppins mt-5 text-cardhitam">
                    Dengan bangga mempersembahkan berbagai kegiatan Excellent Team <br>
                    dalam berbagai In House Training dan Event kami.

                </div>
                <!-- Swiper -->
                <div class="swiper mySwiper2 mt-20">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="max-h-[500px] flex justify-center items-center self-center">
                                <iframe src="https://www.youtube.com/embed/RJTqA4uKV1I?enablejsapi=1"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                    class="md:w-[700px] md:h-[430px] rounded-xl"></iframe>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="max-h-[500px] flex justify-center items-center self-center">
                                <iframe src="https://www.youtube.com/embed/lkBHk5UvbC8?enablejsapi=1"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                    class="md:w-[700px] md:h-[430px] rounded-xl"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="button-next2 justify-center items-center self-center p-2 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                            <path
                                d="M1.18311 1.44897L5.01445 5.28032C5.29714 5.56301 5.29714 6.02134 5.01445 6.30402L1.18311 10.1354"
                                stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="button-prev2 justify-center items-center self-center p-2 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 7 12" fill="none">
                            <path
                                d="M5.77881 10.1355L1.94746 6.30415C1.66478 6.02146 1.66478 5.56314 1.94746 5.28045L5.77881 1.4491"
                                stroke="white" stroke-width="2.1716" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
        </section>
        {{-- end kunjungi --}}

        {{-- artikel --}}
        <section id="artikel" class="py-5 font-poppins">
            <div class="container p-6 mx-auto">
                <div class="mb-10 text-4xl font-bold uppercase text-headerbanner">
                    baca artikel kami
                </div>
                <div class="flex flex-col gap-5 lg:flex-row">
                    <div class="flex-1">
                        @forelse ($responselates as $article)
                            <div>
                                <img src="{{ $article->featured_media_src_url }}" class="w-full mb-5 rounded-3xl"
                                    alt="artikel">
                            </div>
                            <div class="text-xl text-justify">
                                {!! $article->yoast_head_json->description !!}
                            </div>
                            <div class="mt-5">
                                <a href="{{ $article->link }}" target="_blank"
                                    class="text-xl font-bold uppercase text-headerbanner">
                                    Baca Lebih Banyak
                                </a>
                            </div>
                        @empty
                            <p class="text-center">Tidak ada artikel terbaru yang tersedia saat ini.</p>
                        @endforelse
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            @forelse ($responselimit as $article)
                                <div class="max-w-screen-sm bg-white shadow-2xl rounded-3xl drop-shadow-2xl">
                                    <img src="{{ $article->featured_media_src_url }}"
                                        class="w-full rounded-tr-3xl rounded-tl-3xl" alt="artikel">
                                    <div class="p-6">
                                        <div class="text-gray-500">
                                            {{ date('M d, Y', strtotime($article->date)) }}
                                        </div>
                                        <div class="line-clamp-2">
                                            {{ $article->title->rendered }}
                                        </div>
                                        <div class="mt-5">
                                            <a href="{{ $article->link }}" target="_blank"
                                                class="font-bold uppercase text-headerbanner">
                                                Baca Lebih Banyak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Tidak ada artikel yang tersedia saat ini.</p>
                            @endforelse

                        </div>
                    </div>
                </div>
                <div>
                    <a href="https://excellentteam.id/artikel/" target="_blank"
                        class="flex items-center my-10 text-3xl font-bold uppercase lg:justify-end md:gap-2 md:text-right text-headerbanner">
                        <div>
                            Tampilkan Selengkapnya
                        </div>
                        <div>
                            <svg class="hidden w-20 h-20 md:block" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>

                        </div>
                    </a>
                </div>
            </div>
        </section>
        {{-- end artikel --}}

        {{-- testimoni --}}
        <section
            class="bg-[url('../../public/img/general/bg-testi.webp')] bg-no-repeat bg-cover bg-center min-h-screen">
            <div class="container mx-auto p-6">
                <div
                    class="mb-10 text-3xl font-poppins font-bold leading-normal uppercase md:text-4xl md:leading-normal text-footer">
                    yang <span class="px-2 text-white bg-headerbanner font-poppins">mereka katakan</span> <br> tentang
                    kami
                </div>

                <div class="flex flex-row gap-2">
                    <div
                        class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                        <div class="bg-red-500 rounded-full w-40 h-40 mb-5">
                            <img src="" alt="">
                        </div>
                        <div class="font-poppins text-center">
                            <div class="font-bold text-3xl text-footer">
                                Ibu Yuniar
                            </div>
                            <div class="text-lg text-cardhitam mb-5">
                                Korwil Periuk Kota Tangerang
                            </div>
                            <div class="text-justify italic text-cardhitam">
                                Sebagai seorang Pengawas SD, saya sangat senang melihat dampak positif dari pelatihan
                                IHT Assemen Diagnostik terutama AI dan penilaian diagnosis pada guru guru kami.
                                Pelatihan ini tidak hanya memberikan mereka pengetahuan tentang teknologi terbaru,
                                tetapi juga membuka pikiran mereka terhadap berbagai aplikasi yang dapat bermanfaat
                                dalam pekerjaan sehari hari terutama mempermudah dalam pembuatan soal dan mencari materi
                                ajar.
                            </div>
                        </div>
                    </div>
                    <div class="w-[65%] bg-headerbanner rounded-xl shadow-2xl drop-shadow-2xl min-h-52">

                    </div>
                </div>
            </div>
        </section>
        {{-- end testimoni --}}
    </main>

    <footer class="bg-footer">
        <div class="w-full max-w-screen-xl p-4 py-6 mx-auto lg:py-8">
            <div class="flex flex-col justify-center md:flex-row">
                <div class="flex-col flex-1 mb-6">
                    <a href="/" class="flex items-center justify-center">
                        <img src="{{ asset('img/general/logo-foot.png') }}" class="h-20 me-3" alt="FlowBite Logo" />
                    </a>
                    <div class="flex items-center justify-center gap-8 mt-6 sm:gap-6">
                        <a href="https://www.instagram.com/excellentteam.official/" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54"
                                viewBox="0 0 54 54" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1 27.3659C1 41.5231 12.4767 52.9998 26.6339 52.9998C40.7912 52.9998 52.2679 41.5231 52.2679 27.3659C52.2679 13.2086 40.7912 1.73193 26.6339 1.73193C12.4767 1.73193 1 13.2086 1 27.3659ZM26.6339 0.731934C11.9244 0.731934 0 12.6564 0 27.3659C0 42.0754 11.9244 53.9998 26.6339 53.9998C41.3434 53.9998 53.2679 42.0754 53.2679 27.3659C53.2679 12.6564 41.3434 0.731934 26.6339 0.731934Z"
                                    fill="white" />
                                <path
                                    d="M23.074 27.6318C23.074 25.5184 24.7868 23.8047 26.9003 23.8047C29.0137 23.8047 30.7275 25.5184 30.7275 27.6318C30.7275 29.7451 29.0137 31.4588 26.9003 31.4588C24.7868 31.4588 23.074 29.7451 23.074 27.6318ZM21.0051 27.6318C21.0051 30.8875 23.6444 33.5267 26.9003 33.5267C30.1562 33.5267 32.7954 30.8875 32.7954 27.6318C32.7954 24.376 30.1562 21.7368 26.9003 21.7368C23.6444 21.7368 21.0051 24.376 21.0051 27.6318ZM31.6511 21.5031C31.6508 22.2639 32.2674 22.881 33.0283 22.8813C33.7891 22.8816 34.4062 22.265 34.4065 21.5042C34.4068 20.7433 33.7902 20.1263 33.0294 20.126C32.2689 20.1264 31.6518 20.7426 31.6511 21.5031ZM22.2621 36.9763C21.1428 36.9254 20.5344 36.7389 20.1301 36.5814C19.5941 36.3728 19.2117 36.1242 18.8096 35.7227C18.4075 35.3212 18.1586 34.9391 17.9508 34.4031C17.7932 33.999 17.6067 33.3905 17.5559 32.2712C17.5002 31.0611 17.4891 30.6976 17.4891 27.6318C17.4891 24.5661 17.5011 24.2036 17.5559 22.9925C17.6068 21.8732 17.7947 21.2659 17.9508 20.8606C18.1595 20.3246 18.408 19.9421 18.8096 19.5401C19.2111 19.138 19.5932 18.8891 20.1301 18.6813C20.5342 18.5237 21.1428 18.3373 22.2621 18.2864C23.4723 18.2308 23.8358 18.2197 26.9003 18.2197C29.9648 18.2197 30.3287 18.2317 31.5398 18.2864C32.6591 18.3374 33.2665 18.5252 33.6718 18.6813C34.2078 18.8891 34.5903 19.1385 34.9924 19.5401C35.3945 19.9416 35.6425 20.3246 35.8511 20.8606C36.0087 21.2647 36.1952 21.8732 36.2461 22.9925C36.3017 24.2036 36.3128 24.5661 36.3128 27.6318C36.3128 30.6976 36.3017 31.0601 36.2461 32.2712C36.1951 33.3905 36.0077 33.9988 35.8511 34.4031C35.6425 34.9391 35.3939 35.3215 34.9924 35.7227C34.5908 36.1239 34.2078 36.3728 33.6718 36.5814C33.2677 36.739 32.6591 36.9255 31.5398 36.9763C30.3297 37.032 29.9662 37.0431 26.9003 37.0431C23.8344 37.0431 23.4719 37.032 22.2621 36.9763ZM22.167 16.2211C20.9449 16.2768 20.1097 16.4705 19.3804 16.7543C18.625 17.0474 17.9856 17.4406 17.3466 18.0785C16.7077 18.7164 16.3155 19.3568 16.0224 20.1121C15.7386 20.8419 15.5448 21.6766 15.4892 22.8987C15.4326 24.1228 15.4196 24.5141 15.4196 27.6318C15.4196 30.7494 15.4326 31.1407 15.4892 32.3648C15.5448 33.587 15.7386 34.4216 16.0224 35.1514C16.3155 35.9062 16.7078 36.5473 17.3466 37.185C17.9855 37.8227 18.625 38.2153 19.3804 38.5092C20.1111 38.793 20.9449 38.9867 22.167 39.0424C23.3918 39.0981 23.7825 39.1119 26.9003 39.1119C30.0181 39.1119 30.4094 39.099 31.6335 39.0424C32.8558 38.9867 33.6904 38.793 34.4202 38.5092C35.1751 38.2153 35.8149 37.8229 36.4539 37.185C37.0929 36.5471 37.4842 35.9062 37.7781 35.1514C38.0619 34.4216 38.2566 33.5869 38.3114 32.3648C38.367 31.1398 38.38 30.7494 38.38 27.6318C38.38 24.5141 38.367 24.1228 38.3114 22.8987C38.2557 21.6765 38.0619 20.8415 37.7781 20.1121C37.4842 19.3573 37.0919 18.7174 36.4539 18.0785C35.816 17.4396 35.1751 17.0474 34.4211 16.7543C33.6904 16.4705 32.8557 16.2758 31.6344 16.2211C30.4103 16.1654 30.019 16.1516 26.9012 16.1516C23.7834 16.1516 23.3918 16.1645 22.167 16.2211Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100074736474622" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54"
                                viewBox="0 0 54 54" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.28571 27.3659C1.28571 41.5231 12.7624 52.9998 26.9196 52.9998C41.0769 52.9998 52.5536 41.5231 52.5536 27.3659C52.5536 13.2086 41.0769 1.73193 26.9196 1.73193C12.7624 1.73193 1.28571 13.2086 1.28571 27.3659ZM26.9196 0.731934C12.2101 0.731934 0.285706 12.6564 0.285706 27.3659C0.285706 42.0754 12.2101 53.9998 26.9196 53.9998C41.6291 53.9998 53.5536 42.0754 53.5536 27.3659C53.5536 12.6564 41.6291 0.731934 26.9196 0.731934Z"
                                    fill="white" />
                                <path
                                    d="M28.414 20.4369H32.0709V16.2775H28.414C25.5893 16.2775 23.2953 18.4558 23.2953 21.1268V23.2065H20.3718V27.3659H23.2953V38.4542H27.6857V27.3659H31.3427L32.0761 23.2065H27.6857V21.1268C27.6805 20.7523 28.0186 20.4369 28.414 20.4369Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@excellentteam.official?is_from_webapp=1&sender_device=pc"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="54"
                                viewBox="0 0 55 54" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.97321 27.3659C1.97321 41.5231 13.4499 52.9998 27.6071 52.9998C41.7644 52.9998 53.2411 41.5231 53.2411 27.3659C53.2411 13.2086 41.7644 1.73193 27.6071 1.73193C13.4499 1.73193 1.97321 13.2086 1.97321 27.3659ZM27.6071 0.731934C12.8976 0.731934 0.973206 12.6564 0.973206 27.3659C0.973206 42.0754 12.8976 53.9998 27.6071 53.9998C42.3166 53.9998 54.2411 42.0754 54.2411 27.3659C54.2411 12.6564 42.3166 0.731934 27.6071 0.731934Z"
                                    fill="white" />
                                <path
                                    d="M33.3667 19.79C32.5692 18.8796 32.1297 17.7103 32.13 16.5H28.525V30.9667C28.4972 31.7495 28.1667 32.4911 27.6031 33.0351C27.0394 33.5791 26.2867 33.8832 25.5033 33.8833C23.8467 33.8833 22.47 32.53 22.47 30.85C22.47 28.8433 24.4067 27.3383 26.4017 27.9567V24.27C22.3767 23.7333 18.8533 26.86 18.8533 30.85C18.8533 34.735 22.0733 37.5 25.4917 37.5C29.155 37.5 32.13 34.525 32.13 30.85V23.5117C33.5918 24.5615 35.3469 25.1248 37.1467 25.1217V21.5167C37.1467 21.5167 34.9533 21.6217 33.3667 19.79Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    <div>
                        <ul class="font-medium text-white">
                            <li class="mb-4 text-sm md:text-base">
                                <div class="flex items-center self-center gap-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path
                                            d="M4.33333 4.3335H21.6667C22.8583 4.3335 23.8333 5.3085 23.8333 6.50016V19.5002C23.8333 20.6918 22.8583 21.6668 21.6667 21.6668H4.33333C3.14167 21.6668 2.16667 20.6918 2.16667 19.5002V6.50016C2.16667 5.3085 3.14167 4.3335 4.33333 4.3335Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M23.8333 6.5L13 14.0833L2.16667 6.5" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg> excellentteam.official@gmail.com
                                </div>
                            </li>
                            <li class="mb-4 text-sm md:text-base">
                                <div class="flex items-center self-center gap-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M22 16.9201V19.9201C22.0011 20.1986 21.9441 20.4743 21.8325 20.7294C21.7209 20.9846 21.5573 21.2137 21.3521 21.402C21.1469 21.5902 20.9046 21.7336 20.6407 21.8228C20.3769 21.912 20.0974 21.9452 19.82 21.9201C16.7428 21.5857 13.787 20.5342 11.19 18.8501C8.77383 17.3148 6.72534 15.2663 5.19 12.8501C3.49998 10.2413 2.44824 7.27109 2.12 4.1801C2.09501 3.90356 2.12787 3.62486 2.2165 3.36172C2.30513 3.09859 2.44757 2.85679 2.63477 2.65172C2.82196 2.44665 3.0498 2.28281 3.30379 2.17062C3.55778 2.05843 3.83234 2.00036 4.11 2.0001H7.11C7.59531 1.99532 8.06579 2.16718 8.43376 2.48363C8.80173 2.80008 9.04208 3.23954 9.11 3.7201C9.23662 4.68016 9.47145 5.62282 9.81 6.5301C9.94454 6.88802 9.97366 7.27701 9.89391 7.65098C9.81415 8.02494 9.62886 8.36821 9.36 8.6401L8.09 9.9101C9.51356 12.4136 11.5865 14.4865 14.09 15.9101L15.36 14.6401C15.6319 14.3712 15.9752 14.1859 16.3491 14.1062C16.7231 14.0264 17.1121 14.0556 17.47 14.1901C18.3773 14.5286 19.3199 14.7635 20.28 14.8901C20.7658 14.9586 21.2094 15.2033 21.5265 15.5776C21.8437 15.9519 22.0122 16.4297 22 16.9201Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg> 0852-1329-8462
                                </div>
                            </li>
                            <li class="text-sm md:text-base">
                                <div class="flex items-center self-center gap-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Perum Palem Ganda Asri, <br> Jl. Tupai Raya PGA No.1, Meruyung, <br
                                        class="hidden sm:block"> Kec. Limo,
                                    Kota
                                    Depok, Jawa Barat 16512
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
            navigation: {
                nextEl: ".button-next",
                prevEl: ".button-prev",
            },
            pagination: {
                el: ".paginat",
            },
        });

        var swiper = new Swiper(".mySwiper2", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
            navigation: {
                nextEl: ".button-next2",
                prevEl: ".button-prev2",
            },
        });
    </script>
</body>

</html>
