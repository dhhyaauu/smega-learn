<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterDataController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/bk/dashboard', function () {
    return view('bk.dashboard');
})->name('bk.dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/master-data', [MasterDataController::class, 'index'])->name('admin.master-data');
    Route::post('/import-excel', [MasterDataController::class, 'importExcel'])->name('admin.import-excel');
});