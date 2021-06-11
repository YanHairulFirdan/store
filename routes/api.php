<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('/books', 'BookController');
Route::resource('/categories', 'CategoryController');
Route::resource('/cities', 'CityController');
Route::get('/district/{regency}', 'DistrictController@index');
// Route::get('/books', 'BookController@index');
// Route::post('/books', 'BookController@store');
// Route::get('/books/{book}', 'BookController@show');

Route::middleware('auth:web')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/cart/update/{cart}', 'FrontEnd\CartController@updateCart')->middleware('auth:web');
