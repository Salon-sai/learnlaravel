<?php

define('APPID', 'wx6b67feeba41a14f3');
define('SECRET', '29943ae5d7b778c9761961156baf5e31');
define('GRANT_TYPE', 'authorization_code');
define('ACCESS_TOKEN_OAuth_URL', 
	"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6b67feeba41a14f3&secret=29943ae5d7b778c9761961156baf5e31");
class OAuthService {

	private function getAccessToken(){
		$code = Input::get('code');
		if($code){
			try{
				$ch 	= curl_init(ACCESS_TOKEN_OAuth_URL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, array(
						'appid'		=> APPID,
						'secret'	=> SECRET,
						'code'		=> $code,
						'grant_type'=> GRANT_TYPE
					));
				$result 	= curl_exec($ch);
				curl_close($ch);
				Log::info('success to get ACCESS_TOKEN');
				return $result;
			}catch(\Exception $e){
				Log::error($e);
				return 'NO CODE';
			}
		}else{
			return 'NO CODE';
		}
	}

	public function getOpenid(){
		$resultJson = $this->getAccessToken();
		$resultObj 	= json_decode($resultJson);				
		Log::info('access_token : '.$resultObj->access_token);
		$openid = $resultObj->openid;
		Log::info('openId : '.$openid);
		return $openid;
	}
}

?>