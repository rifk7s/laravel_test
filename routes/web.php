<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\GalleryController;

// gallery page | after next.
Route::get('/gallery-page', [GalleryController::class, 'index'])->name('gallery');
