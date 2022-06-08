<?php

use App\Http\Controllers\AuthController;
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
//Buyer
