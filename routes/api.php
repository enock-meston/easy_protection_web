<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\FlutterPaymentController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// create account new accout
Route::post('/new-account', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

//category api
Route::get('/all-category', [CategoryApiController::class, 'selectAllCategoryApi']);

//product api
Route::get('/limit-product', [ProductApiController::class, 'selectLimitProductApi']);
Route::get('/all-product', [ProductApiController::class, 'selectAllProductApi']);
//product api
Route::get('/product/{id}', [ProductApiController::class, 'selectProductByIdApi']);
Route::get('/product-category/{category}', [ProductApiController::class, 'selectProductByCategoryApi']);


//payment api
Route::post('/payment', [FlutterPaymentController::class, 'paymentApi']);
