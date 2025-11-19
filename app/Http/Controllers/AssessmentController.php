<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\QuizSoal;
use App\Models\QuizJawaban;
use App\Models\QuizHasil;
use App\Models\MinatSoal;
use App\Models\MinatJawaban;
use App\Models\ProfilSoal;
use App\Models\ProfilJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuizResultMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AssessmentController extends Controller
{
    private const MAX_QUESTIONS = 30;
    private const LEARNING_STYLES = ['visual', 'auditori', 'kinestetik', 'readwrite'];

    // Step 1: Pilih jenjang
    public function jenjang()
    {
        return view('jenjang');
    }

    public function storeJenjang(Request $request)
    {
        $validated = $request->validate([
            'jenjang' => 'required|in:SD,SMP,SMA',
            'tingkatan_sd' => 'nullable|in:rendah,tinggi'
        ], [
            'jenjang.required' => 'Silakan pilih jenjang terlebih dahulu',
            'jenjang.in' => 'Pilihan jenjang tidak valid',
        ]);

        // Jika SD maka tingkatan wajib
        if ($validated['jenjang'] === 'SD' && empty($validated['tingkatan_sd'])) {
            return back()->withErrors(['tingkatan_sd' => 'Silakan pilih tingkatan untuk jenjang SD'])->withInput();
        }

        session(['assessment_jenjang' => [
            'jenjang' => $validated['jenjang'],
            'tingkatan_sd' => $validated['jenjang'] === 'SD' ? ($validated['tingkatan_sd'] ?? null) : null,
        ]]);

        return redirect()->route('registrasi');
    }

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

        // Submit akhir: simpan Profil + Minat + Quiz sekaligus (sesuai ketersediaan)
        // Minat & Profil mendukung jenjang: wajib hanya jika tersedia untuk jenjang/tingkatan yang dipilih
        $jenjang = session('registrasi.jenjang');
        $tingkatanSd = session('registrasi.tingkatan_sd');
        $hasProfil = ProfilSoal::where('is_active', true)
            ->when($jenjang, function ($q) use ($jenjang, $tingkatanSd) {
                $q->where(function ($w) use ($jenjang, $tingkatanSd) {
                    $w->whereNull('jenjang')
                      ->orWhere(function ($q2) use ($jenjang, $tingkatanSd) {
                          $q2->where('jenjang', $jenjang);
                          if ($jenjang === 'SD') {
                              $q2->where(function ($q3) use ($tingkatanSd) {
                                  if ($tingkatanSd) {
                                      $q3->whereNull('tingkatan_sd')
                                         ->orWhere('tingkatan_sd', $tingkatanSd);
                                  } else {
                                      $q3->whereNull('tingkatan_sd');
                                  }
                              });
                          }
                      });
                });
            })
            ->exists();
        $hasMinat = MinatSoal::where('is_active', true)
            ->when($jenjang, function ($q) use ($jenjang, $tingkatanSd) {
                $q->where(function ($w) use ($jenjang, $tingkatanSd) {
                    $w->whereNull('jenjang')
                      ->orWhere(function ($q2) use ($jenjang, $tingkatanSd) {
                          $q2->where('jenjang', $jenjang);
                          if ($jenjang === 'SD') {
                              $q2->where(function ($q3) use ($tingkatanSd) {
                                  if ($tingkatanSd) {
                                      $q3->whereNull('tingkatan_sd')
                                         ->orWhere('tingkatan_sd', $tingkatanSd);
                                  } else {
                                      $q3->whereNull('tingkatan_sd');
                                  }
                              });
                          }
                      });
                });
            })
            ->exists();
        $hasQuiz = QuizSoal::where('is_active', true)
            ->when($jenjang, function ($q) use ($jenjang, $tingkatanSd) {
                $q->where('jenjang', $jenjang);
                if ($jenjang === 'SD' && $tingkatanSd) {
                    $q->where('tingkatan_sd', $tingkatanSd);
                }
            })
            ->exists();

        $rules = [];
        // Wajibkan bagian yang tersedia
        if ($hasProfil) {
            $rules['profil'] = 'required|array';
            $rules['profil.*'] = 'required|exists:profil_jawabans,id';
        }
        if ($hasQuiz) {
            $rules['jawaban'] = 'required|array';
            $rules['jawaban.*'] = 'required|exists:quiz_jawabans,id';
        }
        if ($hasMinat) {
            $rules['minat'] = 'required|array';
            $rules['minat.*'] = 'required|exists:minat_jawabans,id';
        }

        $messages = [
            'profil.required' => 'Silakan lengkapi semua jawaban pada bagian Profil Siswa',
            'profil.*.required' => 'Anda harus menjawab semua pertanyaan Profil Siswa',
            'profil.*.exists' => 'Jawaban Profil Siswa tidak valid',
            'jawaban.required' => 'Silakan lengkapi semua jawaban pada bagian Quiz',
            'jawaban.*.required' => 'Anda harus menjawab semua pertanyaan Quiz',
            'jawaban.*.exists' => 'Jawaban Quiz tidak valid',
        ];
        if ($hasMinat) {
            $messages['minat.required'] = 'Silakan lengkapi semua jawaban pada bagian Minat Belajar';
            $messages['minat.*.required'] = 'Anda harus menjawab semua pertanyaan Minat Belajar';
            $messages['minat.*.exists'] = 'Jawaban Minat Belajar tidak valid';
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->handleValidationError($validator);
        }

        try {
            // Simpan ringkasan Profil Siswa di session
            if ($request->has('profil') && is_array($request->profil)) {
                $profilIds = array_values($request->input('profil', []));
                $profilJawabans = ProfilJawaban::with('soal')->whereIn('id', $profilIds)->get();
                $profilSummary = $profilJawabans->map(function ($j) {
                    return [
                        'pertanyaan' => $j->soal?->pertanyaan,
                        'kode' => $j->kode,
                        'label' => $j->label,
                        'value' => $j->value,
                    ];
                })->toArray();
                session(['profil_siswa' => $profilSummary]);
            }

            // Simpan ringkasan Minat di session (tidak ke DB)
            if ($request->has('minat') && is_array($request->minat)) {
                $minatIds = array_values($request->input('minat', []));
                $minatJawabans = MinatJawaban::with('soal')->whereIn('id', $minatIds)->get();
                $minatSummary = $minatJawabans->map(function ($j) {
                    return [
                        'pertanyaan' => $j->soal?->pertanyaan,
                        'kode' => $j->kode,
                        'label' => $j->label,
                        'value' => $j->value,
                    ];
                })->toArray();
                session(['minat_belajar' => $minatSummary]);
            }

            // Jika quiz tersedia, proses hasilnya dan simpan ke DB
            $hasil = null;
            $skor = null;
            if ($hasQuiz) {
                $skor = $this->calculateScores($request->jawaban);
                $gayaBelajar = $this->determineLearningStyle($skor);
                $hasil = $this->saveTestResult($gayaBelajar, $skor);
            }

            // Tambahkan pesan sukses
            if ($hasQuiz) {
                session()->flash('success', 'Jawaban berhasil dikirim. Hasil Quiz telah dikirim ke email guru Anda.');
            } else {
                session()->flash('success', 'Jawaban berhasil disimpan.');
            }

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

    public function downloadHasil()
    {
        if (!$this->isUserRegistered()) {
            return $this->redirectToRegistration();
        }

        if (!$this->hasUserCompletedTest()) {
            return redirect()->route('assessment')
                ->with('error', 'Anda belum menyelesaikan test. Silakan lakukan test terlebih dahulu.');
        }

        $hasil = QuizHasil::where('peserta_id', session('registrasi.id'))
            ->latest()
            ->first();

        $skor = [
            'visual' => $hasil->skor_visual,
            'auditori' => $hasil->skor_auditori,
            'kinestetik' => $hasil->skor_kinestetik,
            'readwrite' => $hasil->skor_readwrite,
        ];

        // Render PDF dengan opsi lengkap dan ukuran kertas A4 portrait
        $pdf = Pdf::setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ])->loadView('hasil_pdf', compact('hasil', 'skor'));

        $pdf->setPaper('a4', 'portrait');

        $filenameBase = session('registrasi.slug') ?: Str::slug(session('registrasi.name', 'hasil'));
        return $pdf->download('hasil-' . $filenameBase . '.pdf');
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
        // Filter soal berdasarkan jenjang yang dipilih
        $jenjang = session('registrasi.jenjang');
        $tingkatanSd = session('registrasi.tingkatan_sd');

        $query = QuizSoal::with('jawaban')
            ->where('is_active', true);

        if ($jenjang) {
            $query->where(function ($q) use ($jenjang, $tingkatanSd) {
                $q->where('jenjang', $jenjang);
                if ($jenjang === 'SD' && $tingkatanSd) {
                    $q->where('tingkatan_sd', $tingkatanSd);
                }
            });
        }

        $soals = $query->inRandomOrder()->take(self::MAX_QUESTIONS)->get();

        // Randomize answer order for each question
        $soals->each(function ($soal) {
            // Get answers collection and shuffle it
            $shuffledAnswers = $soal->jawaban->shuffle();
            // Reassign shuffled answers back to the question
            $soal->jawaban = $shuffledAnswers;
        });

        // Ambil pertanyaan Profil Siswa, mendukung filter Jenjang/Tingkatan SD
        $profilQuery = ProfilSoal::with(['jawaban' => function ($q) {
            $q->where('is_active', true)->orderBy('urutan');
        }])
            ->where('is_active', true);

        if ($jenjang) {
            $profilQuery->where(function ($q) use ($jenjang, $tingkatanSd) {
                $q->whereNull('jenjang')
                  ->orWhere(function ($q2) use ($jenjang, $tingkatanSd) {
                      $q2->where('jenjang', $jenjang);
                      if ($jenjang === 'SD') {
                          $q2->where(function ($q3) use ($tingkatanSd) {
                              if ($tingkatanSd) {
                                  $q3->whereNull('tingkatan_sd')
                                     ->orWhere('tingkatan_sd', $tingkatanSd);
                              } else {
                                  $q3->whereNull('tingkatan_sd');
                              }
                          });
                      }
                  });
            });
        }

        $profilSoals = $profilQuery->orderBy('urutan')->get();

        // Ambil pertanyaan Minat Belajar, mendukung filter Jenjang/Tingkatan SD
        $minatQuery = MinatSoal::with(['jawaban' => function ($q) {
            $q->where('is_active', true)->orderBy('urutan');
        }])
            ->where('is_active', true);

        if ($jenjang) {
            $minatQuery->where(function ($q) use ($jenjang, $tingkatanSd) {
                // Sertakan pertanyaan global (jenjang NULL) dan yang sesuai jenjang
                $q->whereNull('jenjang')
                  ->orWhere(function ($q2) use ($jenjang, $tingkatanSd) {
                      $q2->where('jenjang', $jenjang);
                      if ($jenjang === 'SD') {
                          $q2->where(function ($q3) use ($tingkatanSd) {
                              // Tingkatan SD opsional: NULL = semua tingkatan; atau spesifik
                              if ($tingkatanSd) {
                                  $q3->whereNull('tingkatan_sd')
                                     ->orWhere('tingkatan_sd', $tingkatanSd);
                              } else {
                                  $q3->whereNull('tingkatan_sd');
                              }
                          });
                      }
                  });
            });
        }

        $minatSoals = $minatQuery->orderBy('urutan')->get();

        $hasQuiz = $soals->isNotEmpty();

        return view('assessment', compact('soals', 'minatSoals', 'profilSoals', 'hasQuiz'));
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
            // Simpan ringkasan Minat (jika ada) ke kolom JSON
            'minat_summary' => session('minat_belajar'),
            // Simpan ringkasan Profil Siswa (jika ada) ke kolom JSON
            'profil_summary' => session('profil_siswa'),
        ]);

        session(['hasil_quiz' => [
            'gaya_belajar' => $gayaBelajar,
            'skor' => $skor,
        ]]);

        // Ambil data peserta
        $peserta = Peserta::find(session('registrasi.id'));

        // Kirim email hasil quiz, sertakan ringkasan Minat & Profil (dari session)
        try {
            Mail::to($peserta->email_guru)
                ->send(new QuizResultMail($hasil, $peserta, $skor, session('minat_belajar'), session('profil_siswa')));
        } catch (\Exception $e) {
            // Log error pengiriman email
            Log::error('Gagal mengirim email hasil quiz: ' . $e->getMessage());
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
            'nisn' => 'nullable|string|max:20|regex:/^[0-9]+$/',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'nisn.regex' => 'NISN harus berupa angka',
            'foto.image' => 'File foto harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpg, jpeg, png, atau webp',
            'foto.max' => 'Ukuran foto maksimal 2MB',
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
        // Buat Peserta terlebih dahulu tanpa menangani foto_path legacy
        $peserta = Peserta::create([
            'name' => $request->name,
            'sekolah' => $request->sekolah,
            'jenjang' => session('assessment_jenjang.jenjang'),
            'tingkatan_sd' => session('assessment_jenjang.tingkatan_sd'),
            'provinsi' => Province::where('code', $request->provinsi)->first()->name,
            'kota' => City::where('code', $request->kota)->first()->name,
            'nomor_whatsapp_orang_tua' => $request->nomor_whatsapp_orang_tua,
            'nomor_whatsapp_guru' => $request->nomor_whatsapp_guru,
            'email_guru' => $request->email_guru,
            'nisn' => $request->nisn,
        ]);

        // Jika ada file foto, simpan ke koleksi 'photo' Spatie Media Library
        if ($request->hasFile('foto')) {
            try {
                $peserta
                    ->addMediaFromRequest('foto')
                    ->toMediaCollection('photo');
            } catch (\Throwable $e) {
                // Log dan lanjutkan tanpa menggagalkan registrasi
                Log::warning('Gagal menyimpan media foto peserta: ' . $e->getMessage());
            }
        }

        return $peserta;
    }

    private function storeRegistrationInSession(Peserta $peserta): void
    {
        // Ambil URL media dari koleksi 'photo' jika tersedia, fallback ke kolom legacy
        $photoUrl = method_exists($peserta, 'getFirstMediaUrl')
            ? $peserta->getFirstMediaUrl('photo')
            : null;
        if (!$photoUrl) {
            $photoUrl = $peserta->foto_path; // fallback untuk data lama
        }
        // Avatar tidak lagi menggunakan konversi; gunakan foto asli
        $avatarUrl = $photoUrl;

        session([
            'registrasi' => [
                'id' => $peserta->id,
                'name' => $peserta->name,
                'slug' => $peserta->slug,
                'sekolah' => $peserta->sekolah,
                'jenjang' => $peserta->jenjang,
                'tingkatan_sd' => $peserta->tingkatan_sd,
                'provinsi' => $peserta->provinsi,
                'kota' => $peserta->kota,
                'nomor_whatsapp_orang_tua' => $peserta->nomor_whatsapp_orang_tua,
                'nomor_whatsapp_guru' => $peserta->nomor_whatsapp_guru,
                'email_guru' => $peserta->email_guru,
                'nisn' => $peserta->nisn,
                'foto_path' => $photoUrl,
                'foto_avatar_path' => $avatarUrl,
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
}
