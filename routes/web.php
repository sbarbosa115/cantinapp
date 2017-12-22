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

Route::get('/restaurant', 'Restaurant\HomeController@index')->name('restaurant.index');
Route::get('/restaurant/create', 'Restaurant\HomeController@create')->name('restaurant.create');
Route::post('/restaurant/create', 'Restaurant\HomeController@store')->name('restaurant.store');

Route::get('/api/candidates', 'HomeController@getCandidates');
