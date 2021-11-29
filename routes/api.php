<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\AuthenticationController;
use App\Models\Discount;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/page/home', [PageController::class, 'home']);
Route::get('/page/menu', [PageController::class, 'menu']);
Route::get('/page/gift-cards', [PageController::class, 'gift_cards']);
Route::get('/page/gallery', [PageController::class, 'gallery']);
Route::get('/product/{slug}', [PageController::class, 'product']);

Route::apiResource('shopping-cart', ShoppingCartController::class)->only([
    'index', 'store', 'destroy'
]);

Route::get('/shopping-cart/apply-cupon-discount', [ShoppingCartController::class, 'apply_cupon_discount']);
Route::get('/shopping-cart/remove-cupon-discount', [ShoppingCartController::class, 'remove_cupon_discount']);


Route::get('/discount-availables', function (Request $request) {
    return Discount::get(['code'])->random(5);
});


Route::prefix('auth')->group(function () {
    //register new user
    Route::post('/register', [AuthenticationController::class, 'register']);
    //login user
    Route::post('/login', [AuthenticationController::class, 'login']);
    //using middleware
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::get('/profile', function (Request $request) {
            return auth()->user();
        });
        Route::post('/logout', [AuthenticationController::class, 'logout']);

        Route::put('/user/profile-information', [AuthenticationController::class, 'profile_information']);

        Route::put('/user/password', [AuthenticationController::class, 'update_user_password']);
    });
});
