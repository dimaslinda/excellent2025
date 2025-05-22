@extends('layouts.main')
@section('kepala')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @php
        use Spatie\MediaLibrary\MediaCollections\Models\Media;
    @endphp
@endsection
@section('banner')
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
@endsection
@section('konten')
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
                    <x-card-layanan src="img/general/iht.webp" alt="iht" title="In House Training" href="inhouse" />
                    <x-card-layanan src="img/general/bootcamp.webp" alt="bootcamp" title="Bootcamp" href="bootcamp" />
                    <x-card-layanan src="img/general/e-course.webp" alt="e-course" title="E-Course" href="ecourse" />
                    <x-card-layanan src="img/general/modul.webp" alt="modul" title="Modul" href="modul" />
                    <x-card-layanan src="img/general/ekstrakulikuler.webp" alt="ekstrakulikuler" title="Ekstrakulikuler"
                        href="eskul" />
                    <x-card-layanan src="img/general/webinar.webp" alt="webinar" title="Webinar" href="wwebinar" />

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
                        @forelse ($gallery as $item)
                            <div class="swiper-slide">
                                <div class="flex flex-col lg:flex-row mt-10 gap-5">
                                    <div class="flex-1 flex justify-center w-full lg:justify-end py-6">
                                        <div
                                            class="flex flex-col items-center self-center rounded-xl max-w-xl md:h-[550px]">
                                            <img src="{{ $item->getFirstMediaUrl('gallerythumb') }}"
                                                class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                        </div>
                                    </div>
                                    <div class="flex-1 flex justify-center w-full py-6">
                                        <div
                                            class="flex flex-col justify-center items-center lg:items-start lg:justify-start gap-6 w-full">
                                            <div
                                                class="flex flex-row justify-center lg:justify-start w-full gap-6 max-w-xl">
                                                @php
                                                    $collection = Media::all()
                                                        ->where('model_id', $item->id)
                                                        ->where('collection_name', 'another_portofolio')
                                                        ->take(2);
                                                @endphp
                                                @foreach ($collection as $thumb)
                                                    <div class="flex flex-col items-center self-center rounded-xl md:h-70">
                                                        <img src="{{ $thumb->original_url }}"
                                                            class="w-full h-full object-cover rounded-xl" alt="portofolio">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div
                                                class="bg-white rounded-lg font-poppins p-4 md:p-10 min-h-52 max-w-xl flex flex-col justify-between shadow-2xl drop-shadow-2xl">
                                                <div class="text-cardhitam font-bold text-3xl md:text-4xl line-clamp-2">
                                                    {{ $item->name }}
                                                </div>
                                                <div class="text-lg">
                                                    {{ $item->sekolah }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center min-h-[400px]">
                                <div class="font-poppins font-bold text-xl text-cardhitam mt-5 text-center">
                                    Belum ada data portofolio
                                </div>
                            </div>
                        @endforelse
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
                        @foreach (['RJTqA4uKV1I', 'lkBHk5UvbC8'] as $videoId)
                            <div class="swiper-slide">
                                <div class="max-h-[500px] flex justify-center items-center self-center youtube-facade"
                                    data-video-id="{{ $videoId }}">
                                    <div class="relative w-full md:w-[700px] h-full md:h-[430px]">
                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            alt="Video Thumbnail" class="w-full h-full rounded-xl object-cover">
                                        <button
                                            class="play-video cursor-pointer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                            text-white px-4 py-2 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="107" height="75"
                                                viewBox="0 0 107 75" fill="none">
                                                <path
                                                    d="M43.0035 53.4607L70.4058 37.6212L43.0035 21.7817V53.4607ZM104.038 12.1196C104.725 14.6011 105.2 17.9274 105.517 22.1513C105.886 26.3751 106.045 30.0182 106.045 33.1861L106.361 37.6212C106.361 49.184 105.517 57.6846 104.038 63.1228C102.718 67.8747 99.6561 70.937 94.9042 72.2569C92.4227 72.9433 87.8821 73.4185 80.9127 73.7353C74.0489 74.1049 67.7659 74.2633 61.9581 74.2633L53.5631 74.58C31.4406 74.58 17.6602 73.7353 12.222 72.2569C7.47016 70.937 4.40786 67.8747 3.0879 63.1228C2.40152 60.6413 1.92633 57.315 1.60954 53.0911C1.23996 48.8673 1.08156 45.2242 1.08156 42.0563L0.764771 37.6212C0.764771 26.0584 1.60954 17.5578 3.0879 12.1196C4.40786 7.36774 7.47016 4.30544 12.222 2.98548C14.7035 2.2991 19.2442 1.82392 26.2136 1.50713C33.0774 1.13754 39.3604 0.979143 45.1682 0.979143L53.5631 0.662354C75.6856 0.662354 89.466 1.50713 94.9042 2.98548C99.6561 4.30544 102.718 7.36774 104.038 12.1196Z"
                                                    fill="#FFB43F" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                            <svg class="hidden w-20 h-20 md:block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
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
                        @forelse ($testimoni as $item)
                            <div class="swiper-slide">
                                <div class="flex flex-col lg:flex-row gap-2">
                                    <div
                                        class="w-full lg:w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-6 lg:p-10">
                                        <div class="rounded-full w-40 h-40 mb-5">
                                            <img src="{{ $item->getFirstMediaUrl('testimoni') }}"
                                                class="rounded-full w-40 h-40 object-cover" alt="testimoni">
                                        </div>
                                        <div class="font-poppins text-center">
                                            <div class="font-bold text-3xl text-footer">
                                                {{ $item->name }}
                                            </div>
                                            <div class="text-lg text-cardhitam mb-5">
                                                {{ $item->jabatan }}
                                            </div>
                                            <div
                                                class="text-justify italic text-cardhitam line-clamp-4 lg:line-clamp-none">
                                                {!! $item->testimoni !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                        <img src="{{ asset('img/general/testimoni.webp') }}"
                                            class="object-cover w-full h-full" alt="testimoni">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="flex flex-row gap-2">
                                    <div
                                        class="w-[35%] bg-white rounded-xl shadow-2xl flex flex-col justify-center items-center drop-shadow-2xl min-h-52 p-10">
                                        <div class="rounded-full w-40 h-40 mb-5">
                                            <img src="{{ asset('img/general/default-profile.webp') }}"
                                                class="rounded-full w-40 h-40 object-cover" alt="testimoni default">
                                        </div>
                                        <div class="font-poppins text-center">
                                            <div class="font-bold text-3xl text-footer">
                                                Belum Ada Data
                                            </div>
                                            <div class="text-lg text-cardhitam mb-5">
                                                Testimoni
                                            </div>
                                            <div class="text-justify italic text-cardhitam">
                                                Belum ada data testimoni yang tersedia saat ini
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-[65%] rounded-xl shadow-2xl drop-shadow-2xl relative">
                                        <img src="{{ asset('img/general/testimoni.webp') }}"
                                            class="object-cover w-full h-full" alt="testimoni">
                                    </div>
                                </div>
                            </div>
                        @endforelse
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
    </main>
@endsection
@section('kaki')
    <!-- Swiper JS -->
    <script defer src="https://www.youtube.com/iframe_api"></script>
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
            loop: true,
            navigation: {
                nextEl: ".button-next2",
                prevEl: ".button-prev2",
            },
        });

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

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".youtube-facade").forEach(facade => {
                facade.querySelector(".play-video").addEventListener("click", function() {
                    let videoId = facade.getAttribute("data-video-id");
                    facade.innerHTML = `<iframe width="700" height="430" src="https://www.youtube.com/embed/${videoId}?autoplay=1"
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded-xl"></iframe>`;
                });
            });
        });
    </script>
@endsection
