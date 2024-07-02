<?php

use App\Http\Controllers\Api\Mobile\ArticleCategoryController;
use App\Http\Controllers\Api\Mobile\ArticleController;
use App\Http\Controllers\Api\Mobile\DiagnosticController;
use App\Http\Controllers\Api\Mobile\LoginController;
use App\Http\Controllers\Api\Mobile\ProfileController;
use App\Http\Controllers\Api\Mobile\TeacherController;
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

    Route::group([
        'prefix' => 'diagnostics'
    ], function () {
        Route::get('/', [DiagnosticController::class, 'get']);
    });

    Route::group([
        'prefix' => 'teachers'
    ], function () {
        Route::get('/', [TeacherController::class, 'get']);
    });

    Route::group([
        'prefix' => 'article-categories'
    ], function () {
        Route::get('/', [ArticleCategoryController::class, 'get']);
    });

    Route::group([
        'prefix' => 'articles'
    ], function () {
        Route::get('/', [ArticleController::class, 'getAllByArticleCategoryId']);
    });
});
