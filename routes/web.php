<?php

use App\Http\Controllers\DataPrestasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TendikController;

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

Route::controller(TendikController::class)->group(function () {
    Route::get('/tendik', 'index')->name('tendik.index');
    Route::get('/tendik/create', 'create')->name('tendik.create');
    Route::get('/tendik/edit/{id}', 'edit')->name('tendik.edit');
    Route::post('/tendik/create/data', 'store')->name('tendik.store');
    Route::delete('/tendik/delete/{id}', 'destroy')->name('tendik.destory');
    Route::post('/tendik/update/{id}', [TendikController::class, 'update'])->name('tendik.update');

});

Route::controller(DataPrestasiController::class)->group(function() {
    Route::get('/dataPrestasi', 'index')->name('prestasi.index');
    Route::get('/prestasi/create', 'create')->name('prestasi.create');
    Route::post('/prestasi/create/data', 'store')->name('prestasi.store');
    Route::get('/prestasi/edit/{id}', 'edit')->name('prestasi.edit');
});

require __DIR__.'/auth.php';

