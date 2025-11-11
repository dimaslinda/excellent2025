@extends('layouts.main')
@section('konten')
    <section class="min-h-screen py-20 md:py-32">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex md:block md:col-span-1">
                                @if (session('registrasi.foto_path'))
                                    @php $foto = session('registrasi.foto_path'); @endphp
                                    @php $isUrl = \Illuminate\Support\Str::startsWith($foto, ['http://','https://']); @endphp
                                    <img src="{{ $isUrl ? $foto : asset('storage/' . $foto) }}" alt="Foto Siswa"
                                        class="w-24 h-24 md:w-32 md:h-32 rounded-full object-cover border">
                                @else
                                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-100 flex items-center justify-center border">
                                        <span class="text-gray-500 text-sm">Tidak ada foto</span>
                                    </div>
                                @endif
                            </div>
                            <div class="md:col-span-1">
                                <p><strong>Nama Siswa:</strong> {{ session('registrasi.name') }}</p>
                                <p><strong>Asal Sekolah:</strong> {{ session('registrasi.sekolah') }}</p>
                                <p><strong>Provinsi:</strong> {{ session('registrasi.provinsi') }}</p>
                                <p><strong>Kota/Kabupaten:</strong> {{ session('registrasi.kota') }}</p>
                            </div>
                            <div class="md:col-span-1">
                                <p><strong>No. WhatsApp Orang Tua:</strong>
                                    {{ session('registrasi.nomor_whatsapp_orang_tua') }}</p>
                                <p><strong>No. WhatsApp Guru:</strong> {{ session('registrasi.nomor_whatsapp_guru') }}</p>
                                <p><strong>Email Guru:</strong> {{ session('registrasi.email_guru') }}</p>
                                <p><strong>NISN:</strong> {{ session('registrasi.nisn') ?? '-' }}</p>
                                <p><strong>Jenjang:</strong> {{ session('registrasi.jenjang') }}</p>
                                @if (session('registrasi.jenjang') === 'SD')
                                    <p><strong>Tingkatan SD:</strong> {{ session('registrasi.tingkatan_sd') == 'rendah' ? 'Rendah (Kelas 1–3)' : 'Tinggi (Kelas 4–6)' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h1 class="text-xl font-bold font-poppins mb-4">Lengkapi Asesmen: Minat Belajar → Gaya Belajar</h1>

                    <!-- Wizard Tabs / Progress -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 mr-4">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div id="progressBar" class="h-2 rounded-full bg-headerbanner" style="width:50%"></div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" id="tabMinat" class="px-3 py-2 rounded border bg-headerbanner text-white border-headerbanner">1. Minat</button>
                                <button type="button" id="tabQuiz" class="px-3 py-2 rounded border bg-white text-gray-700">2. Quiz</button>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('assessment.hasil') }}" id="assessmentForm">
                        @csrf
                        <!-- Step 1: Minat Belajar -->
                        <div id="stepMinat">
                            @if (isset($minatSoals) && $minatSoals->isNotEmpty())
                                <div class="mb-6 p-4 border rounded-lg">
                                    <label class="block text-lg font-medium mb-2">Minat Belajar</label>
                                    <p class="text-sm text-gray-600 mb-4">Jawablah sesuai kebiasaan belajar Anda. Tidak ada jawaban benar atau salah.</p>
                                    <div class="space-y-6">
                                        @foreach ($minatSoals as $mIndex => $mSoal)
                                            <div>
                                                @php $minatImg = method_exists($mSoal, 'getFirstMediaUrl') ? $mSoal->getFirstMediaUrl('minat_soal_images') : null; @endphp
                                                @if ($minatImg)
                                                    <img src="{{ $minatImg }}" alt="Gambar pertanyaan" class="mb-3 w-full max-h-64 object-contain rounded">
                                                @endif
                                                <p class="text-sm text-gray-600 mb-3">{{ $mIndex + 1 }}. {{ $mSoal->pertanyaan }}</p>
                                                <div class="space-y-2">
                                                    @foreach ($mSoal->jawaban as $mJawaban)
                                                        <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                                            <input type="radio" name="minat[{{ $mSoal->id }}]" value="{{ $mJawaban->id }}" class="mr-3 text-headerbanner focus:ring-headerbanner">
                                                            <span class="text-gray-700">{{ $mJawaban->kode }}. {{ $mJawaban->label }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">Belum ada pertanyaan Minat Belajar.</div>
                            @endif
                            <div class="flex justify-end">
                                <button type="button" id="btnNextQuiz" class="px-5 py-2 rounded-full bg-headerbanner text-white hover:bg-footer transition-colors">Lanjut ke Quiz</button>
                            </div>
                        </div>

                        <!-- Step 2: Quiz (Gaya Belajar) -->
                        <div id="stepQuiz" class="hidden">
                            @if ($soals->isEmpty())
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">Belum ada soal Quiz yang tersedia untuk jenjang Anda.</div>
                            @endif
                            @foreach ($soals as $index => $soal)
                                <div class="mb-6 p-4 border rounded-lg">
                                    @php $quizImg = method_exists($soal, 'getFirstMediaUrl') ? $soal->getFirstMediaUrl('quiz_soal_images') : null; @endphp
                                    @if ($quizImg)
                                        <img src="{{ $quizImg }}" alt="Gambar pertanyaan" class="mb-3 w-full max-h-64 object-contain rounded">
                                    @endif
                                    <label class="block text-lg font-medium mb-2">{{ $index + 1 }}. {{ $soal->pertanyaan }}</label>
                                    <div class="space-y-2">
                                        @foreach ($soal->jawaban as $jawaban)
                                            <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $jawaban->id }}" class="mr-3 text-headerbanner focus:ring-headerbanner">
                                                <span class="text-gray-700">{{ $jawaban->jawaban }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between">
                                <button type="button" id="btnBackMinat" class="px-5 py-2 rounded-full bg-white border text-gray-700 hover:bg-gray-50">Kembali ke Minat</button>
                                <button type="submit" class="px-5 py-2 rounded-full bg-headerbanner text-white hover:bg-footer transition-colors" {{ $soals->isEmpty() && isset($minatSoals) && $minatSoals->isNotEmpty() ? '' : '' }}>Kirim Jawaban</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        (function(){
                            const tabMinat = document.getElementById('tabMinat');
                            const tabQuiz = document.getElementById('tabQuiz');
                            const stepMinat = document.getElementById('stepMinat');
                            const stepQuiz = document.getElementById('stepQuiz');
                            const progressBar = document.getElementById('progressBar');
                            const btnNextQuiz = document.getElementById('btnNextQuiz');
                            const btnBackMinat = document.getElementById('btnBackMinat');

                            function setStep(step){
                                if(step === 'minat'){
                                    stepMinat.classList.remove('hidden');
                                    stepQuiz.classList.add('hidden');
                                    progressBar.style.width = '50%';
                                    // Aktifkan Minat, pastikan tidak tertinggal kelas netral
                                    tabMinat.classList.remove('bg-white','text-gray-700');
                                    tabMinat.classList.add('bg-headerbanner','text-white','border-headerbanner');
                                    // Nonaktifkan Quiz
                                    tabQuiz.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabQuiz.classList.add('bg-white','text-gray-700');
                                }else{
                                    stepQuiz.classList.remove('hidden');
                                    stepMinat.classList.add('hidden');
                                    progressBar.style.width = '100%';
                                    // Aktifkan Quiz, pastikan tidak tertinggal kelas netral
                                    tabQuiz.classList.remove('bg-white','text-gray-700');
                                    tabQuiz.classList.add('bg-headerbanner','text-white','border-headerbanner');
                                    // Nonaktifkan Minat
                                    tabMinat.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabMinat.classList.add('bg-white','text-gray-700');
                                }
                            }

                            tabMinat.addEventListener('click', ()=> setStep('minat'));
                            tabQuiz.addEventListener('click', ()=> setStep('quiz'));
                            if(btnNextQuiz) btnNextQuiz.addEventListener('click', ()=> setStep('quiz'));
                            if(btnBackMinat) btnBackMinat.addEventListener('click', ()=> setStep('minat'));
                            // Inisialisasi agar kelas konsisten pada load
                            setStep('minat');
                        })();
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection
