<?php

use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RsaudaraController;
use App\Http\Controllers\SakitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('sakit', SakitController::class);
    Route::resource('saudara', RsaudaraController::class);
    Route::resource('pendaftar', PendaftarController::class);

    Route::get('pendaftar/{pendaftar}/download', [PendaftarController::class, 'download'])->name('pendaftar.download');
});

require __DIR__ . '/auth.php';
