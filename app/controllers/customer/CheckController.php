<?php




namespace App\Controllers\Customer;

use Input;

define('TOKEN', 'FoodOrder');
class CheckController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer/check
	 *
	 * @return Response
	 */
	public function index()
	{
		$postStr 	= file_get_contents("php://input");
		// $postStr	= $GLOBALS["HTTP_RAW_POST_DATA"];
		// $postStr	= Input::get('HTTP_RAW_POST_DATA');

		if(!empty($postStr)){
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername 	= $postObj->FromUserName;
			$toUsername		= $postObj->ToUserName;
			$keyword		= trim($postObj->Content);
			$time 			= time();
            $textTpl		= "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<MsgId>1234567890123456</MsgId>
							</xml>"; 
			if(!empty($keyword)){
				$MsgType	= "text";
				$contentStr = "Welcome to Food Order";
				$resultStr	= sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $contentStr);
				return $resultStr;
			}else{
				return 'cao ni ma';
			}
		}else {
			return 'ni ma bi';
		}
		// return $this->textMessage();
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

	public function textMessage(){

	}

}