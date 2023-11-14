<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/register', [TokenController::class, 'register']);
    Route::post('/login', [TokenController::class, 'login']);
    Route::post('/logout', [TokenController::class, 'logout']);
    Route::post('/refresh', [TokenController::class, 'refresh']);
    Route::get('/user-profile', [TokenController::class, 'userProfile']);
    Route::post('/change_password', [TokenController::class, 'change_password']);

    Route::get('/test', function () {
        return "Hola";
    })->middleware('auth.jwt');

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/category', [CategoryController::class, 'index']);
    Route::get('/projects/{id}/', [ProjectController::class, 'show']);

    Route::post('/projects/category', [CategoryController::class, 'create']);
    Route::post('/projects', [ProjectController::class, 'create']);


});

