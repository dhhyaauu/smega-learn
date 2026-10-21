<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MasterDataController;
use Illuminate\Support\Facades\Route;

// Landing page (publik)
Route::get('/', function () {
    return view('welcome');
});

// ============================================
// ROUTE ADMIN
// ============================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/master-data', [MasterDataController::class, 'index'])->name('master-data');
    Route::post('/import-excel', [MasterDataController::class, 'importExcel'])->name('import-excel');
    Route::get('/import-excel', fn() => redirect()->route('admin.master-data'))->name('import-excel.get');
});

// ============================================
// ROUTE GURU BK
// ============================================
Route::middleware(['auth', 'role:guru_bk'])->prefix('bk')->name('bk.')->group(function () {
    Route::get('/dashboard', function () {
        return view('bk.dashboard');
    })->name('dashboard');
});

Route::get('/bk/kehadiran', function () {
    return view('bk.kehadiran');
})->name('bk.kehadiran');

Route::get('/bk/data-siswa', function () {
    return view('bk.data-siswa');
})->name('bk.data-siswa');

Route::get('/bk/riwayat-presensi', function () {
    return view('bk.riwayat-presensi');
})->name('bk.riwayat-presensi');

Route::get('/bk/tren-kehadiran', function () {
    return view('bk.tren-kehadiran');
})->name('bk.tren-kehadiran');

Route::get('/bk/tindak-lanjut', function () {
    return view('bk.tindak-lanjut');
})->name('bk.tindak-lanjut');

Route::get('/bk/laporan', function () {
    return view('bk.laporan');
})->name('bk.laporan');

// ============================================
// ROUTE SISWA
// ============================================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard');
});

// ============================================
// PROFILE (dari Breeze, semua role bisa akses)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
