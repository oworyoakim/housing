<?php

use Illuminate\Support\Facades\Route;

Route::prefix('manager')->middleware(['auth', 'verified:verification.notice'])->group(function () {
    Route::prefix('properties')->group(function () {

    });

    Route::prefix('amenities')->group(function () {
        Route::get('', [\App\Http\Controllers\AmenityController::class, 'index']);
        Route::post('', [\App\Http\Controllers\AmenityController::class, 'store']);
        Route::put('{amenity}', [\App\Http\Controllers\AmenityController::class, 'update']);
    });
});
