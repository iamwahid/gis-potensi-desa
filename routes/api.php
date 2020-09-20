<?php

use App\Http\Controllers\Api\MapController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'map', 'as' => 'api.map.'], function () {
    Route::get('/desa', [MapController::class, 'mapDesa'])->name('desa');
    Route::get('/desa/{id}', [MapController::class, 'mapDesaById'])->name('desa.id');
    Route::get('/kec/{id}', [MapController::class, 'mapDesaByKecId'])->name('kec.id');
    Route::get('/desa/{id}/produk', [MapController::class, 'mapProdukByDesaId'])->name('desa.produk');
    Route::get('/desa/{id}/wisata', [MapController::class, 'mapWisataByDesaId'])->name('desa.wisata');
    Route::get('/produk', [MapController::class, 'mapProduk'])->name('produk');
    Route::get('/produk/{id}', [MapController::class, 'mapProdukById'])->name('produk.id');
    Route::get('/wisata', [MapController::class, 'mapWisata'])->name('wisata');
    Route::get('/wisata/{id}', [MapController::class, 'mapWisataById'])->name('wisata.id');
});
