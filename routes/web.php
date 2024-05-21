<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'login']);
