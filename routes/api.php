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
    Route::get('/desa/{id}/potency', [MapController::class, 'mapPotencyByDesaId'])->name('desa.potency');
    Route::get('/desa/{id}/wisata', [MapController::class, 'mapWisataByDesaId'])->name('desa.wisata');
    Route::get('/potency', [MapController::class, 'mapPotency'])->name('potency');
    Route::get('/potency/search', [MapController::class, 'mapSearch'])->name('potency.search');
    Route::get('/potency/{id}', [MapController::class, 'mapPotencyById'])->name('potency.id');
});
