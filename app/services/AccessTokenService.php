<?php

use Cache;

define('ACCESS_TOKEN_URL', 
	"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6b67feeba41a14f3&secret=29943ae5d7b778c9761961156baf5e31");
class AccessTokenService{


	public static function getAccessToken(){
		$access_token 		= Cache::get('ACCESS_TOKEN',function(){return null;});
		if(!$access_token){
			$ch 			= curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 500);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		    curl_setopt($curl, ACCESS_TOKEN_URL, $url);
		    $result 		= json_decode(curl_exec($ch));
		    curl_close($ch);
		    $access_token 	= $result->access_token;
		    if($access_token){
		    	Cache::put('ACCESS_TOKEN', $access_token, '120');
		    }
		    return $access_token;
		}else{
			return $access_token;
		}
	}

}
?>