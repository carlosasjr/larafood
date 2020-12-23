<?php

use App\Http\Controllers\Api\Admin\{
    TenantApiController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('tenants', TenantApiController::class);
