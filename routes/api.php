<?php

use App\Http\Controllers\API\AuthDonorController;
use App\Http\Controllers\API\CaseController;
use App\Http\Controllers\API\CurrencyConverterController;
use App\Http\Controllers\API\DeviceTokenController;
use App\Http\Controllers\API\DonorCommentsController;
use App\Http\Controllers\API\DonorDonationsController;
use App\Http\Controllers\API\DonorInformationController;
use App\Http\Controllers\API\OrganizationRequestController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TakafulPlatform;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cases-data', [CaseController::class, 'index']);
Route::get('/projects-data', [ProjectController::class, 'index']);

Route::post('/org-req', [OrganizationRequestController::class, 'organizationRegister']);
Route::post('/create-checkout-session', [StripePaymentController::class, 'CreateSession']);

Route::get('currency-rates', [CurrencyController::class, 'getCurrencyRates']);
Route::get('/convert-currency', [CurrencyConverterController::class, 'convertToYER']);

Route::get('/takaful-statistics', [TakafulPlatform::class, 'Statistics']);
Route::get('/takaful-partners', [TakafulPlatform::class, 'TakafulPartners']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/donor/donations', [DonorDonationsController::class, 'donorDonations']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/donor/donations-summary', [DonorDonationsController::class, 'donorSummary']);
    Route::patch('donors/update-profile',[DonorInformationController::class,'updateProfile']);
});

Route::post('/donors/register', [AuthDonorController::class, 'store']);

Route::post('/donors/verify-otp', [AuthDonorController::class, 'verifyOtp']);
Route::post('/donors/forgot-password', [AuthDonorController::class, 'sendOtpToResetPassword']);

Route::post('/donors/reset-password', [AuthDonorController::class, 'resetPasswordWithOtp']);

Route::post('/donors/login', [AuthDonorController::class, 'login']);
Route::post('donors/logout',[AuthDonorController::class,'logout'])->middleware('auth:sanctum');


Route::post('/device-token', [DeviceTokenController::class, 'store']);



Route::post('/case-comment', [DonorCommentsController::class, 'caseCommentsStore'])->middleware('auth:sanctum');
Route::post('/project-comment', [DonorCommentsController::class, 'projectCommentsStore'])->middleware('auth:sanctum');




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/stripe/webhook',[StripePaymentController::class , 'stripeWebhook'] );