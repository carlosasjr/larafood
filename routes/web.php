<?php

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

    /** DETAILS PLANS */
    Route::resource('plans.details', PlanDetailController::class);

    /** PLANS */
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::resource('plans', PlanController::class);
});


Route::get('/', function () {
    return view('welcome');
});