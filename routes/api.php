<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/seller/register', [AuthController::class, 'registerSeller']);
Route::post('/seller/login', [AuthController::class, 'loginSeller']);

//Product
Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

//Seller
Route::post('/seller/{seller}/product', [SellerController::class, 'storeProduct']);
Route::get('/seller/{seller}/product', [SellerController::class, 'show_products']);
Route::get('/seller/{id}', [SellerController::class, 'show']);
//Buyer
Route::get('/user/{id}', [BuyerController::class, 'show']);
Route::get('users', [BuyerController::class, 'index']);

//Cart
// Route::apiResource('carts', CartController::class)->except(['index', 'update']);
// // Route::post('/carts/{user}', [CartController::class, 'store']);
// // Route::get('/carts/{cartKey}', [CartController::class, 'show']);

Route::get('/carts', [CartController::class, 'index']);
Route::get('/cart/{userId}', [CartController::class, 'showCartItems']);
Route::post('/carts/{userId}', [CartController::class, 'addToCart']);

// Route::get('/cart/{userId}', [CartController::class, 'showCartItems']);
// Route::post('/carts/{userId}', [CartController::class, 'addToCart']);
