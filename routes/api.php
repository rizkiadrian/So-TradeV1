<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\InfoController;
use App\Http\Controllers\api\v1\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::get('/info', [InfoController::class, 'show']);
    Route::get('/test-success-response', [InfoController::class, 'testSuccessResponse']);
    Route::get('/test-fail-response', [InfoController::class, 'testFailResponse']);

    // Admin Authentication routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/test-protected-route', [InfoController::class, 'testProtectedRoute']);
    });

});
