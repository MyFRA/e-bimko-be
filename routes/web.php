<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panel\ArticleCategoryController;
use App\Http\Controllers\Panel\ArticleController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\DiagnosticController;
use App\Http\Controllers\Panel\StudentController;
use App\Http\Controllers\Panel\SuggestionBoxController;
use App\Http\Controllers\Panel\TeacherController;
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
        Route::group([
            'prefix' => '/article-categories'
        ], function () {
            Route::get('/', [ArticleCategoryController::class, 'index']);
            Route::get('/{id}/edit', [ArticleCategoryController::class, 'edit']);
            Route::put('/{id}', [ArticleCategoryController::class, 'update']);
        });
        Route::group([
            'prefix' => '/articles'
        ], function () {
            Route::get('/', [ArticleController::class, 'index']);
            Route::get('/create', [ArticleController::class, 'create']);
            Route::post('/', [ArticleController::class, 'store']);
            Route::get('/{id}/edit', [ArticleController::class, 'edit']);
            Route::put('/{id}', [ArticleController::class, 'update']);
            Route::delete('/{id}', [ArticleController::class, 'destroy']);
        });
        Route::group([
            'prefix' => 'teachers'
        ], function () {
            Route::get('/', [TeacherController::class, 'index']);
            Route::get('/create', [TeacherController::class, 'create']);
            Route::post('/', [TeacherController::class, 'store']);
            Route::get('/{id}/edit', [TeacherController::class, 'edit']);
            Route::put('/{id}', [TeacherController::class, 'update']);
            Route::delete('/{id}', [TeacherController::class, 'destroy']);
        });
        Route::group([
            'prefix' => 'students'
        ], function () {
            Route::get('/', [StudentController::class, 'index']);
            Route::get('/create', [StudentController::class, 'create']);
            Route::post('/', [StudentController::class, 'store']);
            Route::get('/{id}/edit', [StudentController::class, 'edit']);
            Route::put('/{id}', [StudentController::class, 'update']);
            Route::delete('/{id}', [StudentController::class, 'destroy']);
        });
        Route::group([
            'prefix' => 'suggestion-boxes'
        ], function () {
            Route::get('/', [SuggestionBoxController::class, 'index']);
            Route::get('/{id}', [SuggestionBoxController::class, 'show']);
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
