<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfilesController;
use App\Http\Controllers\Admin\ACL\RolePermissionController;
use App\Http\Controllers\Admin\ACL\PlanProfilesController;
use App\Http\Controllers\Admin\ACL\ProfilePermissionsController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\RoleController;
use App\Http\Controllers\Admin\ACL\UserRoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;
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

        /** TENANTS */
        Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', TenantController::class);

        /** TABLES */
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);

        /** PRODUCT X CATEGORY */
        Route::any('products/{id}/categories/create/search',
            [ProductCategoryController::class, 'createSearch'])->name('products.categories.create.search');
        Route::resource('products.categories', ProductCategoryController::class);

        /** PRODUCTS */
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', ProductController::class);

        /** CATEGORIES */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);

        /** USERS X ROLES */
        Route::any('users/{id}/roles/create/search',
            [UserRoleController::class, 'createSearch'])->name('users.roles.create.search');
        Route::resource('users.roles', UserRoleController::class)->except(['show', 'edit', 'update']);


        /** USERS */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);


       /** ROLES */
        Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', RoleController::class);

        /** ROLES X PERMISSIONS */
        Route::any('roles/{url}/permissions/create/search',
            [RolePermissionController::class, 'createSearch'])->name('roles.permissions.create.search');
        Route::resource('roles.permissions', RolePermissionController::class)->except(['show', 'edit', 'update']);

        /** PLANS X PROFILES */
        Route::any('plans/{url}/profiles/create/search',
            [PlanProfilesController::class, 'createSearch'])->name('plans.profiles.create.search');
        Route::resource('plans.profiles', PlanProfilesController::class)->except(['show', 'edit', 'update']);


        /** PERMISSIONS x  PROFILES */
        Route::get('permissions/{id}/profiles',
            [PermissionProfilesController::class, 'index'])->name('permissions.profiles');

        /** PROFILES x PERMISSIONS */
        Route::any('profiles/{id}/permissions/create/search',
            [ProfilePermissionsController::class, 'createSearch'])->name('profiles.permissions.create.search');

        Route::resource('profiles.permissions', ProfilePermissionsController::class)->except([
            'show',
            'edit',
            'update'
        ]);


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
Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('site.subscription');


Auth::routes();

