<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['namespace' => 'Admin','prefix' => 'admin'], function()
{
	Route::controller('item','ItemController');
	Route::controller('gemstone','GemstoneController');
	Route::controller('metal','MetalController');
	Route::controller('category','CategoryController');
	Route::controller('collection','CollectionController');
	Route::controller('user','UserController');
	Route::controller('slider','SliderController');
	Route::controller('blog', 'BlogController');
	Route::controller('gallery', 'GalleryController');
	Route::controller('order', 'OrderController');
    Route::post('order/edit-order-status', 'OrderController@postEditOrderStatus');
});

Route::group(['namespace' => 'User'], function()
{
	Route::controller('cart', 'CartController');
	Route::controller('favorites', 'FavoritesController');
	Route::controller('item', 'ItemController');
	Route::controller('order', 'OrderController');
	Route::controller('blog', 'BlogController');
	Route::controller('collection', 'CollectionController');
});

Route::controller('admin','AdminController');

Route::controller('user', 'UserController');
Route::get('/', 'UserController@getIndex');
Route::post('/get-newsletter', 'UserController@getNewsLetter');
Route::get('/home', 'HomeController@index');
Route::controller('payment', 'PaymentController');

