<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RsaudaraController;
use App\Http\Controllers\SakitController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

Route::get('/staffpage', function () {
    return view('staffpage');
})->name('staffpage');

Route::get('pendaftar/{pendaftar}/download', [PendaftarController::class, 'download'])->name('pendaftar.download');

Route::redirect('/admin', 'dashboard');
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
    Route::resource('/staff', StafController::class);

    Route::resource('/event', EventController::class);
    Route::resource('/pengumuman', AnnouncementController::class);
    Route::resource('/galeri', GaleriController::class);

    Route::resource('/unit', UnitController::class);

    Route::get('/manage', [WelcomeController::class, 'welcome'])->name('manage');
    Route::get('/manage/create', [WelcomeController::class, 'create'])->name('manage.create');
    Route::post('/manage/store', [WelcomeController::class, 'store'])->name('manage.store');
});

require __DIR__ . '/auth.php';
