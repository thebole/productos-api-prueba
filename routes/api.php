<?php

use Illuminate\Support\Facades\Route;

Route::domain(env('CENTRAL_DOMAIN', 'localhost'))->group(function () {
    require __DIR__.'/api_routes/auth/auth.php';

    // Route::middleware(['auth:sanctum', 'permission:api.access'])->get('auth/check', function () {
    //     return response()->json([
    //         'message' => 'Authorized by Spatie permission middleware.',
    //     ]);
    // });
});
