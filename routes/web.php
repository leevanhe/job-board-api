<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\MyWorkController;
use App\Http\Controllers\MyWorkApplicationController;
use App\Http\Controllers\WorkApplicationController;
use App\Http\Controllers\WorkController;
use App\Models\Employer;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('works.index'));

Route::resource('auth', AuthController::class)->only(['create', 'store']);

Route::get('login', fn() => to_route('auth.create'))->name('login');

Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::resource('works', WorkController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('work.application', WorkApplicationController::class)->only(['create', 'store']);

    Route::resource('my-work-applications', MyWorkApplicationController::class)->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)->only(['create', 'store']);

    Route::middleware('employer')->resource('my-works', MyWorkController::class);
});
