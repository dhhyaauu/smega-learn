<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\HistoryController;
use App\Http\Controllers\Student\LeaveRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Absensi backend — milik Orang 3
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::post('/absen/datang', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
    Route::post('/absen/pulang', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Area Admin — pengaturan GPS & jam presensi (Orang 2)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/gps', [App\Http\Controllers\Admin\SchoolSettingController::class, 'edit'])
        ->name('settings.gps');
    Route::put('/settings/gps', [App\Http\Controllers\Admin\SchoolSettingController::class, 'update'])
        ->name('settings.gps.update');
});

/*
|--------------------------------------------------------------------------
| Tampilan Siswa — Orang 2 (pakai controller lengkap)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('attendance');
    Route::post('/attendance/check-in', [StudentAttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/check-out', [StudentAttendanceController::class, 'checkOut'])->name('attendance.checkout');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/permission', [LeaveRequestController::class, 'index'])->name('permission');
    Route::post('/permission', [LeaveRequestController::class, 'store'])->name('permission.store');
});

require __DIR__.'/auth.php';
