<?php

use App\Http\Controllers\Organization\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Organization\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Organization\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Organization\Auth\NewPasswordController;
use App\Http\Controllers\Organization\Auth\PasswordController;
use App\Http\Controllers\Organization\Auth\PasswordResetLinkController;
use App\Http\Controllers\Organization\Auth\VerifyEmailController;
use App\Http\Controllers\Organization\Auth\LoginController;
use App\Livewire\OrganizationDashboard\Main;
use Illuminate\Support\Facades\Route;

Route::prefix('organization')->name('organization.')->middleware('guest:organization')->group(function () {


    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::prefix('organization')->name('organization.')->middleware('auth:organization')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route::get('/dashboard', function () {
    //     return view('livewire.organization-dashboard.main');
    // })->name('dashboard');

    Route::get('/dashboard', Main::class)->name('dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});

Route::put('/password', [PasswordController::class, 'update'])->name('password.update');