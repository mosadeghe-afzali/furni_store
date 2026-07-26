<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => '/v1'], function () {

    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{product_id}', [ProductController::class, 'show']);
    });

    Route::group(['prefix' => '/orders'], function () {
        Route::post('/', [OrderController::class, 'submit']);

        Route::group(['prefix' => '/payments'], function () {
            Route::post('/callback', [OrderController::class, 'callback']);
        });
    });
});
