<?php

use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductPriceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
   Route::get('products', [ProductController::class, 'index']);
   Route::get('products/{id}', [ProductController::class, 'show']);
   Route::post('products', [ProductController::class, 'store']);
   Route::put('products/{id}', [ProductController::class, 'update']);
   Route::delete('products/{id}', [ProductController::class, 'destroy']);

   Route::get('products/{id}/prices', [ProductPriceController::class, 'index']);
   Route::post('products/{id}/prices', [ProductPriceController::class, 'store']);
});