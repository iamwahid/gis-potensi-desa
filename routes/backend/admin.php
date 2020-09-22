<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DesaController;
use App\Http\Controllers\Backend\KecamatanController;
use App\Http\Controllers\Backend\PotencyController;
use App\Http\Controllers\Backend\WisataController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'desa', 'as' => 'desa.'], function () {
    Route::get('', [DesaController::class, 'index'])->name('index');
    Route::get('/create', [DesaController::class, 'create'])->name('create');
    Route::post('', [DesaController::class, 'store'])->name('store');

    Route::group(['prefix' => 'potency', 'as' => 'potency.'], function () {
      Route::group(['prefix' => '{potency}'], function () {
        Route::get('', [DesaController::class, 'potencyDesaShow'])->name('show');
        Route::get('/edit', [DesaController::class, 'potencyDesaEdit'])->name('edit');
        Route::post('', [DesaController::class, 'potencyDesaEdit'])->name('update');
        Route::delete('', [DesaController::class, 'potencyDesaDestroy'])->name('destroy');
      });
    });

    Route::group(['prefix' => '{desa}'], function () {
      Route::group(['prefix' => 'potency', 'as' => 'potency.'], function () {
        Route::get('', [DesaController::class, 'potencyDesaAll'])->name('index');
        Route::get('/create', [DesaController::class, 'potencyDesaCreate'])->name('create');
        Route::post('', [DesaController::class, 'potencyDesaStore'])->name('store');
      });

      Route::get('', [DesaController::class, 'show'])->name('show');
      Route::get('/edit', [DesaController::class, 'edit'])->name('edit');
      Route::post('', [DesaController::class, 'update'])->name('update');
      Route::delete('', [DesaController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => 'kecamatan', 'as' => 'kecamatan.'], function () {
  Route::get('', [KecamatanController::class, 'index'])->name('index');
  Route::get('/create', [KecamatanController::class, 'create'])->name('create');
  Route::post('', [KecamatanController::class, 'store'])->name('store');
  Route::group(['prefix' => '{kecamatan}'], function () {
    Route::get('', [KecamatanController::class, 'show'])->name('show');
    Route::get('/edit', [KecamatanController::class, 'edit'])->name('edit');
    Route::post('', [KecamatanController::class, 'update'])->name('update');
    Route::delete('', [KecamatanController::class, 'destroy'])->name('destroy');
  });
});