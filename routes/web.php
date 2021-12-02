<?php

use App\Http\Livewire\User\ListUsers;
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

        //Route::get('/galleries', ListGalleries::class)->name('galleries');

        //Route::get('/blog', ListPosts::class)->name('blog');
        //Route::get('/tags', ListTags::class)->name('tags');
        //Route::get('/pages', ListPages::class)->name('pages');
        //Route::get('/discounts', ListDiscount::class)->name('discounts');
    });
