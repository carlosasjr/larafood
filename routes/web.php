<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {

    /** PERMISSIONS X PROFILES */
    Route::any('profiles/{id}/permissions/create/search', [PermissionProfileController::class, 'createSearch'])->name('profiles.permissions.create.search');

     Route::resource('profiles.permissions',PermissionProfileController::class);


    /** PERMISSIONS */
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);

    /** PROFILES */
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
     Route::resource('profiles', ProfileController::class);

    /** DETAILS PLANS */
    Route::resource('plans.details', PlanDetailController::class);

    /** PLANS */
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::resource('plans', PlanController::class);
});


Route::get('/', function () {
    return view('welcome');
});
