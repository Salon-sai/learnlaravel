<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('auth.admin', function(){
	if(Sentry::getUser()){
		if(!Sentry::check() || !Sentry::getUser()->hasAccess('manager')){
			return Redirect::to('login/admin');
		}
	}else{
		return Redirect::to('login/admin');
	}
});

Route::filter('auth.restaurant', function(){
	if(Sentry::getUser()){
		if(!Sentry::check() || !Sentry::getUser()->hasAccess('restaurant')){
			return Redirect::to('login/r');
		}
	}else{
		return Redirect::to('login/r');
	}
});

Route::filter('auth.restaurant.description', function(){
	if(!Sentry::getUser()->description && 
		!Request::is('r/description') && 
		!Request::is('r/description/create')){
			return Redirect::route('r.description.create');
	}
});

Route::filter('weixin.add.JSAPI', function(){
	if(!Request::ajax() && !Input::get('Hasget')){
		$js_service 	= new JSSDKService;
		$signPackage	= $js_service->getSignPackage();
		Log::info('get the js api');
		return Redirect::to(Request::fullUrl())->withInput()
			->with(array(
					'Hasget'		=> true,
					'signPackage'	=> $signPackage
				));
	}
});


Route::filter('weixin.check.echostr', function(){
	if(Input::get('echostr')){
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

		if($tmpStr != $signature){
			return false;
		}
		return Input::get('echostr');
	}
});

Route::filter('weixin.check.oauth', function(){
	if(Input::get('code')){
		Log::info('It is weichat login the web');
		if(!Session::get('openid')){
			try{
				Log::info('the first time login the subscribe');
				$oauth		= new OAuthService;
				$openid		= $oauth->getOpenid();
				Session::put('openid', $openid);
			}catch(\Exception $e){
				Log::info($e);
				Log::info('the code is validate');
				return 'the code is validate';
			}
		}
		Log::info('success to get the openid');
		Log::info('the openid is '.Session::get('openid'));
	}else if(!Session::get('openid')){
		//temporary create openid to you and it is not invalidate.
		$poststr 		= file_get_contents("php://input");
		$postObj		= simplexml_load_string($poststr, 'SimpleXMLElement', LIBXML_NOCDATA);
		if(!$postObj){//not come from weichat server
			Log::info("success to add 'test' into openid for testing the web");
			Session::put('openid', 'test');
			Log::info('success to get the openid and openid is test');
		}else{
			Log::info('the request comes from weichat server and the openid is '.$postObj->FromUserName);
		}
	}
	
});