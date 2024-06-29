<?php

use App\Http\Controllers\Dokter\JadwalController;
use App\Http\Controllers\Dokter\JanjiTemuDokterController;
use App\Http\Controllers\Dokter\RekamMedisDokterController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\JadwalDokterController;
use App\Http\Controllers\Admin\JanjiTemuController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\RekamMedisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pasien\JadwalController as PasienJadwalController;
use App\Http\Controllers\Pasien\JanjiTemuController as PasienJanjiTemuController;
use App\Http\Controllers\Pasien\RekamMedisController as PasienRekamMedisController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [DashboardController::class, 'index'])->middleware('guest')->name('dashboard');
Route::get('/fetch-available-schedules/{doctor_id}/{date}', [DashboardController::class, 'fetchAvailableSchedules']);

Route::get('/status', function () {
    return view('pasien.status');
});

Route::get('/rekammedis', function () {
    return view('pasien.rekam');
});


Route::middleware(['auth', 'userAkses:pasien', 'web'])->group(function () {
    Route::get('/pasien/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::get('/pasien/home', function () {
        return view('pasien.home');
    });


    Route::get('/pasien/profile', function () {
        return view('pasien.profile');
    });

    Route::get('/pasien/dokter', [PasienJadwalController::class, 'index']);
    Route::get('/get-available-slots/{doctor}', [PasienJadwalController::class, 'getAvailableSlots']);
    Route::post('/pasien/janjitemu/{doctor_id}', [PasienJanjiTemuController::class, 'store']);
    Route::get('/pasien/janjitemu', [PasienJanjiTemuController::class, 'show']);
    Route::get('/pasien/rekammedis', [PasienRekamMedisController::class, 'index']);
});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/pasien', PasienController::class);
    Route::resource('/admin/dokter', DokterController::class);

    Route::get('admin/laporan', [LaporanController::class, 'index']);
    Route::post('admin/laporan/generate', [LaporanController::class, 'generate']);
    Route::get('admin/laporan/{startDate}/{endDate}/download', [LaporanController::class, 'download']);


    Route::get('/admin/list', [DokterController::class, 'list']);

    Route::get('/admin/list/{id}/jadwal', [JadwalDokterController::class, 'index']);
    Route::get('/admin/list/{id}/jadwal/create', [JadwalDokterController::class, 'create']);
    Route::post('/admin/list/{id}/jadwal', [JadwalDokterController::class, 'store']);
    Route::get('/admin/list/{id}/jadwal/{jadwal_id}/edit', [JadwalDokterController::class, 'edit']);
    Route::put('/admin/list/{id}/jadwal/{jadwal_id}', [JadwalDokterController::class, 'update']);
    Route::delete('/admin/list/{id}/jadwal/{jadwal_id}', [JadwalDokterController::class, 'destroy']);

    Route::get('/admin/list/{id}/janjitemu', [JanjiTemuController::class, 'index']);
    Route::get('/admin/list/{id}/janjitemu/{janjitemu_id}/edit', [JanjiTemuController::class, 'edit']);
    Route::put('/admin/list/{id}/janjitemu/{janjitemu_id}', [JanjiTemuController::class, 'update']);
    Route::get('/admin/list/{id}/available-slots', [JanjiTemuController::class, 'getAvailableSlots']);
    Route::delete('/admin/list/{id}/janjitemu/{janjitemu_id}', [JanjiTemuController::class, 'destroy']);

    Route::get('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis', [RekamMedisController::class, 'index']);
    Route::get('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis/create', [RekamMedisController::class, 'create']);
    Route::post('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis', [RekamMedisController::class, 'store']);
    Route::get('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis/{rekammedis_id}/edit', [RekamMedisController::class, 'edit']);
    Route::put('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis/{rekammedis_id}', [RekamMedisController::class, 'update']);
    Route::delete('/admin/list/{id}/janjitemu/{janjitemu_id}/rekammedis/{rekammedis_id}', [RekamMedisController::class, 'destroy']);
});

Route::middleware(['auth', 'userAkses:dokter'])->group(function () {
    Route::get('/dokter/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::resource('/dokter/jadwal', JadwalController::class);
    Route::resource('/dokter/janjitemu', JanjiTemuDokterController::class);
    Route::get('/dokter/available-slots', [JanjiTemuDokterController::class, 'getAvailableSlots']);

    Route::resource('/dokter/janjitemu/{janjitemu_id}/rekammedis', RekamMedisDokterController::class);
});
