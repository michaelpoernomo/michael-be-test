<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::get('/kendaraan/terjual', [KendaraanController::class, 'terjual']);
    Route::get('/kendaraan/tersedia', [KendaraanController::class, 'tersedia']);
    Route::get('/penjualan/{jenis}', [KendaraanController::class, 'penjualan']);
    Route::post('/kendaraan/tambah', [KendaraanController::class, 'tambah']);
    Route::delete('/kendaraan/hapus/semua', [KendaraanController::class, 'hapusSemua']);
});
