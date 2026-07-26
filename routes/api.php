<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => '/v1', 'middleware' => ['auth:api']], function () {

    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [ProductController::class, 'index']);
    });
});