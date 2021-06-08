<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Routing\Route;

// use Illuminate\Routing\Route;

Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
Route::resource('book', 'Admin\BookController');
// Route::get('/book', 'Admin\BookController@index')->name('admin.book.index');
// Route::post('/book', 'Admin\BookController@store');
// Route::get('/book/{book}', 'Admin\BookController@edit');
// Route::put('/book/{book}', 'Admin\BookController@update');
// Route::delete('/book/{book}', 'Admin\BookController@delete');

Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
Route::put('/user', 'Admin\UserController@update');

Route::get('/transaction', 'Admin\TransactionController@index')->name('admin.transaction.index');
Route::put('/transaction', 'Admin\TransactionController@update');
// Route::get('/user/{user}', 'Admin\UserController@index');
