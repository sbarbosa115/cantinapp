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
Route::get('/js/lang.js', function () {
    $files = ['frontend'];
    $strings = [];
    foreach ($files as $file) {
        $strings[$file] = trans($file);
    }
    return response('window.i18n = '.json_encode($strings).';')->header('Content-Type', 'application/javascript');
})->name('assets.lang');

Route::name('restaurant.')->prefix('restaurant')->namespace('Restaurant')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('logout/', 'Auth\LoginController@logout')->name('logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ForgotPasswordController@reset')->name('password.request.reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::name('restaurant.')->prefix('restaurant')->namespace('Restaurant')->middleware(['employee'])->group(function () {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('/product', 'ProductController@index')->name('product.index');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/create', 'ProductController@store')->name('product.store');
    Route::get('/product/edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('/product/edit/{product}', 'ProductController@update')->name('product.update');
    Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.delete');
    Route::get('/product/sides/{product}', 'ProductController@sides')->name('product.sides');
    Route::get('/product/change/status/{status}/{product}', 'ProductController@changeStatus')->name('product.change.status');

    Route::get('/order', 'OrdersController@index')->name('orders.index');
    Route::get('/order/detail/{id}', 'OrdersController@detail')->name('orders.detail');
    Route::get('/order/print/{id}', 'OrdersController@print')->name('orders.print');
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

    Route::get('/my-account', 'AccountController@index')->name('account.index');
    Route::post('/my-account', 'AccountController@update')->name('account.update');
});

Route::name('frontend.')->namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register.create');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request.reset');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
});

Route::name('frontend.')->namespace('Frontend')->middleware('auth')->group(function () {
    Route::get('order', 'OrderController@index')->name('order.index');
    Route::post('order', 'OrderController@store')->name('order.store');
    Route::get('my-profile', 'HomeController@profile')->name('order.profile');
});

