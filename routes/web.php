<?php

use App\Exports\PendaftarExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SakitController;
use App\Http\Controllers\EkstraController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PondokController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MadrasahController;
use App\Http\Controllers\PengasuhController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RsaudaraController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SosmedSmpController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ItemProgramController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SosmedPondokController;
use App\Http\Controllers\ProgramPondokController;
use App\Http\Controllers\SosmedMadrasahController;
use App\Http\Controllers\ProgramMadrasahController;
use App\Http\Controllers\PrestasiMadrasahController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

Route::get('/staffpage', function () {
    return view('staffpage');
})->name('staffpage');

Route::get('/icons', function () {
    $path = public_path('icons.json');

    if (!File::exists($path)) {
        return response()->json([], 404);
    }

    $icons = json_decode(File::get($path), true);
    $query = strtolower(request('q', ''));
    $page = request()->get('page', 1);
    $perPage = request()->get('perPage', 100);

    if ($query) {
        $icons = array_filter($icons, function ($icon) use ($query) {
            return str_contains(strtolower($icon), $query);
        });
        $icons = array_values($icons); // Reset index
    }

    $sliced = array_slice($icons, ($page - 1) * $perPage, $perPage);
    $hasMore = count($icons) > $page * $perPage;

    return response()->json([
        'icons' => $sliced,
        'hasMore' => $hasMore,
        'nextPage' => $hasMore ? $page + 1 : null
    ]);
});

//diakses user
Route::get('/formppdb', [PPDBController::class, 'create'])->name('ppdb.create');
Route::post('/formppdb', [PPDBController::class, 'store'])->name('ppdb.store');
Route::get('/pendaftaran/sukses/{id}', [PPDBController::class, 'success'])->name('pendaftar.success');
Route::get('formppdb/{pendaftar}/download', [PPDBController::class, 'download'])->name('ppdb.download');

//3-landing diakses user
Route::get('/landing/madrasah', [MadrasahController::class, 'home'])->name('madrasah.home');
Route::get('/landing/sekolah', [SekolahController::class, 'home'])->name('sekolah.home');
Route::get('/landing/pondok', [PondokController::class, 'home'])->name('pondok.home');

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

    //admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('sakit', SakitController::class);
        Route::resource('saudara', RsaudaraController::class);
        Route::resource('/event', EventController::class);
        Route::resource('/pengumuman', AnnouncementController::class);

        Route::resource('kelolausers', UserController::class);

        Route::get('/manage', [WelcomeController::class, 'welcome'])->name('manage');
        Route::get('/manage/create', [WelcomeController::class, 'create'])->name('manage.create');
        Route::post('/manage/store', [WelcomeController::class, 'store'])->name('manage.store');

        Route::get('/kontakweb', [KontakController::class, 'create'])->name('kontakweb.create');
        Route::post('/kontakweb/store', [KontakController::class, 'store'])->name('kontakweb.store');
    });

    //staff aka smp
    Route::middleware('role:staff')->group(function () {
        Route::resource('staff', StafController::class);
        Route::resource('sekolah', SekolahController::class);
        Route::resource('ekstra', EkstraController::class);
        Route::resource('prestasi', PrestasiController::class);
        Route::resource('sosmedsmp', SosmedSmpController::class);
        Route::resource('kepsek', KepsekController::class);
    });

    //madrasah
    Route::middleware('role:madrasah')->group(function () {
        Route::resource('sosmedmadrasah', SosmedMadrasahController::class);
        Route::resource('madrasah', MadrasahController::class);
        Route::resource('programmadrasah', ProgramMadrasahController::class);
        Route::resource('prestasimadrasah', PrestasiMadrasahController::class);
    });

    //pondok
    Route::middleware('role:pondok')->group(function () {
        Route::resource('sosmedpondok', SosmedPondokController::class);
        Route::resource('pondok', PondokController::class)->middleware('role:pondok');
        Route::resource('kegiatanpondok', KegiatanController::class);
        Route::get('pondok/program', [PondokController::class, 'createprogram'])->name('program.pondok');
        Route::resource('pengasuh', PengasuhController::class);
        Route::resource('programpondok', ProgramPondokController::class);
        Route::resource('itemprogrampondok', ItemProgramController::class);
    });

    //ppdb
    Route::middleware('role:ppdb')->group(function () {
        Route::get('/export-pendaftar', function () {
            return Excel::download(new PendaftarExport, 'pendaftar.xlsx');
        });
        Route::resource('sakit', SakitController::class);
        Route::resource('saudara', RsaudaraController::class);
        Route::resource('pendaftar', PendaftarController::class);
    });

    Route::put('/pendaftar/{pendaftar}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
    Route::get('pendaftar/{pendaftar}/download', [PendaftarController::class, 'download'])->name('pendaftar.download');
});

require __DIR__ . '/auth.php';
