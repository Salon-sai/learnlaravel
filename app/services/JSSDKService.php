<?php

use AccessTokenService, HttpSend, Log, Cache, Request;

define('TICKET_URL_FORM', 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=%s');
define('APPID', 'wx6b67feeba41a14f3');
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
			$access_token = AccessTokenService::getAccessToken();
			$url 		= sprintf(TICKET_URL_FORM, $access_token);
			Log::info('ready to send url for getting the ticket');
			$result 	= HttpSend::HttpSend($url);
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