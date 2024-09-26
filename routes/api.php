<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkApplicationController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\MyApplicationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('works', WorkController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/work/{work}/application', [WorkApplicationController::class, 'store']);
    Route::get('/my-applications', [MyApplicationsController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
