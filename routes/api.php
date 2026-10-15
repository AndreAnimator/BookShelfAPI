<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Support\Facades\Route;

// public: this is where a client gets its very first token
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->middleware('throttle:6,1');

// protected by Sanctum; this module calls these routes with Bearer tokens
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('genres', GenreController::class)
        ->whereNumber('genre');

    Route::apiResource('books', BookController::class)
        ->whereNumber('book');
});
