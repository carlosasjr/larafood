<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfilesController;
use App\Http\Controllers\Admin\ACL\PlanProfilesController;
use App\Http\Controllers\Admin\ACL\ProfilePermissionsController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;
use App\Http\Controllers\Site\SiteController;
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

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

    /** PLANS X PROFILES */
    Route::any('plans/{url}/profiles/create/search', [PlanProfilesController::class, 'createSearch'])->name('plans.profiles.create.search');
    Route::resource('plans.profiles', PlanProfilesController::class)->except(['show', 'edit', 'update']);


    /** PERMISSIONS x  PROFILES */
    Route::get('permissions/{id}/profiles', [PermissionProfilesController::class, 'index'])->name('permissions.profiles');

    /** PROFILES x PERMISSIONS */
    Route::any('profiles/{id}/permissions/create/search', [ProfilePermissionsController::class, 'createSearch'])->name('profiles.permissions.create.search');

     Route::resource('profiles.permissions',ProfilePermissionsController::class)->except(['show', 'edit', 'update']);


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


Route::get('/', [SiteController::class, 'index'])->name('site.home');



Auth::routes();

