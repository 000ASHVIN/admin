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
    return view('auth/login');
});

Route::get('/ecommerce/login', function () {
    return view('ecommerce/auth/login');
});

Route::get('/ecommerce/register', function () {
    return view('ecommerce/auth/register');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard/index', 'DashboardController@index')->name('dashboard.index')->middleware('verified');

//for category crud model
// Route::get('/login', 'Auth\LoginController@index');
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
Route::get('/paginate/{paginate}', 'ProductsController@paginateProducts');


//for users crud model
Route::get('/user/index', 'UserController@index');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::patch('/user/{user}', 'UserController@updatePassword');
Route::get('/user/{user}/block', 'UserController@blockUser');
Route::get('/user/{user}/unblock', 'UserController@unblockUser');

//for ecommerce login crud model
Route::get('/ecommerce', 'EcommerceController@index');
Route::post('/elogin', 'EcommerceController@login');
Route::get('/logout', 'EcommerceController@logout');

Route::get('/ecommerce/category', 'EcommerceController@showCategory');
Route::get('/category/{category}/product', 'EcommerceController@showCategoryProduct');

//show perticular product
Route::get('/ecommerce/product/{products}', 'EcommerceController@show');

//cart 
Route::get('/cartitem', 'CartItemController@index');
Route::post('/cartitem/store/{products}', 'CartItemController@store');
Route::patch('/cartitem/update/{cartitem}', 'CartItemController@update');
Route::delete('/cartitem/destroy/{cartitem}', 'CartItemController@destroy');

# PayPal checkout
Route::get('/checkout', 'PaypalController@payWithpaypal')->name('checkout');

# PayPal status callback
Route::get('status', 'PaypalController@getPaymentStatus');

Route::get('/createOrder', 'CreateOrder@createOrder');


//order in admin
//cart 
Route::get('/order/index', 'OrderController@index');
Route::post('/order/search', 'OrderController@search');
Route::post('/order/searchpaginate', 'OrderController@searchPaginate');
Route::get('/order/approve/{order}', 'OrderController@approve');
Route::get('/order/discard/{order}', 'OrderController@discard');

Route::get('/order/today', 'OrderSortByDate@today');
Route::get('/order/week', 'OrderSortByDate@week');
Route::get('/order/month', 'OrderSortByDate@month');
Route::get('/order/year', 'OrderSortByDate@year');
Route::post('/order/sortbydate', 'OrderSortByDate@sortbydate');

Route::get('/order/{order}', 'OrderController@show');

Route::get('/order/approveMail/{order}', 'ApproveMailController@approve');