<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login/{type}',array(
	'as'	=> 'get.login',
	'uses'	=> 'App\Controllers\_Default\AuthController@getLogin'
));

Route::post('login/{type}',array(
	'as'	=> 'post.login',
	'uses'	=> 'App\Controllers\_Default\AuthController@postLogin'
));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function(){
	Route::any('/', 'App\Controllers\Admin\RestaurantController@index');
	Route::resource('restaurant', 'App\Controllers\Admin\RestaurantController');
	Route::resource('profile', '');
});

Route::group(array('prefix' => 'r', 'before' => 'auth.restaurant'), function(){
	Route::any('/', 'App\Controllers\Restaurant\OrderController@index');
	Route::resource('order', 'App\Controllers\Restaurant\OrderController');
	Route::resource('food', 'App\Controllers\Restaurant\FoodController');
	Route::resource('category', 'App\Controllers\Restaurant\CategoryController');
	Route::resource('description', 'App\Controllers\Restaurant\DescriptionController');
	Route::get('order/check', array(
		'as'	=> 'r.order.check',
		'uses'	=> 'App\Controllers\Restaurant\OrderController@checkOrder'
	));
	Route::get('order/finshed', array(
		'as'	=> 'r.order.finshed',
		'uses'	=> 'App\Controllers\Restaurant\OrderController@finishedOrder'
	));
	Route::get('advanced', array(
		'as' 	=> 'r.advanced',
		'uses'	=> 'App\Controllers\Restaurant\DescriptionController@advancedSetting'
	));
	Route::post('change/{id}', array(
		'as' 	=> 'r.status.change',
		'uses' 	=> 'App\Controllers\Restaurant\DescriptionController@changestatus'
	));
	Route::post('food/change', array(
		'as'	=> 'r.food.status.change',
		'uses' 	=> 'App\Controllers\Restaurant\FoodController@changestatus'
	));
});

Route::get('logout', array(
	'as'	=> 'logout',
	'uses'	=> 'App\Controllers\_Default\AuthController@Logout'
));

Route::get('/', function()
{
	return View::make('hello');
});


