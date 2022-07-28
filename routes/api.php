<?php

// use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\JenisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{buku}', [BukuController::class, 'detail']);
Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
Route::post('/buku', [BukuController::class, 'store']);
Route::patch('/buku/{buku}', [BukuController::class, 'update']);

Route::get('/jenis', [JenisController::class, 'index']);
Route::get('/jenis/{jenis}', [JenisController::class, 'show']);
Route::delete('/jenis/{jenis}', [JenisController::class, 'destroy']);
Route::post('/jenis', [JenisController::class, 'store']);
Route::patch('/jenis/{jenis}', [JenisController::class, 'update']);

Route::get('password', function (){
    return bcrypt('rahasia');
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});