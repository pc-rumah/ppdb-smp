<?php

use App\Exports\PendaftarExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SakitController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RsaudaraController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\KeunggulanController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

Route::get('/staffpage', function () {
    return view('staffpage');
})->name('staffpage');

Route::get('/formppdb', [PPDBController::class, 'create'])->name('ppdb.create');
Route::post('/formppdb', [PPDBController::class, 'store'])->name('ppdb.store');
Route::get('/pendaftaran/sukses/{id}', [PPDBController::class, 'success'])->name('pendaftar.success');
Route::get('formppdb/{pendaftar}/download', [PPDBController::class, 'download'])->name('ppdb.download');


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
    Route::resource('/staff', StafController::class);

    //export excel
    Route::get('/export-pendaftar', function () {
        return Excel::download(new PendaftarExport, 'pendaftar.xlsx');
    });

    Route::resource('pendaftar', PendaftarController::class);
    Route::put('/pendaftar/{pendaftar}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
    Route::get('pendaftar/{pendaftar}/download', [PendaftarController::class, 'download'])->name('pendaftar.download');

    Route::resource('/event', EventController::class);
    Route::resource('/pengumuman', AnnouncementController::class);
    Route::resource('/galeri', GaleriController::class);

    Route::resource('/unit', UnitController::class);
    Route::resource('/fasilitas', FasilitasController::class)->parameters(['fasilitas' => 'fasilitas']);
    Route::resource('/keunggulan', KeunggulanController::class);

    Route::get('/manage', [WelcomeController::class, 'welcome'])->name('manage');
    Route::get('/manage/create', [WelcomeController::class, 'create'])->name('manage.create');
    Route::post('/manage/store', [WelcomeController::class, 'store'])->name('manage.store');

    Route::get('/kontakweb', [KontakController::class, 'create'])->name('kontakweb.create');
    Route::post('/kontakweb/store', [KontakController::class, 'store'])->name('kontakweb.store');
});

require __DIR__ . '/auth.php';
