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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product', 'ProductController@index')->name('product');
Route::post('/productadd', 'ProductController@store');
Route::post('/productdelete', 'ProductController@delete')->name('product.delete');
Route::post('/productedit', 'ProductController@update');
Auth::routes();
Route::get('/productlist', 'ProductlistController@index');
Route::post('/productlistupdate', 'ProductlistController@update');
//Route::get('/home', 'HomeController@index')->name('home');


