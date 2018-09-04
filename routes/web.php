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

Route::get('/', 'MainController@index')->name('public.index');

// about credits ... pages
Route::get('/page/{id}', 'MainController@pages')->name('public.page');

// product public routes
Route::get('/product/category/{id}', 'MainController@showProductsByCategory')->name('public.category.product');
Route::get('product/full-view/{id}', 'MainController@productFullView')->name('public.product.fullView');

// search 
Route::get('/product/search/', 'MainController@search')->name('public.product.search');

// cart routes
Route::get('/add-to-cart/{id}', 'MainController@addToCart')->name('public.addToCart');
Route::get('/cart', 'MainController@getCart')->name('public.cart');
Route::get('/cart/delete', 'MainController@deleteCart')->name('public.cart.delete');
Route::get('/cart/delete-item/{id}', 'MainController@deleteCartItem')->name('public.cart.deleteItem');
Route::post('/cart/add-product-quantity/{id}', 'MainController@addProductQuantity')->name('public.cart.addProductQuantity');

// payment on delivery routes
Route::get('/cart/payment-on-delivery', 'MainController@paymentOnDelivery')->name('public.paymentOnDelivery');
Route::post('/cart/checkout', 'MainController@checkout')->name('public.checkout');

// paypal routes
Route::get('/cart/pay-with-paypal', 'PayPalController@payWithPaypal')->name('public.payWithPaypal');
Route::post('/cart/paypal-checkout', 'PayPalController@checkoutPaypal')->name('public.checkoutPaypal');
Route::get('/paypal-payment-status', 'PayPalController@getPaymentStatus')->name('public.getPaymentStatus');

Auth::routes();

// Users
Route::get('/home', 'HomeController@index')->name('user.home');
Route::post('/home/{id}', 'HomeController@changeUserDetails')->name('user.change');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

// Main administrator
Route::prefix('admin')->group(function() {

	// login and logout admin
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	// Password resset
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

	// add new product 
	Route::get('/product/create', 'ProductController@create')->name('admin.product.create');
	Route::post('/product/create', 'ProductController@store')->name('admin.product.store');

	// show products by category
	Route::get('/product/{id}/show', 'ProductController@show')->name('admin.product.show');
	Route::get('/product/{id}/full-view', 'ProductController@fullView')->name('admin.product.fullView');

	// delete product
	Route::delete('/product/{id}/show', 'ProductController@destroy')->name('admin.product.destroy');

	// edit and update product
	Route::get('/product/{id}/edit', 'ProductController@edit')->name('admin.product.edit');
	Route::post('/product/{id}', 'ProductController@update')->name('admin.product.update');


	// pages 
	Route::get('/page', 'PageController@index')->name('admin.page.index');
	Route::get('/page/{id}/show', 'PageController@show')->name('admin.page.show');
	Route::get('/page/create', 'PageController@create')->name('admin.page.create');
	Route::post('/page/create', 'PageController@store')->name('admin.page.store');
	Route::get('/page/{id}/edit', 'PageController@edit')->name('admin.page.edit');
	Route::post('/page/{id}', 'PageController@update')->name('admin.page.update');
	Route::delete('/pages/{id}', 'PageController@destroy')->name('admin.page.destroy');

	// orders 
	Route::get('/all-orders/{param?}', 'OrderController@index')->name('admin.order.index');
	Route::get('/order/show/{id}', 'OrderController@show')->name('admin.order.show');
	Route::post('/order/shipped/{id}', 'OrderController@changeOrderStatus')->name('admin.order.shipped');
});
