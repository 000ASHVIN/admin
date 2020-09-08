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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard/index', 'DashboardController@index')->name('dashboard.index')->middleware('verified');

//for category crud model
Route::get('/dashboard/category', 'CategoryController@index');
Route::get('/category/create', 'CategoryController@create');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{category}/edit', 'CategoryController@edit');
Route::patch('/category/{category}', 'CategoryController@update');
Route::delete('/category/{category}', 'CategoryController@destroy');

//for products crud model
Route::get('/products/index', 'ProductsController@index');
Route::get('/products/create', 'ProductsController@create');
Route::post('/products', 'ProductsController@store');
Route::get('/products/{products}/edit', 'ProductsController@edit');
Route::patch('/products/{products}', 'ProductsController@update');
Route::delete('/products/{products}', 'ProductsController@destroy');
Route::get('/products/{category}', 'ProductsController@show');