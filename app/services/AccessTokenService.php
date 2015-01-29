<?php

use Cache, HttpSend, Log;

define('ACCESS_TOKEN_URL', 
	"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6b67feeba41a14f3&secret=29943ae5d7b778c9761961156baf5e31");
class AccessTokenService{


	public function getAccessToken(){
		$access_token 		= Cache::get('ACCESS_TOKEN',function(){return null;});
		if(!$access_token){
			$sender 		= new HttpSend;
			$result 		= $sender->httpSend(ACCESS_TOKEN_URL);
		    Log::info('success to send the url');
		    $resultjson 	= json_decode($result);
		    $access_token 	= $resultjson->access_token;
			Log::info('get the access token');
			if($access_token){
		    	Cache::put('ACCESS_TOKEN', $access_token, 120);
		    }
		    return $access_token;
		}else{
			return $access_token;
		}
	}

}
?>