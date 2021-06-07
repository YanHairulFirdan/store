<?php

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

// Route::get('{any}', function () {
//     return view('layouts.app');
// })->where('any', '.*');

Auth::routes();
//routes for frontend or user
Route::get('/', 'Frontend\BookController@index')->name('books');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/books/details/{book}', 'Frontend\BookController@details')->name('book.details');
Route::get('/books/category/{category}', 'Frontend\BookController@getByCategory')->name('book.category');

// for add cart
Route::post('/cart/add', 'Frontend\CartController@addBook')->name('cart.add')->middleware('auth');
Route::get('/carts', 'Frontend\CartController@index')->name('cart.index')->middleware('auth');
// for order
Route::post('/order', 'Frontend\CartController@addBook')->name('order')->middleware('auth');
Route::post('/input-order', 'Frontend\CartController@inputOrder')->name('input.order')->middleware('auth');

Route::get('/profile-checkout', 'Frontend\CartController@profileCheckout')->name('profile.checkout')->middleware('auth');
Route::post('/profile-checkout', 'Frontend\CartController@saveProfileCheckout')->name('profile.checkout')->middleware('auth');

Route::get('/delivery-type', 'Frontend\CartController@showDeliveryType')->name('checkout.delivery')->middleware('auth');
Route::post('/delivery-type', 'Frontend\CartController@saveDeliveryType')->name('checkout.delivery')->middleware('auth');

Route::get('/payment-type', 'Frontend\CartController@showPaymentType')->name('checkout.payment')->middleware('auth');
Route::post('/payment-type', 'Frontend\CartController@savePaymentType')->name('checkout.payment')->middleware('auth');

Route::get('/checkout-review', 'Frontend\CartController@showreview')->name('checkout.review')->middleware('auth');

Route::get('/checkout', 'Frontend\CartController@checkout')->name('checkout')->middleware('auth');

Route::post('/input-order', 'Frontend\CartController@inputOrder')->name('input.order')->middleware('auth');

Route::get('/transactions', function () {
    echo 'this route for show all user transactions';
})->name('transaction.index');
//end of routes for frontend or user
