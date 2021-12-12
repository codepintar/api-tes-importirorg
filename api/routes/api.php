<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangInoutController;
use App\Http\Controllers\LaporanController;

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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

//Kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori_create', [KategoriController::class, 'create']);
Route::post('/kategori_update', [KategoriController::class, 'update']);
Route::post('/kategori_delete', [KategoriController::class, 'delete']);

//Barang
Route::post('/barang', [BarangController::class, 'index']);
Route::post('/barang_create', [BarangController::class, 'create']);
Route::post('/barang_update', [BarangController::class, 'update']);
Route::post('/barang_delete', [BarangController::class, 'delete']);
Route::get('/barang_detail/{id}', [BarangController::class, 'detail']);

//Barang InOut
Route::post('/barang_in_data', [BarangInoutController::class, 'in_data']);
Route::post('/barang_in_create', [BarangInoutController::class, 'in_create']);
Route::post('/barang_out_create', [BarangInoutController::class, 'out_create']);
Route::post('/barang_out_data', [BarangInoutController::class, 'out_data']);
Route::post('/barang_inout_update', [BarangInoutController::class, 'inout_update']);
Route::post('/barang_inout_delete', [BarangInoutController::class, 'inout_delete']);

//Laporan Stok
Route::post('/laporan_stok_harian', [LaporanController::class, 'stok_harian']);