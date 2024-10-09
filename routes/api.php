<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\InfoController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ProfileController;
use App\Http\Middleware\CheckFinancialUser;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::get('/info', [InfoController::class, 'show']);
    Route::get('/test-success-response', [InfoController::class, 'testSuccessResponse']);
    Route::get('/test-fail-response', [InfoController::class, 'testFailResponse']);

    // Public Authentication routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/test-protected-route', [InfoController::class, 'testProtectedRoute']);
        Route::post('/profile/make', [ProfileController::class, 'profileCreate']);
        Route::post('/profile/employment-make', [ProfileController::class, 'employmentCreate']);
        Route::post('/profile/financial-make', [ProfileController::class, 'financialCreate']);
        Route::post('/profile/goal-make', [ProfileController::class, 'goalCreate']);
    });

    // Check financial user middleware
    Route::middleware(['auth:sanctum', CheckFinancialUser::class])->group(function(){
        Route::resource('profile', ProfileController::class)->only(['index']);
    });

});
