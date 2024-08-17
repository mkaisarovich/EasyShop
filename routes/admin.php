<?php

use App\Http\Controllers\Admin\v1\AuthController;
use App\Http\Controllers\Admin\v1\MainController;
use App\Http\Controllers\Admin\v1\OrderController;
use App\Http\Controllers\Admin\v1\PartnerController;
use App\Http\Controllers\Admin\v1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['post', 'get'], 'login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'super_admin','as' => 'super_admin.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'main', 'as' => 'main.'], function () {
        Route::get('/', [MainController::class, 'index']);
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index']);
    });

    Route::group(['prefix' => 'partners', 'as' => 'partners.'], function () {
        Route::get('/', [PartnerController::class, 'index']);
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index']);
    });

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/about_us', [\App\Http\Controllers\Admin\v1\SettingsController::class, 'about_us'])->name('about_us');
        Route::get('/privacy', [\App\Http\Controllers\Admin\v1\SettingsController::class, 'privacy'])->name('privacy');
    });

    Route::group(['prefix' => 'filter', 'as' => 'filter.'], function () {
        Route::get('/colors', [\App\Http\Controllers\Admin\v1\FilterController::class, 'colors'])->name('colors');
        Route::post('/colors/create', [\App\Http\Controllers\Admin\v1\FilterController::class, 'colorsCreate'])->name('colors.create');
        Route::put('/colors/edit/{color}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'colorsEdit'])->name('colors.edit');
        Route::delete('/colors/delete/{color}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'colorsDelete'])->name('colors.delete');
        Route::get('/sizes', [\App\Http\Controllers\Admin\v1\FilterController::class, 'sizes'])->name('sizes');
        Route::post('/sizes/create', [\App\Http\Controllers\Admin\v1\FilterController::class, 'sizesCreate'])->name('sizes.create');
        Route::put('/sizes/edit/{size}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'sizesEdit'])->name('sizes.edit');
        Route::delete('/sizes/delete/{size}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'sizesDelete'])->name('sizes.delete');
        Route::get('/seasons', [\App\Http\Controllers\Admin\v1\FilterController::class, 'seasons'])->name('seasons');
        Route::post('/seasons/create', [\App\Http\Controllers\Admin\v1\FilterController::class, 'seasonsCreate'])->name('seasons.create');
        Route::put('/seasons/edit/{season}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'seasonsEdit'])->name('seasons.edit');
        Route::delete('/seasons/delete/{season}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'seasonsDelete'])->name('seasons.delete');
        Route::get('/structures', [\App\Http\Controllers\Admin\v1\FilterController::class, 'structures'])->name('structures');
        Route::post('/structures/create', [\App\Http\Controllers\Admin\v1\FilterController::class, 'structuresCreate'])->name('structures.create');
        Route::put('/structures/edit/{structure}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'structuresEdit'])->name('structures.edit');
        Route::delete('/structures/delete/{structure}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'structuresDelete'])->name('structures.delete');
        Route::get('/styles', [\App\Http\Controllers\Admin\v1\FilterController::class, 'styles'])->name('styles');
        Route::post('/styles/create', [\App\Http\Controllers\Admin\v1\FilterController::class, 'stylesCreate'])->name('styles.create');
        Route::put('/styles/edit/{style}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'stylesEdit'])->name('styles.edit');
        Route::delete('/styles/delete/{style}', [\App\Http\Controllers\Admin\v1\FilterController::class, 'stylesDelete'])->name('styles.delete');
    });

});
