<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SurahController;
use App\Http\Controllers\Api\AyatController;
use App\Http\Controllers\Api\KeywordController;
use App\Http\Controllers\Api\TagController;
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

Route::post('/keywords', [KeywordController::class, 'store']);

Route::get('/tags', [TagController::class, 'index']);

// Create a new tag
Route::post('/tags', [TagController::class, 'store']);

// Get a single tag
Route::get('/tags/{tag}', [TagController::class, 'show']);

// Update a tag
Route::put('/tags/{tag}', [TagController::class, 'update']);
Route::patch('/tags/{tag}', [TagController::class, 'update']); // optional, for partial updates

// Delete a tag
Route::delete('/tags/{tag}', [TagController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
