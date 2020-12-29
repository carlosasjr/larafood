<?php

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
    Route::get('categories/{url}', [CategoryApiController::class, 'show']);

    /** TABLES */
    Route::get('tenants/{uuid}/tables', [TableApiController::class, 'index']);
    Route::get('tables/{uuid}', [TableApiController::class, 'show']);

    /** PRODUCTS */
    Route::get('tenants/{uuid}/products', [ProductApiController::class, 'index']);
    Route::get('products/{url}', [ProductApiController::class, 'product']);
});
