<?php

use AccessTokenService, Sender, Log, Cache, Request;

define('TICKET_URL_FORM', 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=%s');
define('STRING_FORM','jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s');
class JSSDKService {
	
	public function getSignPackage(){
		$jsapi_ticket 	= $this->getJsApiTicket();
		$url 			= Request::fullUrl();
		$time			= time();
		$nonceStr 		= $this->createNonceStr();
		$string 		= sprintf(STRING_FORM, 
			$jsapi_ticket, $nonceStr, $time, $url);
		$signature 		= sha1($string);

		$signPackage 	= array(
				'appId'		=> 'wx6b67feeba41a14f3',
				'nonceStr'	=> $nonceStr,
				'timestamp'	=> $time,
				'signature'	=> $signature
			);
		return $signPackage;
	}

	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	private function getJsApiTicket(){
		$ticket 	= Cache::get('jsapi_ticket',function(){return null;});
		if(!$ticket){
			$accesstokenService = new AccessTokenService;
			$access_token = $accesstokenService->getAccessToken();
			$url 		= sprintf(TICKET_URL_FORM, $access_token);
			Log::info('ready to send url for getting the ticket');
			$sender 	= new Sender;
			$result 	= $sender->httpSend($url);
			Log::info('the result of getting the ticket '.$result);
			$ticket 	= json_decode($result)->ticket;
			Log::info('success to get the ticket : '.$ticket);
			if($ticket){
				Cache::put('jsapi_ticket', $ticket, 120);
			}
			return $ticket;
		}else{
			Log::info('the ticket get from the Cache');
			return $ticket;
		}
		
	}
}
?>