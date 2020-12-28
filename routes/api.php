<?php

use App\Http\Controllers\Api\Admin\{CategoryApiController, TableApiController, TenantApiController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** TENANTS */
Route::get('tenants', [TenantApiController::class, 'index']);
Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);

/** CATEGORIES */
Route::get('tenants/{uuid}/categories', [CategoryApiController::class, 'categories']);
Route::get('categories/{url}', [CategoryApiController::class, 'show']);

/** TABLES */
Route::get('tenants/{uuid}/tables', [TableApiController::class, 'index']);
Route::get('tables/{uuid}', [TableApiController::class, 'show']);


