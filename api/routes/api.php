<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;


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

