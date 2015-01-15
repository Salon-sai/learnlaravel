<?php




namespace App\Controllers\Customer;

use Input, Log;

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

			$RX_TYPE = trim($postObj->MsgType);

			switch ($RX_TYPE) {
				case 'event':
					$this->RequestEvent($postObj);
					break;
				
				case 'text':
					$this->RequestText($postObj);
					break;
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

	private function RequestText($postObj){
		$keyword = trim($postObj->Content);
		switch ($keyword) {
			case 'index':
				return $this->ResponsePictureAndLink($postObj->FromUserName,
					$postObj->ToUserName);
				break;

			default:
				return $this->ResponseText($postObj->FromUserName,
					$postObj->ToUserName, "Welcome To Food Order");
				break;
		}
	}

	private function RequestEvent($postObj){
		switch ($postObj->Event) {
			case 'subscribe':
				return ResponeText($postObj->FromUserName, 
						$postObj->ToUserName, "Welcome To Food Order");
				break;
			
			default:
				# code...
				break;
		}
	}

	private function ResponseText($FromUserName, $ToUserName, $ResponseText){
			try{
				$time 			= time();
				$textTpl		= "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[text]]></MsgType>
									<Content><![CDATA[%s]]></Content>
									</xml>"; 
				Log::info('FromUserName :'.$FromUserName.' ToUserName :'.$ToUserName.' ResponseText :'.$ResponseText);
				$resultStr	= sprintf($textTpl, $FromUserName,
					$ToUserName, $time, $ResponseText);
				Log::info('success return xml to weichat');
				Log::info('result is : '.$resultStr);
				return $resultStr;
			}catch(\Exception $e){
				Log::error($e);
			}
			
	}

	private function ResponLocation($postObj){

	}
	
	private function ResponseVoice($postObj){

	}

	private function ResponsePictureAndLink($FromUserName, $ToUserName){
		$time 		= time();
		$textTpl 	= "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						</Articles>
						</xml>";
		$title 		= "Index";
		$Descrption = "Welcome to Food Order";
		$PicUrl 	= "http://104.237.155.177/pic/TestDemo.jpg";
		$Url 		= "http://104.237.155.177/r";
		$resultStr	= sprintf($textTpl, $FromUserName, $ToUserName,
			$time, $title, $Description, $PicUrl, $Url);
		return $resultStr;
	}

}