<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Hekmatinasser\Verta\Verta;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/;

Route::get('/404', function () {
    abort(404);
})->name('404');

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
