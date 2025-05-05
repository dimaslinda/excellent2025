@extends('layouts.main')
@section('kepala')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection
@section('banner')
    {{-- banner --}}
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-inhouse.webp')] bg-no-repeat bg-cover">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    in house training
                </div>
            </h1>
        </div>
    </section>
    {{-- end banner --}}
@endsection
@section('konten')
    <section>
        <div class="container mx-auto p-6">
            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 xl:mb-0 xl:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Peningkatan Profesionalisme Guru dalam Literasi Numerasi melalui Pemanfaatan Artificial Intelligence
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pelatihan ini bertujuan meningkatkan profesionalisme guru dalam literasi numerasi melalui
                        pemanfaatan Artificial Intelligence (AI). Peserta akan mempelajari dasar-dasar AI dan aplikasinya
                        dalam pendidikan, khususnya untuk mendukung pembelajaran numerasi yang interaktif dan adaptif. Guru
                        akan dibekali keterampilan praktis dalam merancang materi, memberi umpan balik, dan menganalisis
                        capaian belajar dengan bantuan AI.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-1.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 xl:mb-0 xl:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Pemanfaatan Artificial Intelligence dalam Mewujudkan Pembelajaran Paradigma Baru di Era Digital
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pelatihan ini bertujuan membekali pendidik dan praktisi pendidikan dengan pemahaman serta
                        keterampilan praktis dalam memanfaatkan Artificial Intelligence (AI) untuk mendukung transformasi
                        pembelajaran di era digital. AI menjadi katalis dalam menciptakan pembelajaran yang personal,
                        adaptif, dan efisien. Peserta akan mengeksplorasi berbagai aplikasi AI seperti sistem pembelajaran
                        cerdas, chatbot edukatif, analitik pembelajaran, dan personalisasi materi ajar berbasis data.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-2.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 xl:mb-0 xl:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Konselor Pendidik Karakter
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pelatihan Konselor Pendidik Karakter bertujuan untuk membekali pendidik, konselor sekolah, serta
                        tenaga kependidikan dengan wawasan, keterampilan, dan pendekatan praktis dalam menumbuhkan serta
                        membina karakter peserta didik secara holistik. Di era yang penuh tantangan sosial, emosional, dan
                        moral, pendidikan karakter tidak hanya menjadi pelengkap, tetapi menjadi fondasi utama dalam
                        membentuk generasi yang tangguh, berintegritas, dan berakhlak mulia. Melalui pelatihan ini, peserta
                        akan diperkaya dengan berbagai strategi konseling, pendekatan psikologis, dan nilai-nilai pendidikan
                        karakter yang terintegrasi dalam kegiatan belajar mengajar.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-3.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Media Pembelajaran Interaktif
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pelatihan Media Pembelajaran Interaktif dirancang untuk membantu para pendidik dan tenaga
                        kependidikan mengembangkan media ajar yang kreatif, menarik, dan partisipatif dengan memanfaatkan
                        teknologi digital. Di era pembelajaran modern, media pembelajaran tidak hanya berfungsi sebagai alat
                        bantu, tetapi juga menjadi jembatan untuk meningkatkan keterlibatan dan pemahaman peserta didik.
                        Melalui pelatihan ini, peserta akan dikenalkan pada berbagai platform dan aplikasi yang dapat
                        digunakan untuk menciptakan media pembelajaran yang interaktif, seperti kuis digital, video
                        edukatif, simulasi, dan game edukasi sederhana.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-4.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        STEAM
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Untuk menjawab tantangan pembelajaran abad ke-21, guru dituntut menumbuhkan kreativitas, kolaborasi,
                        dan berpikir kritis siswa. Pelatihan STEAM (Science, Technology, Engineering, Arts, and Mathematics)
                        ini menjadi solusi inovatif bagi pendidik dan pemangku kebijakan dalam menghadirkan pembelajaran
                        yang terintegrasi dan kontekstual. Peserta akan dibekali pemahaman konsep STEAM dan keterampilan
                        praktis merancang pembelajaran lintas disiplin yang aktif, menyenangkan, dan bermakna—menggabungkan
                        sains, teknologi, rekayasa, seni, dan matematika dalam pemecahan masalah nyata.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-5.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Social Emotional Learning
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pendidikan harus mencakup pengembangan sosial dan emosional siswa, bukan hanya aspek kognitif.
                        Pelatihan Social Emotional Learning (SEL) ini dirancang untuk membekali guru, tenaga kependidikan,
                        dan pemangku kebijakan dengan strategi membangun lingkungan belajar yang suportif dan inklusif. SEL
                        membantu siswa mengenali emosi, membangun hubungan sehat, berempati, mengambil keputusan bijak, dan
                        menghadapi tantangan secara positif. Pelatihan ini penting untuk mewujudkan sekolah sebagai ruang
                        aman dan menyenangkan bagi tumbuh kembang siswa.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-6.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]" alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Public Speaking
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Kemampuan public speaking adalah keterampilan penting bagi pendidik, tak hanya di kelas tetapi juga
                        dalam forum sekolah, rapat orang tua, dan acara resmi. Pelatihan ini dirancang untuk membekali guru,
                        kepala sekolah, tenaga kependidikan, dan pengawas agar mampu tampil percaya diri, menyampaikan pesan
                        dengan jelas, serta membangun komunikasi yang hangat dan meyakinkan dalam konteks pendidikan.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-7.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]"
                        alt="iht">
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-12 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Deep Learning
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Pelatihan Deep Learning ini dirancang untuk memberikan pemahaman mendalam serta keterampilan praktis
                        kepada peserta dalam mengembangkan dan menerapkan model deep learning untuk berbagai kebutuhan di
                        era digital. Deep learning merupakan cabang dari machine learning yang berfokus pada pemrosesan data
                        dengan arsitektur jaringan saraf tiruan (neural networks) yang kompleks dan berlapis-lapis.
                        Teknologi ini menjadi tulang punggung di balik kemajuan pesat dalam pengenalan wajah, pemrosesan
                        bahasa alami, kendaraan otonom, sistem rekomendasi, dan berbagai aplikasi cerdas lainnya.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-8.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]"
                        alt="iht">
                    <div class="absolute top-0 left-0 w-full max-h-[400px]">
                        <img src="{{ asset('img/general/comingsoon.webp') }}"
                            class="w-full h-full object-cover max-h-[400px] rounded-br-3xl md:rounded-br-[65px]"
                            alt="comingsoon">
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse xl:flex-row gap-5 md:p-10">
                <div class="md:flex-1 mb-10 lg:mb-0 lg:pr-10">
                    <h2 class="font-poppins font-bold text-xl lg:text-3xl mb-5">
                        Coding For Teach
                    </h2>
                    <div class="font-poppins text-cardhitam text-justify">
                        Di era digital, literasi pemrograman menjadi kompetensi penting bagi pendidik. Pelatihan Coding for
                        Teach dirancang untuk membekali guru dari berbagai jenjang dengan pemahaman dasar coding serta cara
                        mengintegrasikannya dalam pembelajaran secara kreatif dan menyenangkan. Menggunakan platform ramah
                        pemula seperti Scratch, Blockly, atau Python dasar, pelatihan ini juga membantu guru mengajarkan
                        logika pemrograman kepada siswa untuk menumbuhkan kemampuan berpikir kritis dan pemecahan masalah.
                    </div>
                    <div class="flex justify-center text-center mt-5 uppercase font-bold group">
                        <a href="#"
                            class="text-white font-poppins bg-headerbanner py-3 rounded-full w-full group-hover:scale-105 transition ease-in-out duration-300">
                            daftar
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative rounded-br-3xl md:rounded-br-[65px] max-h-[400px]">
                    <div class="absolute z-10 -top-6 md:-top-10 -left-10">
                        <img src="{{ asset('img/general/mask.png') }}" class="w-26 md:w-full" alt="mask">
                    </div>
                    <img src="{{ asset('img/general/iht-9.webp') }}"
                        class="w-full h-full object-cover rounded-br-3xl md:rounded-br-[65px] max-h-[400px]"
                        alt="iht">
                    <div class="absolute top-0 left-0 w-full max-h-[400px]">
                        <img src="{{ asset('img/general/comingsoon.webp') }}"
                            class="w-full h-full object-cover max-h-[400px] rounded-br-3xl md:rounded-br-[65px]"
                            alt="comingsoon">
                    </div>
                </div>
            </div>

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
