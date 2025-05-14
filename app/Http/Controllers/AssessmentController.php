<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\QuizSoal;
use App\Models\QuizJawaban;
use App\Models\QuizHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuizResultMail;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{
    private const MAX_QUESTIONS = 30;
    private const LEARNING_STYLES = ['visual', 'auditori', 'kinestetik', 'readwrite'];

    public function index()
    {
        if (!$this->isUserRegistered()) {
            return $this->redirectToRegistration();
        }

        if ($this->hasUserCompletedTest()) {
            return $this->showPreviousTestResult();
        }

        return $this->showQuizQuestions();
    }

    public function hasil(Request $request)
    {
        if (!$this->isUserRegistered()) {
            return $this->redirectToRegistration();
        }

        // Cek apakah request ini adalah hasil refresh halaman
        if (!$request->isMethod('post')) {
            // Jika request GET (refresh), tampilkan hasil sebelumnya jika ada
            if ($this->hasUserCompletedTest()) {
                return $this->showPreviousTestResult();
            }
            // Jika belum ada hasil, arahkan ke halaman assessment
            return redirect()->route('assessment');
        }

        // Cek apakah peserta sudah mengikuti test
        if ($this->hasUserCompletedTest()) {
            return $this->showPreviousTestResult();
        }

        $validator = $this->validateAnswers($request);
        if ($validator->fails()) {
            return $this->handleValidationError($validator);
        }

        try {
            $skor = $this->calculateScores($request->jawaban);
            $gayaBelajar = $this->determineLearningStyle($skor);
            $hasil = $this->saveTestResult($gayaBelajar, $skor);

            // Tambahkan pesan sukses
            session()->flash('success', 'Tes berhasil diselesaikan dan hasil telah dikirim ke email guru Anda.');

            // Langsung tampilkan halaman hasil tanpa redirect
            return $this->showTestResult($hasil, $skor);
        } catch (QueryException $e) {
            return $this->handleDatabaseError();
        }
    }

    public function showHasil()
    {
        if (!$this->isUserRegistered()) {
            return $this->redirectToRegistration();
        }

        if (!$this->hasUserCompletedTest()) {
            return redirect()->route('assessment')
                ->with('error', 'Anda belum menyelesaikan test. Silakan lakukan test terlebih dahulu.');
        }

        return $this->showPreviousTestResult();
    }

    public function store(Request $request)
    {
        $validator = $this->validateRegistrationData($request);
        if ($validator->fails()) {
            return $this->handleValidationError($validator);
        }

        $existingPeserta = $this->findExistingPeserta($request);
        if ($existingPeserta) {
            return $this->handleExistingPeserta($existingPeserta);
        }

        try {
            $peserta = $this->createNewPeserta($request);
            $this->storeRegistrationInSession($peserta);
            return redirect()->route('assessment');
        } catch (QueryException $e) {
            return $this->handleDatabaseError();
        }
    }

    private function isUserRegistered(): bool
    {
        return session()->has('registrasi');
    }

    private function redirectToRegistration()
    {
        return redirect()->route('registrasi')
            ->with('error', 'Silakan lengkapi data registrasi terlebih dahulu');
    }

    private function hasUserCompletedTest(): bool
    {
        return QuizHasil::where('peserta_id', session('registrasi.id'))->exists();
    }

    private function showPreviousTestResult()
    {
        $hasil = QuizHasil::where('peserta_id', session('registrasi.id'))
            ->latest()
            ->first();

        $skor = [
            'visual' => $hasil->skor_visual,
            'auditori' => $hasil->skor_auditori,
            'kinestetik' => $hasil->skor_kinestetik,
            'readwrite' => $hasil->skor_readwrite,
        ];

        return view('hasil', compact('hasil', 'skor'))
            ->with('warning', 'Anda sudah melakukan test sebelumnya. Berikut adalah hasil test Anda.');
    }

    private function showQuizQuestions()
    {
        $soals = QuizSoal::with(['jawaban' => function ($query) {
            $query->inRandomOrder();
        }])
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(self::MAX_QUESTIONS)
            ->get();

        return view('assessment', compact('soals'));
    }

    private function validateAnswers(Request $request)
    {
        return Validator::make($request->all(), [
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|exists:quiz_jawabans,id',
        ], [
            'jawaban.required' => 'Anda harus menjawab semua pertanyaan',
            'jawaban.*.required' => 'Anda harus menjawab semua pertanyaan',
            'jawaban.*.exists' => 'Jawaban tidak valid',
        ]);
    }

    private function calculateScores(array $jawabanIds): array
    {
        $skor = array_fill_keys(self::LEARNING_STYLES, 0);
        $jawabans = QuizJawaban::whereIn('id', $jawabanIds)->get();

        foreach ($jawabans as $jawaban) {
            $skor[$jawaban->gaya_belajar]++;
        }

        return $skor;
    }

    private function determineLearningStyle(array $skor): string
    {
        return array_search(max($skor), $skor);
    }

    private function saveTestResult(string $gayaBelajar, array $skor): QuizHasil
    {
        $hasil = QuizHasil::create([
            'peserta_id' => session('registrasi.id'),
            'gaya_belajar' => $gayaBelajar,
            'skor_visual' => $skor['visual'],
            'skor_auditori' => $skor['auditori'],
            'skor_kinestetik' => $skor['kinestetik'],
            'skor_readwrite' => $skor['readwrite'],
        ]);

        session(['hasil_quiz' => [
            'gaya_belajar' => $gayaBelajar,
            'skor' => $skor,
        ]]);

        // Ambil data peserta
        $peserta = Peserta::find(session('registrasi.id'));

        // Kirim email hasil quiz
        try {
            Mail::to($peserta->email_guru)
                ->send(new QuizResultMail($hasil, $peserta, $skor));
        } catch (\Exception $e) {
            // Log error pengiriman email
            Log::error('Gagal mengirim email hasil quiz: ' . $e->getMessage());
        }

        // Kirim WhatsApp ke orang tua via Fonnte
        try {
            $waMessage = "Assalamu'alaikum, berikut hasil tes gaya belajar untuk ananda {$peserta->name}:\n\n"
                . "Gaya belajar dominan: " . ucfirst($hasil->gaya_belajar) . "\n"
                . "Visual: {$skor['visual']}, Auditori: {$skor['auditori']}, Kinestetik: {$skor['kinestetik']}, Read/Write: {$skor['readwrite']}\n\n"
                . "Rekomendasi: ";
            if ($hasil->gaya_belajar == 'visual') {
                $waMessage .= "Berikan materi dengan banyak gambar, diagram, dan visualisasi.";
            } elseif ($hasil->gaya_belajar == 'auditori') {
                $waMessage .= "Berikan materi dengan penjelasan lisan, diskusi, dan audio.";
            } elseif ($hasil->gaya_belajar == 'kinestetik') {
                $waMessage .= "Berikan materi dengan aktivitas praktik, eksperimen, dan simulasi.";
            } else {
                $waMessage .= "Berikan materi dengan banyak teks, artikel, dan catatan tertulis.";
            }
            $waMessage .= "\n\nTerima kasih, Tim Excellent 2025";

            $this->sendWhatsappFonnte($peserta->nomor_whatsapp_orang_tua, $waMessage);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim WhatsApp hasil quiz: ' . $e->getMessage());
        }

        return $hasil;
    }

    private function showTestResult(QuizHasil $hasil, array $skor)
    {
        return view('hasil', compact('hasil', 'skor'));
    }

    private function validateRegistrationData(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'provinsi' => 'required|exists:indonesia_provinces,code',
            'kota' => 'required|exists:indonesia_cities,code',
            'nomor_whatsapp_orang_tua' => 'required|string|max:20|regex:/^[0-9]+$/',
            'nomor_whatsapp_guru' => 'required|string|max:20|regex:/^[0-9]+$/',
            'email_guru' => 'required|email|max:255',
        ], [
            'name.required' => 'Nama siswa harus diisi',
            'sekolah.required' => 'Asal sekolah harus diisi',
            'provinsi.required' => 'Provinsi harus dipilih',
            'provinsi.exists' => 'Provinsi yang dipilih tidak valid',
            'kota.required' => 'Kota/Kabupaten harus dipilih',
            'kota.exists' => 'Kota/Kabupaten yang dipilih tidak valid',
            'nomor_whatsapp_orang_tua.required' => 'Nomor WhatsApp orang tua harus diisi',
            'nomor_whatsapp_orang_tua.regex' => 'Nomor WhatsApp orang tua harus berupa angka',
            'nomor_whatsapp_guru.required' => 'Nomor WhatsApp guru harus diisi',
            'nomor_whatsapp_guru.regex' => 'Nomor WhatsApp guru harus berupa angka',
            'email_guru.required' => 'Email guru harus diisi',
            'email_guru.email' => 'Format email guru tidak valid',
        ]);
    }

    private function findExistingPeserta(Request $request): ?Peserta
    {
        return Peserta::where('name', $request->name)
            ->where('sekolah', $request->sekolah)
            ->first();
    }

    private function handleExistingPeserta(Peserta $peserta)
    {
        $this->storeRegistrationInSession($peserta);
        return redirect()->route('assessment')
            ->with('info', 'Data Anda sudah terdaftar sebelumnya. Silakan lanjutkan ke halaman assessment.');
    }

    private function createNewPeserta(Request $request): Peserta
    {
        return Peserta::create([
            'name' => $request->name,
            'sekolah' => $request->sekolah,
            'provinsi' => Province::where('code', $request->provinsi)->first()->name,
            'kota' => City::where('code', $request->kota)->first()->name,
            'nomor_whatsapp_orang_tua' => $request->nomor_whatsapp_orang_tua,
            'nomor_whatsapp_guru' => $request->nomor_whatsapp_guru,
            'email_guru' => $request->email_guru,
        ]);
    }

    private function storeRegistrationInSession(Peserta $peserta): void
    {
        session([
            'registrasi' => [
                'id' => $peserta->id,
                'name' => $peserta->name,
                'slug' => $peserta->slug,
                'sekolah' => $peserta->sekolah,
                'provinsi' => $peserta->provinsi,
                'kota' => $peserta->kota,
                'nomor_whatsapp_orang_tua' => $peserta->nomor_whatsapp_orang_tua,
                'nomor_whatsapp_guru' => $peserta->nomor_whatsapp_guru,
                'email_guru' => $peserta->email_guru,
            ]
        ]);
    }

    private function handleValidationError($validator)
    {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    private function handleDatabaseError()
    {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }

    private function sendWhatsappFonnte($to, $message)
    {
        $token = '1zDZTNXi5aA8MVTpeAcr'; // Ganti dengan token Fonnte Anda

        $payload = [
            'target' => $to, // Nomor tujuan, contoh: 6281234567890
            'message' => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $token"
        ]);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
