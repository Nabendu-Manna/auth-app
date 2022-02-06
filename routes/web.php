<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
})->name("common.home");

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::group(['prefix'=>'user', 'as'=>'user.'], function(){
    // Route::view('/signup', 'user.sign-up')->name("signup.show");
    Route::get('/signup', [UserController::class, 'signUpShow'])->name("signup.show");
    Route::post('/signup', [UserController::class, 'signUp'])->name("signup.submit");

    Route::get('/signin', [UserController::class, 'signInShow'])->name("signin.show");
    Route::post('/signin', [UserController::class, 'signIn'])->name("signin.submit");

    Route::get('/forget/password', [UserController::class, 'forgetPasswordShow'])->name("forget-password.show");
    Route::post('/forget/password/send/email', [UserController::class, 'forgetPasswordSendEmail'])->name("forget-password-send-email");

    Route::post('/forget/password/reset', [UserController::class, 'passwordReset'])->name("forget-password.submit");

    Route::post('/logout', [UserController::class, 'logout'])->name("logout");

    Route::group(['middleware' => 'isAuthenticate:user'], function(){
        Route::get('/profile', [UserController::class, 'profile'])->name("profile");
    });
});

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function(){
    // Route::view('/signup', 'admin.sign-up')->name("signup.show");
    Route::get('/signup', [AdminController::class, 'signUpShow'])->name("signup.show");
    Route::post('/signup', [AdminController::class, 'signUp'])->name("signup.submit");

    Route::get('/signin', [AdminController::class, 'signInShow'])->name("signin.show");
    Route::post('/signin', [AdminController::class, 'signIn'])->name("signin.submit");

    Route::post('/logout', [AdminController::class, 'logout'])->name("logout");

    Route::group(['middleware' => 'isAuthenticate:admin'], function(){
        Route::get('/profile', [AdminController::class, 'profile'])->name("profile");
    });
});
