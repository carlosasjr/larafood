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
    Route::get('tenants', [TenantApiController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);

    /** CATEGORIES */
    Route::get('categories/{uuid}', [CategoryApiController::class, 'show']);
    Route::get('categories', [CategoryApiController::class, 'categories']);

    /** TABLES */
    Route::get('tenants/{uuid}/tables', [TableApiController::class, 'index']);
    Route::get('tables/{uuid}', [TableApiController::class, 'show']);

    /** PRODUCTS */
    Route::get('tenants/{uuid}/products', [ProductApiController::class, 'index']);
    Route::get('products/{uuid}', [ProductApiController::class, 'product']);

    /** CLIENTS */
    Route::post('clients', [RegisterController::class, 'store']);

    /** ORDERS */
    Route::post('orders', [OrderApiController::class, 'store']);
    Route::get('orders/{identify}', [OrderApiController::class, 'show']);

    /** SANCTUM CREATE TOKEN */
    Route::post('sanctum/token', [AuthClientController::class, 'auth']);

});



