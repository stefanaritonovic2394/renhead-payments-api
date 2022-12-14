<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentApprovalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TravelPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Public routes
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Protected routes
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/payment', PaymentController::class);
    Route::apiResource('/travel-payment', TravelPaymentController::class);
    Route::post('/payment-approval', [PaymentApprovalController::class, 'storePaymentApproval']);
    Route::post('/payment/{paymentId}/approve', [PaymentApprovalController::class, 'approvePayment']);
    Route::get('/approved-payments', [PaymentApprovalController::class, 'getApprovedPayments']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
