<?php

use App\Http\Livewire\Category\ListCategories;
use App\Http\Livewire\GiftCard\ListGiftCard;
use App\Http\Livewire\Product\ListProducts;
use App\Http\Livewire\User\ListUsers;
use App\Http\Livewire\DiscountCode\ListDiscountCode;
use App\Http\Livewire\Example;
use App\Http\Livewire\Gallery\ListGallery;
use App\Http\Livewire\Page\ListPage;
use App\Http\Livewire\Promo\ListPromo;
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

Route::get('/', function () {
    return view('welcome');
});




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('home');

        Route::get('/users', ListUsers::class)->name('users');
        Route::get('/categories', ListCategories::class)->name('categories');
        Route::get('/products', ListProducts::class)->name('products');
        Route::get('/gift_card', ListGiftCard::class)->name('gift_card');
        Route::get('/discount_code', ListDiscountCode::class)->name('discount_code');
        Route::get('/gallery', ListGallery::class)->name('gallery');
        Route::get('/page', ListPage::class)->name('page');
        Route::get('/promo', ListPromo::class)->name('promo');


        //Route::get('/galleries', ListGalleries::class)->name('galleries');

        //Route::get('/blog', ListPosts::class)->name('blog');
        //Route::get('/tags', ListTags::class)->name('tags');
        //Route::get('/pages', ListPages::class)->name('pages');
        //Route::get('/discounts', ListDiscount::class)->name('discounts');
    });
