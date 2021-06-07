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

Route::get('/', 'Admin\DashboardController@index');
Route::get('/book', 'Admin\BookController@index');
Route::post('/book', 'Admin\BookController@store');
Route::get('/book/{book}', 'Admin\BookController@edit');
Route::put('/book/{book}', 'Admin\BookController@update');
Route::delete('/book/{book}', 'Admin\BookController@delete');

Route::get('/user', 'Admin\UserController@index');
Route::put('/user', 'Admin\UserController@update');

Route::get('/transaction', 'Admin\TransactionController@index');
Route::put('/transaction', 'Admin\TransactionController@update');
// Route::get('/user/{user}', 'Admin\UserController@index');
