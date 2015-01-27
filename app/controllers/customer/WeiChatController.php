<?php

namespace App\Controllers\Customer;

use Input, Log, BaseController;

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
		Log::info('invoke Event ');
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
		$redirect_uri		= "http://104.237.155.177/u/r/locationIndex?locationX=".$locationX."&locationY=".$locationY;
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
			$textTpl 		= "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>
								<ArticleCount>%s</ArticleCount>
								<Articles>".
								$item_result
								."</Articles>
								</xml>";
			$result 		= sprintf($textTpl, $FromUserName, 
				$ToUserName, $time, count($items));
			Log::info('success to create Articles');
			Log::info('The resutl is '.$result);
			return $result;
		}catch(\Exception $e){
			Log::error($e);
		}
			return 'empty';
	}
}