<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PickupController;
use App\Http\Controllers\Api\WasteCategoryController;
use App\Http\Controllers\Api\WasteBankController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\HistoryController;


Route::get('/ping', function () {
    return response()->json([
        'success' => true,
        'message' => 'API Recycling Point is running',
    ]);
});

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/google-login', [AuthController::class, 'googleLogin']);
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/pickups', [PickupController::class, 'index']);
    Route::get('/pickups/{id}', [PickupController::class, 'show']);
    Route::post('/pickups', [PickupController::class, 'store']);
    Route::put('/pickups/{id}', [PickupController::class, 'update']);
    Route::delete('/pickups/{id}', [PickupController::class, 'destroy']);
    Route::get('/waste-categories', [WasteCategoryController::class, 'index']);
    Route::get('/waste-banks', [WasteBankController::class,'index']);
    Route::get('/vouchers', [VoucherController::class, 'index']);
    Route::post('/vouchers/redeem', [VoucherController::class, 'redeem']);
    Route::get('/vouchers/history', [VoucherController::class, 'history']);
    Route::get('/profile', [ProfileController::class,'profile']);
    Route::put('/profile', [ProfileController::class,'update']);
    Route::post('/profile/photo', [ProfileController::class,'uploadPhoto']);
    Route::put('/profile/password', [ProfileController::class,'changePassword']);
    Route::get('/history/pickups', [HistoryController::class, 'pickup']);  
    
});