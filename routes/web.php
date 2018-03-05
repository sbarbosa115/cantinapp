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

Route::group(['prefix' => '99', 'as' => 'restaurant.', 'namespace' => 'Restaurant'], function () {

    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('/product', 'ProductController@index')->name('product.index');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/create', 'ProductController@store')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/product/edit/{id}', 'ProductController@update')->name('product.update');
    Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete');

    Route::get('/order', 'OrdersController@index')->name('orders.index');
    Route::get('/order/detail/{id}', 'OrdersController@detail')->name('orders.detail');
    Route::post('/order/status/{id}', 'OrdersController@status')->name('orders.status');
    Route::get('/order/change/{id}/{status}', 'OrdersController@change')->name('orders.change');

    Route::get('/employee', 'EmployeeController@index')->name('employee.index');
    Route::get('/employee/create', 'EmployeeController@create')->name('employee.create');
    Route::post('/employee/create', 'EmployeeController@store')->name('employee.store');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::patch('/employee/edit/{id}', 'EmployeeController@update')->name('employee.update');
    Route::delete('/employee/delete/{id}', 'EmployeeController@destroy')->name('employee.delete');

    Route::get('/balance', 'BalanceController@index')->name('balance.index');
    Route::get('/balance/create/{id}', 'BalanceController@create')->name('balance.create');
    Route::post('/balance/store', 'BalanceController@store')->name('balance.store');
    Route::get('/balance/log/{id}', 'BalanceController@log')->name('balance.log');

    Auth::routes();

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('logout/', 'Auth\LoginController@logout')->name('logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ForgotPasswordController@reset')->name('password.request.reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ForgotPasswordController@showResetForm')->name('password.reset');
});


Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    Route::get('/profile', 'HomeController@profile')->name('home.profile');

    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register.create');
    Route::get('logout/', 'Auth\LoginController@logout')->name('logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ForgotPasswordController@reset')->name('password.request.reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ForgotPasswordController@showResetForm')->name('password.reset');


    Route::get('order', 'OrderController@show')->name('order.show');
    Route::post('order', 'OrderController@store')->name('order.store');
    Route::get('order/add/{id}', 'OrderController@product')->name('order.add');
    Route::post('order/add/product', 'OrderController@addProduct')->name('order.add.product');
    Route::get('order/confirm', 'OrderController@confirmTime')->name('order.confirm');
    Route::get('order/check/balance/{id}', 'OrderController@checkBalance')->name('order.check.balance');


    Route::get('api/categories', 'TaxonomyController@categories')->name('taxonomies.categories');
    Route::get('api/order/products', 'OrderController@products')->name('order.products');
});



