<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\MealPlanController;
use App\Http\Controllers\Admin\MealScoreController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// admin auth
Route::controller(AuthController::class)->prefix("/auth")->group(function () {
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgot_password');
    Route::post('/validate-forgot-password', 'validate_forgot_password');
    Route::post('/reset-password', 'reset_password');
});


Route::middleware("auth-admin")->group(function () {

    Route::get('/user', [AuthController::class,"user"]);

    // profile
    Route::controller(ProfileController::class)->prefix("/profile")->group(function () {
        Route::get('/get-profile', 'get_profile');
        Route::get('/get-avatar', 'get_avatar');
        Route::post('/update-profile', 'update_profile');
        Route::post('/update-password', 'update_password');
    });

    // users
    Route::controller(UserController::class)->prefix("/users")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{user}', 'show');
        Route::post('/update/{user}', 'update');
        Route::post('/delete/{user}', 'delete');
    });

    // admins
    Route::controller(AdminController::class)->prefix("/admins")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{admin}', 'show');
        Route::post('/store', 'store');
        Route::post('/update/{admin}', 'update');
        Route::post('/delete/{admin}', 'delete');
    });

    // products
    Route::controller(ProductController::class)->prefix("/products")->group(function () {
        Route::get('/all', 'all');
        Route::get('/index', 'index');
        Route::get('/show/{product}', 'show');
        Route::post('/store', 'store');
        Route::post('/update/{product}', 'update');
        Route::post('/delete/{product}', 'delete');
    });

    // meals
    Route::controller(MealController::class)->prefix("/meals")->group(function () {
        Route::get('/all', 'all');
        Route::get('/index', 'index');
        Route::get('/show/{meal}', 'show');
        Route::post('/store', 'store');
        Route::post('/update/{meal}', 'update');
        Route::post('/delete/{meal}', 'delete');
    });

    // meal scores
    Route::controller(MealScoreController::class)->prefix("/meal-scores")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{meal_score}', 'show');
        Route::post('/update/{meal_score}', 'update');
        Route::post('/delete/{meal_score}', 'delete');
    });

    // meal plans
    Route::controller(MealPlanController::class)->prefix("/meal-plans")->group(function () {
        Route::get('/index', 'index');
        Route::get('/get-next-month-plans', 'getNextMonthPlans');
        Route::post('/update-next-month-plans', 'updateNextMonthPlans');
    });

    // orders
    Route::controller(OrderController::class)->prefix("/orders")->group(function () {
        Route::get('/index', 'index');
        Route::get('/show/{order}', 'show');
        Route::post('/update/{order}', 'update');
    });

});
