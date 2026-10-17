<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.mahasiswa.index');
});

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.mahasiswa.index');
        });

        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('mata-kuliah', MataKuliahController::class);
    });
