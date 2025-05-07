@extends('layouts.main')
@section('konten')
    <section class="min-h-screen py-20 md:py-32">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
                    <h1 class="text-xl font-bold font-poppins mb-4">JAWAB PERTANYAAN DI BAWAH INI SESUAI KEPRIBADIAN ANDA!
                    </h1>
                    <form method="POST" action="/assessment">
                        @csrf
                        @for ($i = 1; $i <= 30; $i++)
                            <div class="mb-4">
                                <label class="block">
                                    {{ $i }}. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </label>
                                @for ($j = 1; $j <= 5; $j++)
                                    <label class="block mt-1 font-poppins">
                                        <input type="radio" name="question_{{ $i }}"
                                            value="{{ $j }}"
                                            class="mr-2 text-headerbanner focus:ring-headerbanner">
                                        Lorem ipsum pilihan {{ $j }}
                                    </label>
                                @endfor
                            </div>
                        @endfor
                        <button type="submit"
                            class="mt-4 w-full bg-headerbanner uppercase font-poppins text-white py-2 rounded-full hover:bg-footer">
                            submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
