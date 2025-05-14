<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\GeneralControllers;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\Models\City;

Route::get('/', [GeneralControllers::class, 'index'])->name('beranda');
Route::get('/inhouse', [GeneralControllers::class, 'inhouse'])->name('inhouse');
Route::get('/modul', [GeneralControllers::class, 'modul'])->name('modul');
Route::get('/webinar', [GeneralControllers::class, 'webinar'])->name('webinar');
Route::get('/ecourse', [GeneralControllers::class, 'ecourse'])->name('ecourse');
Route::get('/bootcamp', [GeneralControllers::class, 'bootcamp'])->name('bootcamp');
Route::get('/eskul', [GeneralControllers::class, 'eskul'])->name('eskul');
Route::get('/galeri', [GeneralControllers::class, 'galeri'])->name('galeri');
Route::get('/registrasi', [GeneralControllers::class, 'registrasi'])->name('registrasi');
Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessment');
Route::get('/hasil', [AssessmentController::class, 'hasil'])->name('hasil');

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
