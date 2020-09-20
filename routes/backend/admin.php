<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DesaController;
use App\Http\Controllers\Backend\KecamatanController;
use App\Http\Controllers\Backend\ProdukController;
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

    Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
      Route::group(['prefix' => '{produk}'], function () {
        Route::get('', [DesaController::class, 'produkDesaShow'])->name('show');
        Route::get('/edit', [DesaController::class, 'produkDesaEdit'])->name('edit');
        Route::post('', [DesaController::class, 'produkDesaEdit'])->name('update');
        Route::delete('', [DesaController::class, 'produkDesaDestroy'])->name('destroy');
      });
    });

    Route::group(['prefix' => '{desa}'], function () {
      Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
        Route::get('', [DesaController::class, 'produkDesaAll'])->name('index');
        Route::get('/create', [DesaController::class, 'produkDesaCreate'])->name('create');
        Route::post('', [DesaController::class, 'produkDesaStore'])->name('store');
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

Route::group(['prefix' => 'wisata', 'as' => 'wisata.'], function () {
  Route::get('', [WisataController::class, 'index'])->name('index');
  Route::get('/create', [WisataController::class, 'create'])->name('create');
  Route::post('', [WisataController::class, 'store'])->name('store');
  Route::group(['prefix' => '{wisata}'], function () {
    Route::get('', [WisataController::class, 'show'])->name('show');
    Route::get('/edit', [WisataController::class, 'edit'])->name('edit');
    Route::post('', [WisataController::class, 'update'])->name('update');
    Route::delete('', [WisataController::class, 'destroy'])->name('destroy');
  });
});