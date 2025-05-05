<?php

use App\Http\Controllers\GeneralControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeneralControllers::class, 'index'])->name('beranda');
Route::get('/inhouse', [GeneralControllers::class, 'inhouse'])->name('inhouse');
Route::get('/modul', [GeneralControllers::class, 'modul'])->name('modul');
Route::get('/webinar', [GeneralControllers::class, 'webinar'])->name('webinar');
