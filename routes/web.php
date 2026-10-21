<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Absensi — milik Orang 3 (backend engine absen)
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
| Tampilan Siswa — milik Orang 2 (akan digabung di commit berikutnya)
|--------------------------------------------------------------------------
*/
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/', function () { return view('student.dashboard'); })->name('dashboard');
    Route::get('/attendance', function () { return view('student.attendance'); })->name('attendance');
    Route::get('/history', function () { return view('student.history'); })->name('history');
    Route::get('/permission', function () { return view('student.permission'); })->name('permission');
});

require __DIR__.'/auth.php';
