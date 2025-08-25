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
use App\Http\Controllers\AnnouncementMadrasahController;
use App\Http\Controllers\AnnouncementPondokController;
use App\Http\Controllers\AnnouncementSmpController;
use App\Http\Controllers\AssetBuktiPendaftaranController;
use App\Http\Controllers\EventMadrasahController;
use App\Http\Controllers\EventPondokController;
use App\Http\Controllers\EventSmpController;
use App\Http\Controllers\KontakUnitController;
use App\Http\Controllers\SosmedPondokController;
use App\Http\Controllers\ProgramPondokController;
use App\Http\Controllers\SosmedMadrasahController;
use App\Http\Controllers\ProgramMadrasahController;
use App\Http\Controllers\PrestasiMadrasahController;
use App\Http\Controllers\StafMadrasahController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

Route::get('ppdb', [PPDBController::class, 'home']);
Route::get('status', [PPDBController::class, 'status']);
Route::get('jadwal', [PPDBController::class, 'create_jadwal'])->name('jadwal.index');
Route::post('jadwalupdate', [PPDBController::class, 'jadwal'])->name('jadwal.store');

Route::get('/register', function () {
    return redirect('/login');
});

Route::get('/pendaftar/{id}/preview', [PPDBController::class, 'preview'])->name('pendaftar.preview');

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
Route::get('/landing/sekolah', [SekolahController::class, 'home'])->name('sekolah.home');
Route::get('/landing/madrasah', [MadrasahController::class, 'home'])->name('madrasah.home');
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
        Route::resource('event', EventController::class);
        Route::resource('pengumuman', AnnouncementController::class);

        Route::resource('kelolausers', UserController::class);

        Route::get('/manage', [WelcomeController::class, 'welcome'])->name('manage');
        Route::get('/manage/create', [WelcomeController::class, 'create'])->name('manage.create');
        Route::post('/manage/store', [WelcomeController::class, 'store'])->name('manage.store');

        Route::get('/kontakweb', [KontakController::class, 'create'])->name('kontakweb.create');
        Route::post('/kontakweb/store', [KontakController::class, 'store'])->name('kontakweb.store');
    });

    //kontak unit
    Route::resource('kontakunit', KontakUnitController::class);

    //master admin
    Route::middleware('role:master-admin')->group(function () {
        //program madrasah
        Route::get('/programmadrasah/approval', [ProgramMadrasahController::class, 'approval'])->name('programmadrasah.approval');
        Route::post('/programmadrasah/{id}/approve', [ProgramMadrasahController::class, 'approve'])->name('programmadrasah.approve');
        Route::post('/programmadrasah/{id}/reject', [ProgramMadrasahController::class, 'reject'])->name('programmadrasah.reject');
        Route::post('/programmadrasah/{id}/approve-delete', [ProgramMadrasahController::class, 'approveDelete'])->name('programmadrasah.approveDelete');
        Route::post('/programmadrasah/{id}/reject-delete', [ProgramMadrasahController::class, 'rejectDelete'])->name('programmadrasah.rejectDelete');

        //prestasi madrasah
        Route::get('/prestasimadrasah/approval', [PrestasiMadrasahController::class, 'approval'])->name('prestasimadrasah.approval');
        Route::post('/prestasimadrasah/{id}/approve', [PrestasiMadrasahController::class, 'approve'])->name('prestasimadrasah.approve');
        Route::post('/prestasimadrasah/{id}/reject', [PrestasiMadrasahController::class, 'reject'])->name('prestasimadrasah.reject');
        Route::post('/prestasimadrasah/{id}/approve-delete', [PrestasiMadrasahController::class, 'approveDelete'])->name('prestasimadrasah.approveDelete');
        Route::post('/prestasimadrasah/{id}/reject-delete', [PrestasiMadrasahController::class, 'rejectDelete'])->name('prestasimadrasah.rejectDelete');

        //staff madrasah
        Route::get('/stafmadrasah/approval', [StafMadrasahController::class, 'approval'])->name('stafmadrasah.approval');
        Route::post('/stafmadrasah/{id}/approve', [StafMadrasahController::class, 'approve'])->name('stafmadrasah.approve');
        Route::post('/stafmadrasah/{id}/reject', [StafMadrasahController::class, 'reject'])->name('stafmadrasah.reject');
        Route::post('/stafmadrasah/{id}/approve-delete', [StafMadrasahController::class, 'approveDelete'])->name('stafmadrasah.approveDelete');
        Route::post('/stafmadrasah/{id}/reject-delete', [StafMadrasahController::class, 'rejectDelete'])->name('stafmadrasah.rejectDelete');

        //acara mendatang madrasah
        Route::get('/eventmadrasah/approval', [EventMadrasahController::class, 'approval'])->name('eventmadrasah.approval');
        Route::post('/eventmadrasah/{id}/approve', [EventMadrasahController::class, 'approve'])->name('eventmadrasah.approve');
        Route::post('/eventmadrasah/{id}/reject', [EventMadrasahController::class, 'reject'])->name('eventmadrasah.reject');
        Route::post('/eventmadrasah/{id}/approve-delete', [EventMadrasahController::class, 'approveDelete'])->name('eventmadrasah.approveDelete');
        Route::post('/eventmadrasah/{id}/reject-delete', [EventMadrasahController::class, 'rejectDelete'])->name('eventmadrasah.rejectDelete');

        //announcement madrasah
        Route::get('/pengumumanmadrasah/approval', [AnnouncementMadrasahController::class, 'approval'])->name('pengumumanmadrasah.approval');
        Route::post('/pengumumanmadrasah/{id}/approve', [AnnouncementMadrasahController::class, 'approve'])->name('pengumumanmadrasah.approve');
        Route::post('/pengumumanmadrasah/{id}/reject', [AnnouncementMadrasahController::class, 'reject'])->name('pengumumanmadrasah.reject');
        Route::post('/pengumumanmadrasah/{id}/approve-delete', [AnnouncementMadrasahController::class, 'approveDelete'])->name('pengumumanmadrasah.approveDelete');
        Route::post('/pengumumanmadrasah/{id}/reject-delete', [AnnouncementMadrasahController::class, 'rejectDelete'])->name('pengumumanmadrasah.rejectDelete');

        //staff smp
        Route::get('/staff/approval', [StafController::class, 'approval'])->name('staff.approval');
        Route::post('/staff/{id}/approve', [StafController::class, 'approve'])->name('staff.approve');
        Route::post('/staff/{id}/reject', [StafController::class, 'reject'])->name('staff.reject');
        Route::post('/staff/{id}/approve-delete', [StafController::class, 'approveDelete'])->name('staff.approveDelete');
        Route::post('/staff/{id}/reject-delete', [StafController::class, 'rejectDelete'])->name('staff.rejectDelete');

        //ekstra smp
        Route::get('/ekstra/approval', [EkstraController::class, 'approval'])->name('ekstra.approval');
        Route::post('/ekstra/{id}/approve', [EkstraController::class, 'approve'])->name('ekstra.approve');
        Route::post('/ekstra/{id}/reject', [EkstraController::class, 'reject'])->name('ekstra.reject');
        Route::post('/ekstra/{id}/approve-delete', [EkstraController::class, 'approveDelete'])->name('ekstra.approveDelete');
        Route::post('/ekstra/{id}/reject-delete', [EkstraController::class, 'rejectDelete'])->name('ekstra.rejectDelete');

        //prestasi smp
        Route::get('/prestasi/approval', [PrestasiController::class, 'approval'])->name('prestasi.approval');
        Route::post('/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');
        Route::post('/prestasi/{id}/reject', [PrestasiController::class, 'reject'])->name('prestasi.reject');
        Route::post('/prestasi/{id}/approve-delete', [PrestasiController::class, 'approveDelete'])->name('prestasi.approveDelete');
        Route::post('/prestasi/{id}/reject-delete', [PrestasiController::class, 'rejectDelete'])->name('prestasi.rejectDelete');

        //event smp
        Route::get('/eventsmp/approval', [EventSmpController::class, 'approval'])->name('eventsmp.approval');
        Route::post('/eventsmp/{id}/approve', [EventSmpController::class, 'approve'])->name('eventsmp.approve');
        Route::post('/eventsmp/{id}/reject', [EventSmpController::class, 'reject'])->name('eventsmp.reject');
        Route::post('/eventsmp/{id}/approve-delete', [EventSmpController::class, 'approveDelete'])->name('eventsmp.approveDelete');
        Route::post('/eventsmp/{id}/reject-delete', [EventSmpController::class, 'rejectDelete'])->name('eventsmp.rejectDelete');

        //pengumuman smp
        Route::get('/pengumumansmp/approval', [AnnouncementSmpController::class, 'approval'])->name('pengumumansmp.approval');
        Route::post('/pengumumansmp/{id}/approve', [AnnouncementSmpController::class, 'approve'])->name('pengumumansmp.approve');
        Route::post('/pengumumansmp/{id}/reject', [AnnouncementSmpController::class, 'reject'])->name('pengumumansmp.reject');
        Route::post('/pengumumansmp/{id}/approve-delete', [AnnouncementSmpController::class, 'approveDelete'])->name('pengumumansmp.approveDelete');
        Route::post('/pengumumansmp/{id}/reject-delete', [AnnouncementSmpController::class, 'rejectDelete'])->name('pengumumansmp.rejectDelete');
    });

    //staff aka smp
    Route::middleware('role:staff|admin|master-admin,web')->group(function () {
        Route::resource('staff', StafController::class);
        Route::resource('sekolah', SekolahController::class);
        Route::resource('ekstra', EkstraController::class);
        Route::resource('prestasi', PrestasiController::class);
        Route::resource('sosmedsmp', SosmedSmpController::class);
        Route::resource('kepsek', KepsekController::class);
        Route::resource('eventsmp', EventSmpController::class);
        Route::resource('pengumumansmp', AnnouncementSmpController::class);
    });

    //madrasah
    Route::middleware('role:madrasah|admin|master-admin,web')->group(function () {
        Route::resource('sosmedmadrasah', SosmedMadrasahController::class);
        Route::resource('madrasah', MadrasahController::class);
        Route::resource('programmadrasah', ProgramMadrasahController::class);
        Route::resource('prestasimadrasah', PrestasiMadrasahController::class);
        Route::resource('eventmadrasah', EventMadrasahController::class);
        Route::resource('pengumumanmadrasah', AnnouncementMadrasahController::class);
        Route::resource('stafmadrasah', StafMadrasahController::class);
    });

    //pondok
    Route::middleware('role:pondok|admin|master-admin,web')->group(function () {
        Route::resource('pondok', PondokController::class);
        Route::resource('sosmedpondok', SosmedPondokController::class);
        Route::resource('kegiatanpondok', KegiatanController::class);
        Route::get('pondok/program', [PondokController::class, 'createprogram'])->name('program.pondok');
        Route::resource('pengasuh', PengasuhController::class);
        Route::resource('programpondok', ProgramPondokController::class);
        Route::resource('itemprogrampondok', ItemProgramController::class);
        Route::resource('eventpondok', EventPondokController::class);
        Route::resource('pengumumanpondok', AnnouncementPondokController::class);
    });

    //ppdb
    Route::middleware('role:ppdb|admin,web')->group(function () {
        Route::get('/export-pendaftar', function () {
            return Excel::download(new PendaftarExport, 'pendaftar.xlsx');
        });
        Route::resource('sakit', SakitController::class);
        Route::resource('saudara', RsaudaraController::class);
        Route::resource('pendaftar', PendaftarController::class);

        Route::resource('assetbukti', AssetBuktiPendaftaranController::class);

        Route::get('admin/{pendaftar}/download', [PendaftarController::class, 'download'])->name('admin.download');
        Route::put('/pendaftar/{pendaftar}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
        Route::get('pendaftar/{pendaftar}/download', [PendaftarController::class, 'download'])->name('pendaftar.download');
        Route::put('pendaftar/{pendaftar}/siswa', [PendaftarController::class, 'updateStatusSiswa'])->name('pendaftar.updateStatusSiswa');
    });
});

require __DIR__ . '/auth.php';
