<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomOrServiceCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [HomeController::class, 'rooms'])->name('rooms');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Livewire\Auth\LoginForm::class, '__invoke'])->name('login');
    Route::get('/register', [\App\Http\Livewire\Auth\SignupForm::class, '__invoke'])->name('register');
    Route::get('/reset-password', [\App\Http\Livewire\Auth\ResetPasswordForm::class, '__invoke'])->name('reset-password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user-data', [AccountController::class, 'getUserData'])->name('user-data');
    Route::get('/form-options', [AccountController::class, 'getFormOptions'])->name('form-options');
    Route::get('/verify-email-address', [AccountController::class, 'verifyEmailAddress'])->name('verification.verify');
    Route::get('/email-verification-notice', [\App\Http\Livewire\Account\EmailVerification::class, '__invoke'])->name('verification.notice');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::get('/bookings', [AccountController::class, 'bookings'])->name('bookings');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('manage')->middleware('verified:verification.notice')->group(function () {

        Route::prefix('properties')->group(function () {
            Route::get('', [PropertyController::class, 'index']);
            Route::post('', [PropertyController::class, 'store']);
            Route::get('{id}', [PropertyController::class, 'show']);
            Route::get('{id}/for-update', [PropertyController::class, 'getForUpdate']);
            Route::get('{id}/rooms-or-services', [PropertyController::class, 'getPropertyRoomsOrServices']);
            Route::post('{id}', [PropertyController::class, 'update']);
            Route::post('{id}/additional-photos', [PropertyController::class, 'uploadAdditionalPhotos']);
            Route::patch('publish/{id}', [PropertyController::class, 'publish']);
            Route::patch('unpublish/{id}', [PropertyController::class, 'unpublish']);
            Route::patch('remove-amenity', [PropertyController::class, 'removeAmenity']);
        });

        Route::prefix('amenities')->group(function () {
            Route::get('', [AmenityController::class, 'index']);
            Route::post('', [AmenityController::class, 'store']);
            Route::get('show', [AmenityController::class, 'show']);
            Route::get('options', [AmenityController::class, 'options']);
            Route::put('{amenity}', [AmenityController::class, 'update']);
        });

        Route::prefix('rooms')->group(function (){
            Route::post('', [RoomController::class,'store']);
            Route::get('{id}', [RoomController::class, 'show']);
            Route::post('{id}', [RoomController::class, 'update']);
            Route::post('{id}/additional-photos', [RoomController::class, 'uploadAdditionalPhotos']);
            Route::get('{id}/for-update', [RoomController::class, 'getForUpdate']);
            Route::patch('publish/{id}', [RoomController::class, 'publish']);
            Route::patch('unpublish/{id}', [RoomController::class, 'unpublish']);
            Route::patch('remove-amenity', [RoomController::class, 'removeAmenity']);
        });

        Route::prefix('bed-types')->group(function () {
            Route::get('', [BedTypeController::class, 'index']);
            Route::post('', [BedTypeController::class, 'store']);
            Route::get('show', [BedTypeController::class, 'show']);
            Route::get('options', [BedTypeController::class, 'options']);
            Route::put('{bedType}', [BedTypeController::class, 'update']);
        });

        Route::prefix('beds')->group(function () {
            Route::post('', [BedController::class, 'store']);
            Route::patch('', [BedController::class, 'remove']);
        });

        Route::prefix('room-or-service-categories')->group(function () {
            Route::get('', [RoomOrServiceCategoryController::class, 'index']);
            Route::post('', [RoomOrServiceCategoryController::class, 'store']);
            Route::get('show', [RoomOrServiceCategoryController::class, 'show']);
            Route::get('options', [RoomOrServiceCategoryController::class, 'options']);
            Route::put('{category}', [RoomOrServiceCategoryController::class, 'update']);
        });
    });

    Route::prefix('manager')->middleware('verified:verification.notice')->group(function () {
        Route::get('{any?}', [AccountController::class, 'manager'])->where('any', '.+')->name('manager-dashboard');
    });
});

Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function () {
    Route::get('', [AdminLoginController::class, 'index']);
    Route::get('login', [AdminLoginController::class, 'index'])->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('rooms', [\App\Http\Controllers\Admin\RoomController::class, 'index'])->name('rooms');
        Route::get('beds', [\App\Http\Controllers\Admin\BedController::class, 'index'])->name('beds');
        Route::get('bed-types', [\App\Http\Controllers\Admin\BedTypeController::class, 'index'])->name('bed-types');
        Route::get('amenities', [\App\Http\Controllers\Admin\AmenityController::class, 'index'])->name('amenities');
        Route::get('amenity-types', [\App\Http\Controllers\Admin\AmenityTypeController::class, 'index'])->name('amenity-types');
    });
});
