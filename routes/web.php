<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';

Route::controller(GuruController::class)->group(function() {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    // Route::get('/guru/add', 'add')->name('guru.add');
});
