<?php

namespace App\Controllers\_Default;

use BaseController, Input, Log;

define('ACCESS_TOKEN_URL', 
	"https://api.weixin.qq.com/sns/oauth2/access_token?
	appid=wx6b67feeba41a14f3&
	secret=29943ae5d7b778c9761961156baf5e31&
	code=%s&grant_type=authorization_code");
class OAuthController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /_default\oauth
	 *
	 * @return Response
	 */
	public function index()
	{
		$code = Input::get('code');
		if($code)
			try{
				Log::info('code is : '.$code);
				$resultURL 	= sprintf(ACCESS_TOKEN_URL, $code);
				Log::info('ACCESS_TOKEN_URL is '.$resultURL);
				$content 	= file_get_contents($resultURL);
				Log::info('success to get ACCESS_TOKEN');
				return $content;
			}catch(\Exception $e){
				Log::error($e);
			}
		else
			return 'NO CODE';
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /_default\oauth/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /_default\oauth
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /_default\oauth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /_default\oauth/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /_default\oauth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /_default\oauth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}