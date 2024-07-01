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

Route::controller(GuruController::class)->group(function() {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::post('/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    Route::delete('/guru/delete/{id}', 'destroy')->name('guru.destory');
});


require __DIR__.'/auth.php';

