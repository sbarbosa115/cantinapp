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

Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
    Route::get('/login', 'Restaurant\LoginController@index')->name('index.index');
    Route::post('/login', 'Restaurant\LoginController@login')->name('index.login');

    Route::get('/product', 'Restaurant\ProductController@index')->name('product.index');
    Route::get('/product/create', 'Restaurant\ProductController@create')->name('product.create');
    Route::post('/product/create', 'Restaurant\ProductController@store')->name('product.store');
    Route::get('/product/edit/{id}', 'Restaurant\ProductController@edit')->name('product.edit');
    Route::post('/product/edit/{id}', 'Restaurant\ProductController@update')->name('product.update');
    Route::delete('/product/delete/{id}', 'Restaurant\ProductController@destroy')->name('product.delete');
    

    Route::get('/order', 'Restaurant\OrdersController@index')->name('orders.index');
    Route::get('/order/detail/{id}', 'Restaurant\OrdersController@detail')->name('orders.detail');
    Route::post('/order/status/{id}', 'Restaurant\OrdersController@status')->name('orders.status');
    Route::get('/order/change/{id}/{status}', 'Restaurant\OrdersController@change')->name('orders.change');

});
