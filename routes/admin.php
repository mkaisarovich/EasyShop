<?php

use App\Http\Controllers\Admin\v1\AuthController;
use App\Http\Controllers\Admin\v1\MainController;
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

});
