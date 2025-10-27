<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SurahController;
use App\Http\Controllers\Api\AyatController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/surahs', [SurahController::class, 'index']);
Route::get('/surahs/{id}', [SurahController::class, 'show']);

Route::get('/ayats', [AyatController::class, 'index']);
Route::get('/ayats/by-surah/{surah_id}', [AyatController::class, 'getBySurah']);

Route::post('/ayats/{ayat_id}/tags', [AyatController::class, 'addKeywords']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
