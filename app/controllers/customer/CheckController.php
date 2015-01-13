<?php


define('TOKEN', 'FoodOrder');

namespace Customer;

class CheckController extends /BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer/check
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer/check/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer/check
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /customer/check/{id}
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
	 * GET /customer/check/{id}/edit
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
	 * PUT /customer/check/{id}
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
	 * DELETE /customer/check/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function checkSignature(){
		//微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。 
		$signature 		= Input::get('signature');
		//时间戳 
		$timestamp 		= Input::get('timestamp');
		//随机数 
		$nonce			= Input::get('nonce');

		$token 			= TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if($tmpStr == $signature){
			return true;
		}else{
			return false;
		}
	}

}