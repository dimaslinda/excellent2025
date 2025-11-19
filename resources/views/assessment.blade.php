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

                    <h1 class="text-xl font-bold font-poppins mb-4">Lengkapi Asesmen: Profil Siswa → Minat Belajar → Gaya Belajar</h1>

                    <!-- Wizard Tabs / Progress -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 mr-4">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div id="progressBar" class="h-2 rounded-full bg-headerbanner" style="width:33%"></div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" id="tabProfil" class="px-3 py-2 rounded border bg-headerbanner text-white border-headerbanner">1. Profil</button>
                                <button type="button" id="tabMinat" class="px-3 py-2 rounded border bg-white text-gray-700">2. Minat</button>
                                <button type="button" id="tabQuiz" class="px-3 py-2 rounded border bg-white text-gray-700">3. Quiz</button>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('assessment.hasil') }}" id="assessmentForm">
                        @csrf
                        <!-- Step 0: Profil Siswa -->
                        <div id="stepProfil">
                            @if (isset($profilSoals) && $profilSoals->isNotEmpty())
                                <div class="mb-6 p-4 border rounded-lg">
                                    <label class="block text-lg font-medium mb-2">Profil Siswa</label>
                                    <p class="text-sm text-gray-600 mb-4">Lengkapi profil belajar Anda dengan memilih opsi yang sesuai.</p>
                                    <div class="space-y-6">
                                        @foreach ($profilSoals as $pIndex => $pSoal)
                                            <div class="question-block mb-6 p-4 border rounded-lg" data-group="profil" data-qid="{{ $pSoal->id }}" data-number="{{ $pIndex + 1 }}">
                                                @php $profilImg = method_exists($pSoal, 'getFirstMediaUrl') ? $pSoal->getFirstMediaUrl('profil_soal_images') : null; @endphp
                                                @if ($profilImg)
                                                    <img src="{{ $profilImg }}" alt="Gambar pertanyaan" class="mb-3 w-full max-h-64 object-contain rounded">
                                                @endif
                                                <p class="text-sm text-gray-600 mb-3">{{ $pIndex + 1 }}. {{ $pSoal->pertanyaan }}</p>
                                                <div class="space-y-2" role="radiogroup" aria-labelledby="profil-q-{{ $pSoal->id }}-label">
                                                    @foreach ($pSoal->jawaban as $pJawaban)
                                                        @php $answerImg = method_exists($pJawaban, 'getFirstMediaUrl') ? $pJawaban->getFirstMediaUrl('answer_images') : null; @endphp
                                                        <label class="flex items-start gap-4 p-3 rounded cursor-pointer border border-gray-200 hover:bg-headerbanner/5 transition-colors focus:outline-none"
                                                             data-group="profil" data-qid="{{ $pSoal->id }}" data-aid="{{ $pJawaban->id }}">
                                                             <input type="radio" name="profil[{{ $pSoal->id }}]" value="{{ $pJawaban->id }}" hidden>
                                                             <span class="inline-flex items-center justify-center w-9 h-9 md:w-10 md:h-10 rounded-full bg-gray-100 text-gray-800 font-semibold">{{ $pJawaban->kode }}</span>
                                                            <div class="flex flex-col items-start text-left">
                                                                @if ($answerImg)
                                                                    <img src="{{ $answerImg }}" alt="" class="w-[6.25rem] h-[6.25rem] rounded object-cover shrink-0" />
                                                                @endif
                                                                <span class="text-gray-700 @if($answerImg) mt-2 @endif">{{ $pJawaban->label }}</span>
                                                            </div>
                                                          </label>
                                                     @endforeach
                                                 </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">Belum ada pertanyaan Profil Siswa.</div>
                            @endif
                            <div class="flex justify-end">
                                <button type="button" id="btnNextMinat" class="px-5 py-2 rounded-full bg-headerbanner text-white hover:bg-footer transition-colors">Lanjut ke Minat</button>
                            </div>
                            <p id="profilError" class="text-red-600 text-sm mt-2 hidden">Silakan pilih jawaban untuk semua pertanyaan Profil Siswa.</p>
                        </div>
                        <!-- Step 1: Minat Belajar -->
                        <div id="stepMinat" class="hidden">
                            @if (isset($minatSoals) && $minatSoals->isNotEmpty())
                                <div class="mb-6 p-4 border rounded-lg">
                                    <label class="block text-lg font-medium mb-2">Minat Belajar</label>
                                    <p class="text-sm text-gray-600 mb-4">Jawablah sesuai kebiasaan belajar Anda. Tidak ada jawaban benar atau salah.</p>
                                    <div class="space-y-6">
                                        @foreach ($minatSoals as $mIndex => $mSoal)
                                            <div class="question-block mb-6 p-4 border rounded-lg" data-group="minat" data-qid="{{ $mSoal->id }}" data-number="{{ $mIndex + 1 }}">
                                                @php $minatImg = method_exists($mSoal, 'getFirstMediaUrl') ? $mSoal->getFirstMediaUrl('minat_soal_images') : null; @endphp
                                                @if ($minatImg)
                                                    <img src="{{ $minatImg }}" alt="Gambar pertanyaan" class="mb-3 w-full max-h-64 object-contain rounded">
                                                @endif
                                                <p class="text-sm text-gray-600 mb-3">{{ $mIndex + 1 }}. {{ $mSoal->pertanyaan }}</p>
                                                <div class="space-y-2" role="radiogroup" aria-labelledby="minat-q-{{ $mSoal->id }}-label">
                                                    @foreach ($mSoal->jawaban as $mJawaban)
                                                        @php $answerImg = method_exists($mJawaban, 'getFirstMediaUrl') ? $mJawaban->getFirstMediaUrl('answer_images') : null; @endphp
                                                        <label class="flex items-start gap-4 p-3 rounded cursor-pointer border border-gray-200 hover:bg-headerbanner/5 transition-colors focus:outline-none"
                                                             data-group="minat" data-qid="{{ $mSoal->id }}" data-aid="{{ $mJawaban->id }}">
                                                             <input type="radio" name="minat[{{ $mSoal->id }}]" value="{{ $mJawaban->id }}" hidden>
                                                             <span class="inline-flex items-center justify-center w-9 h-9 md:w-10 md:h-10 rounded-full bg-gray-100 text-gray-800 font-semibold">{{ $mJawaban->kode }}</span>
                                                            <div class="flex flex-col items-start text-left">
                                                                @if ($answerImg)
                                                                    <img src="{{ $answerImg }}" alt="" class="w-[6.25rem] h-[6.25rem] rounded object-cover shrink-0" />
                                                                @endif
                                                                <span class="text-gray-700 @if($answerImg) mt-2 @endif">{{ $mJawaban->label }}</span>
                                                            </div>
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
                            <div class="flex items-center justify-between">
                                <button type="button" id="btnBackProfil" class="px-5 py-2 rounded-full bg-white border text-gray-700 hover:bg-gray-50">Kembali ke Profil</button>
                                <button type="button" id="btnNextQuiz" class="px-5 py-2 rounded-full bg-headerbanner text-white hover:bg-footer transition-colors">Lanjut ke Quiz</button>
                            </div>
                            <p id="minatError" class="text-red-600 text-sm mt-2 hidden">Silakan pilih jawaban untuk semua pertanyaan Minat.</p>
                        </div>

                        <!-- Step 2: Quiz (Gaya Belajar) -->
                        <div id="stepQuiz" class="hidden">
                            @if ($soals->isEmpty())
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">Belum ada soal Quiz yang tersedia untuk jenjang Anda.</div>
                            @endif
                            @foreach ($soals as $index => $soal)
                                <div class="question-block mb-6 p-4 border rounded-lg" data-group="quiz" data-qid="{{ $soal->id }}" data-number="{{ $index + 1 }}">
                                    @php $quizImg = method_exists($soal, 'getFirstMediaUrl') ? $soal->getFirstMediaUrl('quiz_soal_images') : null; @endphp
                                    @if ($quizImg)
                                        <img src="{{ $quizImg }}" alt="Gambar pertanyaan" class="mb-3 w-full max-h-64 object-contain rounded">
                                    @endif
                                    <label class="block text-lg font-medium mb-2">{{ $index + 1 }}. {{ $soal->pertanyaan }}</label>
                                    <div class="space-y-2" role="radiogroup" aria-labelledby="quiz-q-{{ $soal->id }}-label">
                                        @foreach ($soal->jawaban as $jawaban)
                                            @php $answerImg = method_exists($jawaban, 'getFirstMediaUrl') ? $jawaban->getFirstMediaUrl('answer_images') : null; @endphp
                                            <label class="flex items-start gap-4 p-3 rounded cursor-pointer border border-gray-200 hover:bg-headerbanner/5 transition-colors focus:outline-none"
                                                 data-group="quiz" data-qid="{{ $soal->id }}" data-aid="{{ $jawaban->id }}">
                                                 <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $jawaban->id }}" hidden>
                                                 <span class="inline-flex items-center justify-center w-9 h-9 md:w-10 md:h-10 rounded-full bg-gray-100 text-gray-800 font-semibold">{{ chr(64 + $loop->iteration) }}</span>
                                                <div class="flex flex-col items-start text-left">
                                                    @if ($answerImg)
                                                        <img src="{{ $answerImg }}" alt="" class="w-[6.25rem] h-[6.25rem] rounded object-cover shrink-0" />
                                                    @endif
                                                    <span class="text-gray-700 @if($answerImg) mt-2 @endif">{{ $jawaban->jawaban }}</span>
                                                </div>
                                             </label>
                                         @endforeach
                                     </div>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between">
                                <button type="button" id="btnBackMinat" class="px-5 py-2 rounded-full bg-white border text-gray-700 hover:bg-gray-50">Kembali ke Minat</button>
                                <button type="submit" class="px-5 py-2 rounded-full bg-headerbanner text-white hover:bg-footer transition-colors" {{ $soals->isEmpty() && isset($minatSoals) && $minatSoals->isNotEmpty() ? '' : '' }}>Kirim Jawaban</button>
                            </div>
                            <p id="quizError" class="text-red-600 text-sm mt-2 hidden">Masih ada pertanyaan Quiz yang belum dijawab.</p>
                        </div>
                    </form>

                    <script>
                        (function(){
                            const tabProfil = document.getElementById('tabProfil');
                            const tabMinat = document.getElementById('tabMinat');
                            const tabQuiz = document.getElementById('tabQuiz');
                            const stepProfil = document.getElementById('stepProfil');
                            const stepMinat = document.getElementById('stepMinat');
                            const stepQuiz = document.getElementById('stepQuiz');
                            const progressBar = document.getElementById('progressBar');
                            const btnNextMinat = document.getElementById('btnNextMinat');
                            const btnNextQuiz = document.getElementById('btnNextQuiz');
                            const btnBackMinat = document.getElementById('btnBackMinat');
                            const btnBackProfil = document.getElementById('btnBackProfil');
                            const profilError = document.getElementById('profilError');
                            const minatError = document.getElementById('minatError');
                            const quizError = document.getElementById('quizError');

                            function getUnanswered(group){
                                let selectorNamePrefix = group === 'quiz' ? 'jawaban[' : group + '[';
                                const names = new Set(Array.from(document.querySelectorAll('input[name^="' + selectorNamePrefix + '" ]')).map(i => i.name));
                                const missing = [];
                                names.forEach(n => {
                                    if(!document.querySelector('input[name="' + n + '"]:checked')){
                                        // extract qid from name: group[ID]
                                        const match = n.match(/\[(\d+)\]/);
                                        const qid = match ? match[1] : null;
                                        const container = qid ? document.querySelector('.question-block[data-group="' + group + '"][data-qid="' + qid + '"]') : null;
                                        const num = container ? container.getAttribute('data-number') : null;
                                        if(container){
                                            container.classList.add('border-red-400','bg-red-50');
                                        }
                                        missing.push(num || qid || n);
                                    }else{
                                        // clear highlight if answered
                                        const match = n.match(/\[(\d+)\]/);
                                        const qid = match ? match[1] : null;
                                        const container = qid ? document.querySelector('.question-block[data-group="' + group + '"][data-qid="' + qid + '"]') : null;
                                        if(container){
                                            container.classList.remove('border-red-400','bg-red-50');
                                        }
                                    }
                                });
                                return missing.sort((a,b)=> Number(a) - Number(b));
                            }

                            function showError(group){
                                const missing = getUnanswered(group);
                                if(group === 'profil' && profilError){
                                    if(missing.length){
                                        profilError.textContent = `Masih ada ${missing.length} pertanyaan Profil belum terisi: nomor ${missing.join(', ')}.`;
                                        profilError.classList.remove('hidden');
                                        const first = document.querySelector(`.question-block[data-group="profil"][data-number="${missing[0]}"]`);
                                        if(first){ first.scrollIntoView({behavior:'smooth', block:'start'}); }
                                    } else {
                                        profilError.classList.add('hidden');
                                    }
                                }
                                if(group === 'minat' && minatError){
                                    if(missing.length){
                                        minatError.textContent = `Masih ada ${missing.length} pertanyaan Minat belum terisi: nomor ${missing.join(', ')}.`;
                                        minatError.classList.remove('hidden');
                                        const first = document.querySelector(`.question-block[data-group="minat"][data-number="${missing[0]}"]`);
                                        if(first){ first.scrollIntoView({behavior:'smooth', block:'start'}); }
                                    } else {
                                        minatError.classList.add('hidden');
                                    }
                                }
                                if(group === 'quiz' && quizError){
                                    if(missing.length){
                                        quizError.textContent = `Masih ada ${missing.length} pertanyaan Quiz belum terisi: nomor ${missing.join(', ')}.`;
                                        quizError.classList.remove('hidden');
                                        const first = document.querySelector(`.question-block[data-group="quiz"][data-number="${missing[0]}"]`);
                                        if(first){ first.scrollIntoView({behavior:'smooth', block:'start'}); }
                                    } else {
                                        quizError.classList.add('hidden');
                                    }
                                }
                                return missing.length === 0;
                            }

                            function hasGroupInputs(group){
                                if(group === 'quiz'){
                                    return document.querySelectorAll('input[name^="jawaban[" ]').length > 0;
                                }
                                return document.querySelectorAll('input[name^="' + group + '[" ]').length > 0;
                            }

                            function isGroupComplete(group){
                                if(group === 'profil'){
                                    return !hasGroupInputs('profil') || validateStepProfil();
                                }
                                if(group === 'minat'){
                                    return !hasGroupInputs('minat') || validateStepMinat();
                                }
                                if(group === 'quiz'){
                                    return !hasGroupInputs('quiz') || validateStepQuiz();
                                }
                                return true;
                            }

                            function setDisabledStyles(btn, disabled){
                                if(!btn) return;
                                btn.disabled = !!disabled;
                                if(disabled){
                                    btn.classList.add('opacity-50','cursor-not-allowed');
                                    btn.setAttribute('aria-disabled','true');
                                }else{
                                    btn.classList.remove('opacity-50','cursor-not-allowed');
                                    btn.removeAttribute('aria-disabled');
                                }
                            }

                            function updateTabStates(){
                                const profilComplete = isGroupComplete('profil');
                                const minatComplete = isGroupComplete('minat');
                                // Profil selalu bisa diklik (mundur)
                                setDisabledStyles(tabProfil, false);
                                // Minat hanya aktif bila Profil lengkap (atau tidak tersedia)
                                setDisabledStyles(tabMinat, !profilComplete);
                                // Quiz hanya aktif bila Profil & Minat lengkap (atau tidak tersedia)
                                setDisabledStyles(tabQuiz, !(profilComplete && minatComplete));
                            }

                            function updateProgress(){
                                const profilInputs = document.querySelectorAll('input[name^="profil["]');
                                const minatInputs = document.querySelectorAll('input[name^="minat["]');
                                const quizInputs = document.querySelectorAll('input[name^="jawaban["]');
                                const totalQuestions = new Set(Array.from(profilInputs).map(i => i.name)).size + new Set(Array.from(minatInputs).map(i => i.name)).size + new Set(Array.from(quizInputs).map(i => i.name)).size;
                                const answeredProfil = new Set(Array.from(profilInputs).filter(i => i.checked).map(i => i.name)).size;
                                const answeredMinat = new Set(Array.from(minatInputs).filter(i => i.checked).map(i => i.name)).size;
                                const answeredQuiz = new Set(Array.from(quizInputs).filter(i => i.checked).map(i => i.name)).size;
                                const answered = answeredProfil + answeredMinat + answeredQuiz;
                                const pct = totalQuestions > 0 ? Math.round((answered / totalQuestions) * 100) : 0;
                                progressBar.style.width = pct + '%';
                            }

                            function setStep(step){
                                if(step === 'profil'){
                                    stepProfil.classList.remove('hidden');
                                    stepMinat.classList.add('hidden');
                                    stepQuiz.classList.add('hidden');
                                    tabProfil.classList.remove('bg-white','text-gray-700');
                                    tabProfil.classList.add('bg-headerbanner','text-white','border-headerbanner');
                                    tabMinat.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabMinat.classList.add('bg-white','text-gray-700');
                                    tabQuiz.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabQuiz.classList.add('bg-white','text-gray-700');
                                } else if(step === 'minat'){
                                    stepProfil.classList.add('hidden');
                                    stepMinat.classList.remove('hidden');
                                    stepQuiz.classList.add('hidden');
                                    tabMinat.classList.remove('bg-white','text-gray-700');
                                    tabMinat.classList.add('bg-headerbanner','text-white','border-headerbanner');
                                    tabProfil.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabProfil.classList.add('bg-white','text-gray-700');
                                    tabQuiz.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabQuiz.classList.add('bg-white','text-gray-700');
                                } else {
                                    stepProfil.classList.add('hidden');
                                    stepMinat.classList.add('hidden');
                                    stepQuiz.classList.remove('hidden');
                                    tabQuiz.classList.remove('bg-white','text-gray-700');
                                    tabQuiz.classList.add('bg-headerbanner','text-white','border-headerbanner');
                                    tabProfil.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabProfil.classList.add('bg-white','text-gray-700');
                                    tabMinat.classList.remove('bg-headerbanner','text-white','border-headerbanner');
                                    tabMinat.classList.add('bg-white','text-gray-700');
                                }
                                updateProgress();
                                updateTabStates();
                                // Scroll ke atas setelah pergantian step untuk UX yang lebih baik
                                requestAnimationFrame(() => {
                                    window.scrollTo({ top: 0, behavior: 'smooth' });
                                });
                            }

                            function attachOptionHandlers(){
                                document.querySelectorAll('label[data-group][data-qid][data-aid]').forEach(label => {
                                    label.addEventListener('click', (e) => {
                                        const input = label.querySelector('input[type="radio"]');
                                        if(!input) return;
                                        input.checked = true;
                                        const qid = label.getAttribute('data-qid');
                                        // clear siblings highlight
                                        document.querySelectorAll('label[data-qid="' + qid + '"]').forEach(sib => {
                                            sib.classList.remove('border-headerbanner','bg-headerbanner/10');
                                            sib.classList.add('border-gray-200');
                                        });
                                        // set selected highlight
                                        label.classList.remove('border-gray-200');
                                        label.classList.add('border-headerbanner','bg-headerbanner/10');
                                        // hide any errors if now valid
                                        const group = label.getAttribute('data-group');
                                        const container = label.closest('.question-block');
                                        if(container){ container.classList.remove('border-red-400','bg-red-50'); }
                                        if(group === 'profil' && profilError){ profilError.classList.add('hidden'); }
                                        if(group === 'minat' && minatError){ minatError.classList.add('hidden'); }
                                        if(group === 'quiz' && quizError){ quizError.classList.add('hidden'); }
                                        updateProgress();
                                        updateTabStates();
                                    });
                                });
                            }

                            function validateStepProfil(){
                                const names = new Set(Array.from(document.querySelectorAll('input[name^="profil["]')).map(i => i.name));
                                for(const n of names){
                                    if(!document.querySelector('input[name="' + n + '"]:checked')){
                                        return false;
                                    }
                                }
                                return true;
                            }
                            function validateStepMinat(){
                                const names = new Set(Array.from(document.querySelectorAll('input[name^="minat["]')).map(i => i.name));
                                for(const n of names){
                                    if(!document.querySelector('input[name="' + n + '"]:checked')){
                                        return false;
                                    }
                                }
                                return true;
                            }
                            function validateStepQuiz(){
                                const names = new Set(Array.from(document.querySelectorAll('input[name^="jawaban["]')).map(i => i.name));
                                for(const n of names){
                                    if(!document.querySelector('input[name="' + n + '"]:checked')){
                                        return false;
                                    }
                                }
                                return true;
                            }

                            // Tabs behavior: allow backward freely, gate forward by validations
                            tabProfil && tabProfil.addEventListener('click', ()=> {
                                setStep('profil');
                            });
                            tabMinat && tabMinat.addEventListener('click', ()=> {
                                if(tabMinat.disabled) return;
                                const hasProfil = hasGroupInputs('profil');
                                if(!hasProfil || validateStepProfil()){
                                    setStep('minat');
                                } else {
                                    showError('profil');
                                    setStep('profil');
                                }
                            });
                            tabQuiz && tabQuiz.addEventListener('click', ()=> {
                                if(tabQuiz.disabled) return;
                                const hasProfil = hasGroupInputs('profil');
                                const hasMinat = hasGroupInputs('minat');
                                // Must complete Profil then Minat before Quiz
                                if(hasProfil && !validateStepProfil()){
                                    showError('profil');
                                    setStep('profil');
                                    return;
                                }
                                if(hasMinat && !validateStepMinat()){
                                    showError('minat');
                                    setStep('minat');
                                    return;
                                }
                                setStep('quiz');
                            });
                            if(btnNextMinat) btnNextMinat.addEventListener('click', ()=> {
                                // Jika tidak ada pertanyaan profil, lanjutkan
                                const hasProfil = document.querySelectorAll('input[name^="profil["]').length > 0;
                                if(!hasProfil || validateStepProfil()){
                                    setStep('minat');
                                }else{
                                    showError('profil');
                                }
                            });
                            if(btnNextQuiz) btnNextQuiz.addEventListener('click', ()=> {
                                if(validateStepMinat()){
                                    setStep('quiz');
                                }else{
                                    showError('minat');
                                }
                            });
                            if(btnBackProfil) btnBackProfil.addEventListener('click', ()=> setStep('profil'));
                            if(btnBackMinat) btnBackMinat.addEventListener('click', ()=> setStep('minat'));

                            // Prevent submit if quiz not complete
                            const form = document.getElementById('assessmentForm');
                            if(form){
                                form.addEventListener('submit', (e)=>{
                                    const hasProfil = hasGroupInputs('profil');
                                    const hasMinat = hasGroupInputs('minat');

                                    // Enforce completion of earlier sections before allowing submit
                                    if(hasProfil && !validateStepProfil()){
                                        e.preventDefault();
                                        showError('profil');
                                        setStep('profil');
                                        return;
                                    }
                                    if(hasMinat && !validateStepMinat()){
                                        e.preventDefault();
                                        showError('minat');
                                        setStep('minat');
                                        return;
                                    }
                                    if(!validateStepQuiz()){
                                        e.preventDefault();
                                        showError('quiz');
                                        setStep('quiz');
                                    }
                                });
                            }

                            attachOptionHandlers();
                            setStep('profil');
                            updateProgress();
                            updateTabStates();
                        })();
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection
