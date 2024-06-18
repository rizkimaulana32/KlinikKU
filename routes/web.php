<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('dashboard');
})->middleware('guest')->name('dashboard');

Route::middleware(['auth', 'userAkses:pasien'])->group(function () {
    Route::get('/pasien/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
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
});
