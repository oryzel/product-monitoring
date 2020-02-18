<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('submit');
});

Route::get('/list-product', function () {
    return view('list-product');
});

Route::get('/product-history/{id}', function () {
    return view('product-history');
});

Route::group(['prefix' => 'api', 'as' => 'api'], function () {

    Route::get('/', 'ProductController@getList');
    Route::get('/{id}', 'ProductController@get');
    Route::post('/', 'ProductController@create');

    Route::get('/{id}/history', 'ProductPriceHistoryController@getList');
    Route::get('/{id}/history-chart', 'ProductPriceHistoryController@getChart');
    Route::get('/{id}/photo', 'ProductPhotoController@getList');
});

Route::prefix('/crawler')->group(function () {
    Route::get('/price', 'ProductPriceHistoryController@create');
});
