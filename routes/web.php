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

// Auth::routes();
//routes for frontend or user
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/books', 'Frontend\BookController@index')->name('books');
Route::get('/books/details/{book}', 'Frontend\BookController@details')->name('book.details');
Route::get('/books/category/{category}', 'Frontend\BookController@getByCategory')->name('book.category');
//end of routes for frontend or user
