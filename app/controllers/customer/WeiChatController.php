<?php

namespace App\Controllers\Customer;

use Input, Log, BaseController, Cache, Order, Session, Customer;

define('ACCESS_TOKEN_URL',
	"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6b67feeba41a14f3&secret=29943ae5d7b778c9761961156baf5e31");
define('GET_USER_BASE',
	"https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=%s");
class WeiChatController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer/weichat
	 *
	 * @return Response
	 */
	public function index()
	{
		$poststr 	= file_get_contents("php://input");
		$postObj 	= simplexml_load_string($poststr, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $this->judgeType($postObj);
	}

	private function judgeType($postObj){
		$RX_TYPE 	= $postObj->MsgType;
		switch ($RX_TYPE) {
			case 'event':
				return $this->RequestEvent($postObj);
				break;
			case 'text':
				return $this->RequestText($postObj);
				break;
			case 'image':
				return $this->RequestImage($postObj);
				break;
			case 'voice':
				return $this->RequestVoice($postObj);
				break;
			case 'voide':
				return $this->RequestVideo($postObj);
				break;
			case 'location':
				return $this->RequestLocation($postObj);
				break;
			default :
				return $this->RequestText($postObj);
		}
	}

	private function RequestEvent($postObj){
		$content = "";
		switch ($postObj) {
			case 'CLICK':
				switch ($postObj->EventKey) {
					case 'getOrders':{
						$opendid 	= null;
						$resulttext	= '';
						if(Session::has('openid')){
							$openid = Session::get('openid');
						}else{
							$openid = getOpenid();
						}						
						$orders 	= $this->getOrders($openid);
						if(empty($orders)){
							$resulttext 	+= 'These is no order for you'
						}else{
							foreach ($orders as $order) {
								$resulttext 	+= 'order id is : '.$order->id.' status is : '
								switch ($order->status) {
									case -2 :
										$resulttext += 'need confirm /n';
										break;
									case -1 :
										$resulttext += 'watting restaurant accept /n';
										break;
									case 0 :
										$resulttext += 'restaurant refuse your order /n';
										break;
									case 1 :
										$resulttext += 'delivering /n';
										break;
									default:
										# code...
										break;
								}
								foreach ($order->foods as $food) {
									$resulttext += 'The food name : '.$food->name.' quantity is : '
									.$food->pivot->quantity.' the pirce is : '.$food->price.'/n';
								}
								$resulttext 	+= 'the total is : '.$order->total.' /n';
							}
						}
						return $this->ResponseText($postObj->FromUserName, 
							$postObj->ToUserName, $resulttext);
						break;						
					}
					default:
						# code...
						break;
				}
				break;
			
			default:
				# code...
				break;
		}
	}

	private function RequestText($postObj){
		$FromUserName 		= $postObj->FromUserName;
		$ToUserName 		= $postObj->ToUserName;
		$keyword 			= $postObj->Content;
		switch ($keyword) {
			case 'index':
				$Title  		= 'Index';
				$Description 	= 'Welcome to Food Order';
				$PicUrl 		= 'http://104.237.155.177/pic/TestDemo.jpg';
				$Url 			= 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67feeba41a14f3&redirect_uri=http://104.237.155.177/u/r&response_type=code&scope=snsapi_base#wechat_redirect';
				return $this->ResponsePictureAndLink($FromUserName, $ToUserName, 
			array(
					array(
							'Title' 		=> $Title,
							'Description'	=> $Description,
							'PicUrl'		=> $PicUrl,
							'Url'			=> $Url
						)
				));
				break;
			default:
				return $this->ResponseText($FromUserName, 
					$ToUserName, "reply 'index' . You can get the restaurant index and order the food you want");
				break;
		}
	}

	private function RequestImage($postObj){
		$FromUserName 		= $postObj->FromUserName;
		$ToUserName 		= $postObj->ToUserName;
		return $this->ResponseText($FromUserName,
			$ToUserName, "we don't deal with the picture");
	}

	private function RequestLocation($postObj){
		$Location_X 		= $postObj->Location_X;
		$Location_Y 		= $postObj->Location_Y;
		$Label 				= $postObj->Label;
		// $redirect_uri		= "http%3A%2F%2F104.237.155.177%2Fu%2Fr%2FlocationIndex%3FlocationX%3D".$Location_X."%26locationY%3D".$Location_Y;
		$redirect_uri		= "http://104.237.155.177/u/restaurant/locationIndex?locationX=".$Location_X."%26locationY=".$Location_Y;
		$Title				= 'Near Your Restaurant';
		$Description		= 'Welcome to Food Order';
		$PicUrl 			= 'http://104.237.155.177/pic/TestDemo.jpg';
		$FormUrl 			= 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67feeba41a14f3&redirect_uri=%s&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
		$Url 				= sprintf($FormUrl,$redirect_uri);
		Log::info('redirect_uri is '.$Url);
		return $this->ResponsePictureAndLink($postObj->FromUserName, $postObj->ToUserName,
			array(
					array(
							'Title' 		=> $Title,
							'Description'	=> $Description,
							'PicUrl'		=> $PicUrl,
							'Url'			=> $Url
						)
				));	
		// return $this->ResponseText($postObj->FromUserName, 
		// 	$postObj->ToUserName,'维度为：'.$Location_X.' 经度为: '.$Location_Y.' 所在地方为 '.$Label);
	}

	private function RequestVoice($postObj){

	}

	private function RequestVideo($postObj){

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

	private function ResponsePictureAndLink($FromUserName, $ToUserName, $items){
		try{
			$item_TPL 			= "<item>
									<Title><![CDATA[%s]]></Title>
									<Description><![CDATA[%s]]></Description>
									<PicUrl><![CDATA[%s]]></PicUrl>
									<Url><![CDATA[%s]]></Url>
									</item>";
			$item_result	= "";
			Log::info($items[0]['Title']);
			foreach ($items as $i) {
				Log::info($i);
				$item_result.=sprintf($item_TPL, $i['Title'], 
					$i['Description'], $i['PicUrl'], $i['Url']);
			}
			$time 			= time();
			$result 		= "<xml>
								<ToUserName><![CDATA[".$FromUserName."]]></ToUserName>
								<FromUserName><![CDATA[".$ToUserName."]]></FromUserName>
								<CreateTime>".$time."</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>
								<ArticleCount>".count($items)."</ArticleCount>
								<Articles>".
								$item_result
								."</Articles>
								</xml>";
			Log::info('success to create Articles');
			Log::info('The result is '.$result);
			return $result;
		}catch(\Exception $e){
			Log::error($e);
		}
			return 'empty';
	}

	private function getAccessToken(){
		$access_token Cache::get('access_token',function(){return null});
		if($access_token)
			return $access_token;
		else{
			$ch 		= curl_init(ACCESS_TOKEN_URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result 	= curl_exec($ch);
			curl_close($ch);
			Log::info('the result is '.$result);
			$resultObj	= json_decode($result);
			Log::info('the access token is '.$result->access_token);
			Cache::put('access_token', $result->access_token,120);
			return $result->access_token;
		}
	}

	private function getOpenid(){
		$access_token 	= $this->getAccessToken();
		$url 			= sprintf(GET_USER_BASE, $access_token);
		$ch 			= curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		$result 		= curl_exec($ch);
		curl_close($ch);
		Log::info('the result is '.$result);
		$openid 		= $result->openid;
		Session::put('openid', $openid);
		$customer 		= new Customer;
		$customer->openid= $openid;
		$customer->save();
		return $openid;
	}

	private function getOrders(openid){
		$orders 	= Order::where('openid = ? and status <> 2')
			->get();
		return $orders;
	}
}