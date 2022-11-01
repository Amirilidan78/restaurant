<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// user auth
Route::controller(AuthController::class)->prefix("auth")->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/user', 'user');
});


Route::middleware("auth-jwt")->group(function () {

    // product
    Route::controller(ProductController::class)->prefix("product")->group(function () {
        Route::get('/index', 'index');
    });

});

