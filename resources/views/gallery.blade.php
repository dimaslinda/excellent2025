@extends('layouts.main')
@section('kepala')
    {{-- swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @php
        use Spatie\MediaLibrary\MediaCollections\Models\Media;
    @endphp
@endsection
@section('banner')
    {{-- banner --}}
    <section
        class="py-20 md:py-32 lg:pt-52 relative z-10 bg-[url('../../public/img/general/bg-gallery.webp')] bg-no-repeat bg-cover bg-bottom">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="md:mb-23 font-bold leading-none text-logo tracking-wide">
                <div data-aos="fade-down"
                    class="text-white bg-[rgba(255,_180,_63,_0.64)] rounded-lg py-4 [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.55)] uppercase text-3xl md:text-6xl xl:text-7xl 2xl:text-8xl">
                    galeri
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
                @forelse ($gallery as $item)
                    <div data-modal-target="default-modal-{{ $item->id }}"
                        data-modal-toggle="default-modal-{{ $item->id }}"
                        class="max-w-md rounded-xl cursor-pointer flex flex-col overflow-hidden bg-white drop-shadow-2xl shadow-2xl">
                        <div class="max-h-[320px] overflow-hidden">
                            <img src="{{ $item->getFirstMediaUrl('gallerythumb') }}" class="h-full w-full object-cover"
                                alt="modul">
                        </div>
                        <div class="p-6">
                            <div
                                class="capitalize text-[#191919] text-xl font-bold line-clamp-2 font-poppins mb-5 tracking-wide leading-normal">
                                {{ $item->name }}
                            </div>
                            <div class="text-[#191919] font-poppins">
                                {{ $item->sekolah }}
                            </div>
                        </div>
                    </div>

                    {{-- main modal --}}
                    <div id="default-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-6xl max-h-full">
                            {{-- modal content --}}
                            <div class="relative p-10 bg-white rounded-lg shadow">
                                <button type="button"
                                    class="inline-flex cursor-pointer absolute justify-center top-2 right-2 items-center w-8 h-8 text-sm font-bold text-footer bg-transparent rounded-lg hover:bg-secondary hover:text-headerbanner ms-auto"
                                    data-modal-hide="default-modal-{{ $item->id }}">
                                    <svg class="h-2 w- sm:w-5 sm:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                {{-- modal body --}}
                                <div class="space-y-5 lg:space-y-0">
                                    <div id="mySwiper-{{ $item->id }}"
                                        style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                        class="swiper mySwiper2">
                                        <div class="swiper-wrapper">
                                            @php
                                                $collection = Media::all()
                                                    ->where('model_id', $item->id)
                                                    ->where('collection_name', 'another_portofolio')
                                                    ->take(6);
                                            @endphp
                                            @foreach ($collection as $thumb)
                                                <div class="swiper-slide">
                                                    <div class="max-h-[500px]">
                                                        <img src="{{ $thumb->original_url }}"
                                                            class="object-contain w-full h-full max-h-[500px]"
                                                            alt="audit">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div
                                            class="hidden absolute left-5 top-1/2 z-10 justify-between -translate-y-1/2 sm:flex group">
                                            <div class="swiper-desain-prev cursor-pointer">
                                                <div
                                                    class="flex justify-center items-center self-center w-20 h-20 text-2xl rounded-full shadow-2xl opacity-50 drop-shadow-2xl bg-headerbanner group-hover:opacity-100">
                                                    <div>
                                                        <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 8 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="hidden absolute right-5 top-1/2 z-10 justify-between -translate-y-1/2 sm:flex group">
                                            <div class="swiper-desain-next cursor-pointer">
                                                <div
                                                    class="flex justify-center items-center self-center w-20 h-20 text-2xl rounded-full shadow-2xl opacity-50 drop-shadow-2xl bg-headerbanner group-hover:opacity-100">
                                                    <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 8 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mySwipers-{{ $item->id }}" thumbsSlider=""
                                        class="swiper mySwipers mt-5 max-w-[900px]">
                                        <div class="pb-5 swiper-wrapper">
                                            @foreach ($collection as $nav)
                                                <div class="swiper-slide">
                                                    <div class="h-20 sm:h-32 lg:h-40">
                                                        <img src="{{ $nav->original_url }}"
                                                            class="object-contain w-full h-full" alt="audit">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="md:text-xl font-bold uppercase lg:text-3xl text-sm mb-5 text-footer font-poppins">
                                            {{ $item->name }}
                                        </div>
                                        <div class="text-sm md:text-base uppercase lg:text-xl text-footer font-poppins">
                                            {!! $item->sekolah !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end main modal --}}
                @empty
                    <div class="flex flex-col items-center justify-center w-full h-96">
                        <div class="text-2xl font-bold text-gray-500">Tidak ada data gallery</div>
                        <div class="text-gray-400">Silahkan tambahkan data gallery terlebih dahulu</div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
@section('kaki')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var thisSwiper = [];
        $('.mySwipers').each(function(i) {
            var this_ID = $(this).attr('id');

            thisSwiper[i] = new Swiper('#' + this_ID, {
                // loop: true,
                spaceBetween: 10,
                slidesPerView: 3,
                freeMode: true,
                watchSlidesProgress: true,
            });

        });
        var thisSwiper2 = [];
        $('.mySwiper2').each(function(i) {
            var this_ID = $(this).attr('id');

            thisSwiper2[i] = new Swiper('#' + this_ID, {
                // loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-desain-next",
                    prevEl: ".swiper-desain-prev",
                },
                autoplay: {
                    delay: 3000,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                thumbs: {
                    swiper: thisSwiper[i],
                }
            })
        })
    </script>
@endsection
