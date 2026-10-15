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
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logout-all', [AuthController::class, 'logoutAll']);

    Route::apiResource('genres', GenreController::class)
        ->whereNumber('genre');

    Route::apiResource('books', BookController::class)
        ->except('destroy')
        ->whereNumber('book');

    // deleting a book demands a token that was explicitly allowed to do it
    Route::delete('books/{id}', [BookController::class, 'destroy'])
        ->middleware('abilities:books:delete')
        ->whereNumber('id');
});
