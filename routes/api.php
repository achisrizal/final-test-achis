<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FAQController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('blogs')->group(function () {
        Route::get('/all', [BlogController::class, 'all']);
        Route::get('/{blog}', [BlogController::class, 'show']);
        Route::post('create', [BlogController::class, 'store']);
        Route::put('/{blog}', [BlogController::class, 'update']);
        Route::delete('/{blog}', [BlogController::class, 'destroy']);
    });
});

Route::get('faqs', [FAQController::class, 'index']);

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
});
