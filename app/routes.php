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
// define('TOKEN', 'FoodOrder');

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

Route::group(array('prefix' => 'u'), function(){
	Route::get('/checkSignature', function(){
		//微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。 
		$signature 		= Input::get('signature');
		//时间戳 
		$timestamp 		= Input::get('timestamp');
		//随机数 
		$nonce			= Input::get('nonce');

		$token 			= 'FoodOrder';
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if($tmpStr == $signature){
			return true;
		}else{
			return false;
		}
	});
});

Route::get('logout', array(
	'as'	=> 'logout',
	'uses'	=> 'App\Controllers\_Default\AuthController@Logout'
));

Route::get('/', function()
{
	return View::make('hello');
});


