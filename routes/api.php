<?php

use App\Http\Controllers\Api\Mobile\LoginController;
use App\Http\Controllers\Api\Mobile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'mobile'
], function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/user', [LoginController::class, 'getCurrentUser']);
    });

    Route::group([
        'middleware' => ['api.mobile.auth-student']
    ], function () {
        Route::group([
            'prefix' => 'profile'
        ], function () {
            Route::post('update-profile-picture', [ProfileController::class, 'updateProfilePicture']);
        });
    });
});
