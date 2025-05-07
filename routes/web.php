<?php

use App\Http\Controllers\GeneralControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeneralControllers::class, 'index'])->name('beranda');
Route::get('/inhouse', [GeneralControllers::class, 'inhouse'])->name('inhouse');
Route::get('/modul', [GeneralControllers::class, 'modul'])->name('modul');
Route::get('/webinar', [GeneralControllers::class, 'webinar'])->name('webinar');
Route::get('/ecourse', [GeneralControllers::class, 'ecourse'])->name('ecourse');
Route::get('/bootcamp', [GeneralControllers::class, 'bootcamp'])->name('bootcamp');
Route::get('/eskul', [GeneralControllers::class, 'eskul'])->name('eskul');
Route::get('/galeri', [GeneralControllers::class, 'galeri'])->name('galeri');
Route::get('/registrasi', [GeneralControllers::class, 'registrasi'])->name('registrasi');
