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



//nanti akan diganti oleh worker
Route::get('/crawler', 'ProductPriceHistoryController@create');
Route::get('/crawler2/{id}', 'CrawlerController@getName');
Route::get('/crawler3/{id}', 'CrawlerController@getDescription');
Route::get('/crawler4/{id}', 'CrawlerController@getPhoto');

Route::get('/', 'ProductController@getList');
Route::get('/{id}', 'ProductController@get');
Route::post('/', 'ProductController@create');

Route::get('/{id}/history', 'ProductPriceHistoryController@getList');
Route::get('/{id}/photo', 'ProductPhotoController@getList');
