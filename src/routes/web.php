<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);


Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::get('/mypage', [ProfileController::class, 'profile']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::get('/purchase', [PurchaseController::class, 'purchase']);
    Route::get('/purchase/address', [PurchaseController::class, 'address']);
});