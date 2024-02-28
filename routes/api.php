<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\AuthenticatedController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/{id}', [BrandController::class, 'show']);
    Route::get('/brands2/{id}', [BrandController::class, 'show2']);
    Route::post('/brands-store', [BrandController::class, 'store']);
    Route::patch('/brands/{id}', [BrandController::class, 'update'])->middleware('writer-post');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->middleware('writer-post');

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout', [AuthenticatedController::class, 'logout']);



    Route::get('/brands-me', [AuthenticatedController::class, 'me']);
});

Route::post('/brands-logins', [AuthenticatedController::class, 'login']);
