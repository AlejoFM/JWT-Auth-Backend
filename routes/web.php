<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('v1/admins', [\App\Http\Controllers\AdminController::class, 'index']);
Route::get('/token', function () {
    return csrf_token();
});

require __DIR__.'/auth.php';
