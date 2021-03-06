<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersOrderController;
use App\Http\Controllers\UsersWalletController;
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

Route::middleware('api')->prefix('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user', UserController::class);
Route::post('user/wallet', 'App\Http\Controllers\UserController@wallet');
Route::post('user/getReport', 'App\Http\Controllers\UserController@getReport');
Route::post('user/checkLogin', 'App\Http\Controllers\UserController@checkLogin');

Route::apiResource('wallet', UsersWalletController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('orders', UsersOrderController::class);

Route::post('product/getOrderProducts', 'App\Http\Controllers\ProductController@getOrderProducts');

