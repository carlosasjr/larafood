<?php

use App\Http\Controllers\Api\Auth\AuthClientController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\EvaluationApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\Admin\{CategoryApiController,
    ProductApiController,
    TableApiController,
    TenantApiController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** CLIENT REGISTER */
Route::post('auth/register', [RegisterController::class, 'store']);

/** SANCTUM CREATE TOKEN */
Route::post('auth/token', [AuthClientController::class, 'auth']);


Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('auth/me', [AuthClientController::class, 'me']);
    Route::post('auth/logout', [AuthClientController::class, 'logout']);

    /** ORDERS */
    Route::post('auth/orders', [OrderApiController::class, 'store']);
    Route::post('auth/orders/{identify}/evaluations', [EvaluationApiController::class, 'store']);
    Route::get('auth/my-orders', [OrderApiController::class, 'myOrders']);
});


Route::group([
    'prefix' => 'v1',
], function () {
    /** TENANTS */
    Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);
    Route::get('tenants', [TenantApiController::class, 'index']);

    /** CATEGORIES */
    Route::get('categories/{uuid}', [CategoryApiController::class, 'show']);
    Route::get('categories', [CategoryApiController::class, 'categories']);

    /** TABLES */
    Route::get('tables/{uuid}', [TableApiController::class, 'show']);
    Route::get('tables', [TableApiController::class, 'index']);

    /** PRODUCTS */
    Route::get('products/{uuid}', [ProductApiController::class, 'product']);
    Route::get('products', [ProductApiController::class, 'index']);

    /** ORDERS */
    Route::post('orders', [OrderApiController::class, 'store']);
    Route::get('orders/{identify}', [OrderApiController::class, 'show']);
});


Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});



