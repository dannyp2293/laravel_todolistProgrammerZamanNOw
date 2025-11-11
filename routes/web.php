<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login');
    Route::post('/login','doLogin');
    Route::get('/logout','doLogout');
});
