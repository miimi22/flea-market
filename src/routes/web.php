<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\TradingController;
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

Route::get('/', [SearchController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('item.detail');
Route::post('/like/{item_id}', [LikeController::class, 'like'])->name('like');
Route::get('/email/verify', [VerificationController::class, 'showNotice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verify/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::middleware('auth')->group(function () {
    Route::post('/item/{item_id}/comments', [CommentController::class, 'store']);
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->middleware('verified')->name('profile.edit');
    Route::put('/mypage/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mypage', [ProfileController::class, 'profile']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/sell', [ItemController::class, 'store']);
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::post('/purchase', [PurchaseController::class, 'store']);
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address']);
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);
    Route::post('/purchase/stripe', [PurchaseController::class, 'stripe'])->name('purchase.stripe');
    Route::get('/purchase/success/{item_id}/{payment_content}', [PurchaseController::class, 'success'])->name('purchase.success');
    Route::get('/trading/{item_id}', [TradingController::class, 'show'])->name('trading.show');
    Route::post('/trading/{item_id}/comment', [TradingController::class, 'storeComment'])->name('trading.comment.store');
    Route::delete('/trading/comment/{comment}', [TradingController::class, 'destroyComment'])->name('trading.comment.destroy');
    Route::patch('/trading/comment/{comment}', [TradingController::class, 'updateComment'])->name('trading.comment.update');
    Route::post('/rating/{item_id}', [TradingController::class, 'storeRating'])->middleware('auth')->name('trading.rating.store');
});