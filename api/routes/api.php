<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// admin auth
Route::controller(AuthController::class)->prefix("/admin/auth")->group(function () {
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgot_password');
    Route::post('/reset-password', 'reset_password');
});

// admin
Route::prefix("/admin")->group(function () {
    Route::get('/user', [AuthController::class,"user"]);
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

