<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Controllers\API\CourierServiceController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\ReceiverController;




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

Route::namespace('API')->group(function () {
    Route::apiResource('deliveries', 'DeliveryController');
    Route::apiResource('packages', 'PackageController');
    Route::apiResource('receivers', 'ReceiverController');
    Route::apiResource('courier_services', 'CourierServiceController');
});

Route::put('deliveries/{id}/status', [DeliveryController::class, 'updateDeliveryStatus']);

Route::post('/package/{package}/handleDelivery', [PackageController::class, 'handleDelivery']);
Route::post('/package/{package}/sendPackage', [PackageController::class, 'sendPackage']);
