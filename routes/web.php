<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [\App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/register', [\App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::get('/reset-password', [\App\Http\Controllers\HomeController::class, 'resetPassword'])->name('reset-password');
Route::get('/rooms', [\App\Http\Controllers\HomeController::class, 'rooms'])->name('rooms');
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact-us');

Route::middleware(['auth'])->group(function () {
    Route::get('/verify-email-address', [\App\Http\Controllers\AccountController::class, 'verifyEmailAddress'])->name('verification.verify');
    Route::get('/email-verification-notice', [\App\Http\Controllers\AccountController::class, 'emailVerification'])->name('verification.notice');
    //Route::post('/resend-verification-email', [\App\Http\Controllers\AccountController::class, 'resendVerificationEmail'])->name('verification.resend');
    Route::get('/profile', [\App\Http\Controllers\AccountController::class, 'profile'])->name('profile');
    Route::get('/bookings', [\App\Http\Controllers\AccountController::class, 'bookings'])->name('bookings');

    Route::prefix('manage')->middleware('verified:verification.notice')->group(function (){
        Route::redirect('', '/manage/dashboard');
        Route::get('dashboard', [\App\Http\Livewire\Account\ManagerDashboard::class, '__invoke'])->name('manager-dashboard');
        Route::get('profile', [\App\Http\Livewire\Account\ManagerProfile::class, '__invoke'])->name('manager-profile');

        Route::prefix('properties')->group(function (){
            Route::get('', [\App\Http\Livewire\Account\ListProperties::class,'__invoke'])->name('properties');
            Route::get('create', [\App\Http\Livewire\Account\CreatePropertyForm::class,'__invoke'])->name('create-property');
            Route::get('{id}/edit', [\App\Http\Livewire\Account\EditPropertyForm::class,'__invoke'])->name('edit-property');
            Route::get('{id}/show', [\App\Http\Livewire\Account\ShowProperty::class,'__invoke'])->name('view-property');
            Route::get('{id}/rooms-or-services/create', [\App\Http\Livewire\Account\CreateRoomServiceForm::class,'__invoke'])->name('create-room-or-service');
        });

        Route::prefix('amenities')->group(function (){
            Route::get('', [\App\Http\Livewire\Account\ListAmenities::class,'__invoke'])->name('amenities');
            Route::get('create', [\App\Http\Livewire\Account\CreateAmenityForm::class,'__invoke'])->name('create-amenity');
            Route::get('{id}/edit', [\App\Http\Livewire\Account\EditAmenityForm::class,'__invoke'])->name('edit-amenity');
        });

        Route::prefix('bed-types')->group(function (){
            Route::get('', [\App\Http\Livewire\Account\ListBedTypes::class,'__invoke'])->name('bed-types');
            Route::get('create', [\App\Http\Livewire\Account\CreateBedTypeForm::class,'__invoke'])->name('create-bed-type');
            Route::get('{id}/edit', [\App\Http\Livewire\Account\EditBedTypeForm::class,'__invoke'])->name('edit-bed-type');
        });

        Route::prefix('room-categories')->group(function (){
            Route::get('', [\App\Http\Livewire\Account\ListRoomCategories::class,'__invoke'])->name('room-categories');
            Route::get('create', [\App\Http\Livewire\Account\CreateCategoryForm::class,'__invoke'])->name('create-room-category');
            Route::get('{id}/edit', [\App\Http\Livewire\Account\EditCategoryForm::class,'__invoke'])->name('edit-room-category');
        });

        Route::get('reservations', [\App\Http\Livewire\Account\ShowReservations::class, '__invoke'])->name('reservations');
    });
});

Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function () {
    Route::get('', [\App\Http\Controllers\Admin\LoginController::class, 'index']);
    Route::get('login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('rooms', [\App\Http\Controllers\Admin\RoomController::class, 'index'])->name('rooms');
        Route::get('beds', [\App\Http\Controllers\Admin\BedController::class, 'index'])->name('beds');
        Route::get('bed-types', [\App\Http\Controllers\Admin\BedTypeController::class, 'index'])->name('bed-types');
        Route::get('amenities', [\App\Http\Controllers\Admin\AmenityController::class, 'index'])->name('amenities');
        Route::get('amenity-types', [\App\Http\Controllers\Admin\AmenityTypeController::class, 'index'])->name('amenity-types');
    });
});
