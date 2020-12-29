<?php

use App\Http\Controllers\Api\Auth\AuthClientController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Admin\{CategoryApiController,
    ProductApiController,
    TableApiController,
    TenantApiController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function () {
    /** TENANTS */
    Route::get('tenants', [TenantApiController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);

    /** CATEGORIES */
    Route::get('tenants/{uuid}/categories', [CategoryApiController::class, 'categories']);
    Route::get('categories/{uuid}', [CategoryApiController::class, 'show']);

    /** TABLES */
    Route::get('tenants/{uuid}/tables', [TableApiController::class, 'index']);
    Route::get('tables/{uuid}', [TableApiController::class, 'show']);

    /** PRODUCTS */
    Route::get('tenants/{uuid}/products', [ProductApiController::class, 'index']);
    Route::get('products/{uuid}', [ProductApiController::class, 'product']);

    /** CLIENTS */
    Route::post('clients', [RegisterController::class, 'store']);

    /** SANCTUM CREATE TOKEN */
    Route::post('sanctum/token', [AuthClientController::class, 'auth']);
});

Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('auth/me', [AuthClientController::class, 'me']);
    Route::post('auth/logout', [AuthClientController::class, 'logout']);
});


