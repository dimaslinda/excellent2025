<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\GeneralControllers;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\Models\City;

Route::get('/', [GeneralControllers::class, 'index'])->name('beranda');
Route::get('/inhouse', [GeneralControllers::class, 'inhouse'])->name('inhouse');
Route::get('/modul', [GeneralControllers::class, 'modul'])->name('modul');
Route::get('/ebook', [GeneralControllers::class, 'ebook'])->name('ebook');
Route::get('/ebook/{ebook}', [GeneralControllers::class, 'showEbookDetail'])->name('ebook.detail');
Route::get('/ebook/{ebook}/download', [GeneralControllers::class, 'downloadEbook'])->name('ebook.download');
Route::get('/webinar', [GeneralControllers::class, 'webinar'])->name('webinar');
Route::get('/ecourse', [GeneralControllers::class, 'ecourse'])->name('ecourse');
Route::get('/bootcamp', [GeneralControllers::class, 'bootcamp'])->name('bootcamp');
Route::get('/eskul', [GeneralControllers::class, 'eskul'])->name('eskul');
Route::get('/galeri', [GeneralControllers::class, 'galeri'])->name('galeri');
// Alur assessment: pilih jenjang -> registrasi -> soal -> hasil
Route::get('/assessment/jenjang', [AssessmentController::class, 'jenjang'])->name('assessment.jenjang');
Route::post('/assessment/jenjang', [AssessmentController::class, 'storeJenjang'])->name('assessment.jenjang.store');
Route::get('/registrasi', [GeneralControllers::class, 'registrasi'])->name('registrasi');
Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessment');
Route::post('/assessment/hasil', [AssessmentController::class, 'hasil'])->name('assessment.hasil');
// (Dihapus) Submit Minat per langkah — kini submit akhir digabung

// Route untuk menampilkan hasil quiz (GET)
Route::get('/assessment/hasil', [AssessmentController::class, 'showHasil'])->name('assessment.hasil.show');

// Unduh hasil sebagai PDF
Route::get('/assessment/hasil/download', [AssessmentController::class, 'downloadHasil'])->name('assessment.hasil.download');

// Route untuk mengambil data kota
Route::get('/api/cities/{province}', function ($province) {
    try {
        $cities = City::where('province_code', $province)
            ->orderBy('name')
            ->get(['code as id', 'name']);
        return response()->json($cities);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
