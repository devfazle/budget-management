<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('admin')->group(function(){
    Route::resource('users',UserController::class)->names('users');
});

Route::prefix('fazle')->group(function(){
    Route::resource('sales',SaleController::class)->names('sales');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'login']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');