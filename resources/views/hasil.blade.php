@extends('layouts.main')
@section('konten')
    <section class="min-h-screen py-20 md:py-32">
        <div class="container mx-auto p-6">
            <div class="flex flex-col justify-center max-w-5xl mx-auto">
                <div class="max-w-sm mx-auto">
                    <img src="{{ asset('img/general/icon-quiz.webp') }}" class="w-full h-full object-cover" alt="icon quiz">
                </div>
                <div class="flex flex-col justify-center text-center font-poppins">
                    <h3 class="font-bold text-xl md:text-2xl lg:text-4xl uppercase mb-5">
                        terima kasih telah melaksanakan asesmen diagnostik bersama excellent team
                    </h3>
                    <div class="text-base md:text-lg mb-6">
                        anda akan menerima hasil asesmen melalui email yang tercantum.
                    </div>

                    <div>
                        <a href="/"
                            class="text-white bg-headerbanner py-2 px-5 rounded-full w-full uppercase font-bold group-hover:scale-110 transition duration-300 ease-in-out">
                            kembali ke beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
