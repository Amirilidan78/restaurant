<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// admin auth
Route::controller(AuthController::class)->prefix("/auth")->group(function () {
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgot_password');
    Route::post('/reset-password', 'reset_password');
});


Route::middleware("auth-admin")->group(function () {

    Route::get('/user', [AuthController::class,"user"]);

    // profile
    Route::controller(ProfileController::class)->prefix("/profile")->group(function () {
        Route::get('/get-profile', 'get_profile');
        Route::post('/update-profile', 'update_profile');
        Route::post('/update-password', 'update_password');
    });

    // users
    Route::controller(UserController::class)->prefix("/users")->group(function () {
        Route::get('/index', 'index');
    });

    // products
    Route::controller(ProductController::class)->prefix("/products")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{product}', 'show');
        Route::post('/store', 'store');
        Route::post('/update/{product}', 'update');
        Route::post('/delete/{product}', 'delete');
    });

    // meals
    Route::controller(MealController::class)->prefix("/meals")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{meal}', 'show');
        Route::post('/store', 'store');
        Route::post('/update/{meal}', 'update');
        Route::post('/delete/{meal}', 'delete');
    });

});
