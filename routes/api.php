<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\BasketController;
use App\Http\Controllers\Api\v1\CatalogController;
use App\Http\Controllers\Api\v1\FashionController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/documents', [AuthController::class, 'documents']);
Route::get('/clothes_types', [AuthController::class, 'types']);
Route::get('/category', [AuthController::class, 'category']);
Route::get('/subcatalog', [AuthController::class, 'subcatalog']);


Route::prefix('auth')->group(function (){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('check_code', [AuthController::class, 'checkCode']);
    Route::post('forgot_password', [AuthController::class, 'forgotPassword']);
    Route::post('restore_password', [AuthController::class, 'restorePassword']);
    Route::get('get_city', [AuthController::class, 'getCity']);
});


Route::middleware(['auth:sanctum'])->prefix("client")->group(function () {

    Route::get('/malls', [ShopController::class, 'malls']);

    Route::prefix('shops')->group(function () {
        Route::get('', [ShopController::class, 'index']);
        Route::get('/{shop}', [ShopController::class, 'show']);
        Route::get('/{shop}/catalog', [CatalogController::class, 'index']);
        Route::post('/subscribe/{shop}', [ShopController::class, 'subscribe']);
    });


    Route::prefix('fashions')->group(function () {
        Route::get('', [FashionController::class, 'index']);
        Route::get('/products', [FashionController::class, 'products']);
        Route::get('/product_category', [FashionController::class, 'product_category']);
        Route::post('/create', [FashionController::class, 'create']);
        Route::post('/create_order', [FashionController::class, 'createFashion']);
        Route::post('/generate', [FashionController::class, 'generate']);
    });

    Route::prefix('baskets')->group(function () {
        Route::get('', [BasketController::class, 'index']);
        Route::delete('delete', [BasketController::class, 'delete']);
    });

    Route::prefix('catalog')->group(function () {
        Route::get('/filter', [ProductController::class, 'filter']);
        Route::get('/category', [ProductController::class, 'getCategory']);
        Route::get('/{catalog}/products', [ProductController::class, 'index']);
        Route::get('/{catalog}/products/{product}', [ProductController::class, 'show']);
        Route::post('/{catalog}/products/{product}', [ProductController::class, 'basket']);
    });


    Route::prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'index']);
        Route::post('edit', [ProfileController::class, 'edit']);
        Route::get('/subscriptions', [ProfileController::class, 'subscriptions']);
        Route::get('/about_us', [ProfileController::class, 'about_us']);
        Route::get('/privacy', [ProfileController::class, 'privacy']);
        Route::post('/favorite_sizes', [ProfileController::class, 'favoriteSize']);
        Route::post('/orders', [ProfileController::class, 'orders']);
    });

    Route::prefix('favorites')->group(function () {
        Route::get('', [FavoriteController::class, 'index']);
//        Route::get('/subscriptions', [ProfileController::class, 'subscriptions']);
//        Route::get('/about_us', [ProfileController::class, 'about_us']);
//        Route::get('/privacy', [ProfileController::class, 'privacy']);
    });

        Route::post('/favorite', [FavoriteController::class, 'favorite']);
        Route::post('/order', [FavoriteController::class, 'order']);



});



Route::middleware(['auth:sanctum'])->prefix("admin")->group(function () {




    Route::prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'indexAdmin']);
        Route::post('/edit', [ProfileController::class, 'editAdmin']);
    });

    Route::prefix('products')->group(function () {
        Route::get('', [\App\Http\Controllers\Api\v1\AdminController::class, 'indexProducts']);
        Route::delete('/delete', [\App\Http\Controllers\Api\v1\AdminController::class, 'deleteProduct']);
        Route::get('/switch', [\App\Http\Controllers\Api\v1\AdminController::class, 'switchProduct']);
        Route::post('/create', [\App\Http\Controllers\Api\v1\AdminController::class, 'createProduct']);
        Route::post('/edit', [\App\Http\Controllers\Api\v1\AdminController::class, 'editProduct']);
//        Route::post('/edit', [ProfileController::class, 'editAdmin']);
    });

    Route::prefix('fashions')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\v1\AdminController::class, 'createFashion']);
//        Route::post('/edit', [ProfileController::class, 'editAdmin']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('', [\App\Http\Controllers\Api\v1\AdminController::class, 'indexOrders']);
        Route::post('/delete', [\App\Http\Controllers\Api\v1\AdminController::class, 'deleteOrder']);
        Route::post('/change_status/{order}', [\App\Http\Controllers\Api\v1\AdminController::class, 'changeStatus']);
//        Route::post('/edit', [ProfileController::class, 'editAdmin']);
    });



});
