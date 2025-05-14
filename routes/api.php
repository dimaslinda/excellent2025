<?php

use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\Models\City;

Route::get('/cities/{province}', function ($province) {
    return City::where('province_code', $province)
        ->orderBy('name')
        ->get(['code as id', 'name']);
})->name('api.cities');
