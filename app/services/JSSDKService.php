<?php

use AccessTokenService, Sender, Log, Cache, Request;

define('TICKET_URL_FORM', 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=%s');
define('STRING_FORM','jsapi_ticket=?&noncestr=?&timestamp=?&url=?');
class JSSDKService {
	
	public function getSignPackage(){
		$jsapi_ticket 	= $this->getJsApiTicket();
		$url 			= Request::url();
		$time			= time();
		$nonceStr 		= $this->createNonceStr();
		$string 		= sprintf(STRING_FORM, 
			$jsapi_ticket, $nonceStr, $time, $url);
		$signature 		= sha1($string);

		$signPackage 	= array(
				'appId'		=> APPID,
				'nonceStr'	=> $nonceStr,
				'timestamp'	=> $time,
				'signature'	=> $signature
			);
		Log::info(implode(',', $signPackage));
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
			$ticket 	= json_decode($result);
			Log::info('success to get the ticket : '.$ticket);
			if($ticket){
				Cache::put('jsapi_ticket', $ticket, 120);
			}
			return $ticket;
		}
		return $ticket;
	}
}
?>