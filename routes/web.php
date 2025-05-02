<?php

use App\Http\Controllers\GeneralControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeneralControllers::class, 'index']);
