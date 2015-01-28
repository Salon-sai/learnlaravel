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

Route::resource('register', 'App\Controllers\Restaurant\RegisterController',
	array('only' => array('create', 'store')));

Route::get('register/auth/{code}/{id}', array(
	'as'	=> 'register.auth',
	'uses'	=> 'App\Controllers\_Default\AuthController@EmailConfirm'
));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function(){
	Route::any('/', 'App\Controllers\Admin\RestaurantController@index');
	Route::resource('restaurant', 'App\Controllers\Admin\RestaurantController');
	Route::resource('profile', '');
});

Route::group(array('prefix' => 'r', 'before' => array('auth.restaurant', 'auth.restaurant.description')), function(){
	Route::any('/', 'App\Controllers\Restaurant\OrderController@index');
	Route::resource('order', 'App\Controllers\Restaurant\OrderController',
		array('expect' => array('create', 'store')));
	Route::resource('food', 'App\Controllers\Restaurant\FoodController');
	Route::resource('category', 'App\Controllers\Restaurant\CategoryController');
	Route::resource('description', 'App\Controllers\Restaurant\DescriptionController');
	Route::get('order/find/{type}/{id}', array(
		'as'	=> 'r.order.find',
		'uses'	=> 'App\Controllers\Restaurant\OrderController@findOrderByType'
	));
	Route::get('advanced', array(
		'as' 	=> 'r.advanced',
		'uses'	=> 'App\Controllers\Restaurant\DescriptionController@advancedSetting'
	));
	Route::post('change', array(
		'as' 	=> 'r.status.change',
		'uses' 	=> 'App\Controllers\Restaurant\DescriptionController@changestatus'
	));
	Route::post('food/change', array(
		'as'	=> 'r.food.status.change',
		'uses' 	=> 'App\Controllers\Restaurant\FoodController@changestatus'
	));
	Route::post('order/accept', array(
		'as' 	=> 'r.order.accept',
		'uses'	=> 'App\Controllers\Restaurant\OrderController@acceptOrder'
	));
	Route::post('order/refuse', array(
		'as' 	=> 'r.order.refuse',
		'uses'	=> 'App\Controllers\Restaurant\OrderController@refuseOrder'
	));
});

Route::group(array('prefix' => 'u', 'before' => array('weixin.check.echostr', 'weixin.check.oauth')), function(){
	Route::post('/', 'App\Controllers\Customer\WeiChatController@index');
	Route::get('/restaurant/locationIndex', 'App\Controllers\Customer\RestaurantController@getRestaurantByLocation');
	Route::resource('oauth', 'App\Controllers\_Default\OAuthController');
	Route::resource('/checkSignature', 'App\Controllers\Customer\CheckController');
	Route::any('text', 'App\Controllers\Customer\CheckController@textMessage');
	Route::resource('r', 'App\Controllers\Customer\RestaurantController');
	Route::resource('order','App\Controllers\Customer\OrderController');
	Route::resource('contact', 'App\Controllers\Customer\ContactController');
	Route::delete('delete/foodinorder', array(
		'as' 	=> 'u.order.food.delete',
		'uses' 	=> 'App\Controllers\Customer\OrderController@foodDelete'
	));
});

Route::group(array('prefix' => 'test'), function(){
	Route::resource('cache', 'App\Controllers\_Default\CacheController');
	Route::resource('session', 'App\Controllers\_Default\SessionController');
	Route::get('gmail_test', function(){
		$address 	= Config::get('mail.username');
		Log::info('In the route : '.$address);
		$data		= array('token'	=> '123456');
		Mail::send('emails.auth.reminder', $data, function($message) use ($address){
			Log::info('In the Mail : '.$address);
			$message->from($address, 'FoodOrder');

			$message->to($address)->subject('Laravel Mail By Gmail');
		});
		return 'success';
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


