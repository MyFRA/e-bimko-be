<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\DiagnosticController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/panel'
], function () {

    Route::group([
        'prefix' => '/auth'
    ], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout']);
    });

    Route::group([
        'middleware' => ['web.auth-admin']
    ], function () {
        Route::group([
            'prefix' => '/dashboard'
        ], function () {
            Route::get('/', [DashboardController::class, 'index']);
        });
        Route::group([
            'prefix' => '/diagnostics'
        ], function () {
            Route::get('/', [DiagnosticController::class, 'index']);
            Route::get('/{id}/edit', [DiagnosticController::class, 'edit']);
            Route::put('/{id}', [DiagnosticController::class, 'update']);
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
