<?php

class Sender {

	public function httpSend($url, $isPost = false, $post_data = null){
		$ch 	= curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		
		if($isPost){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		}		

		$result	= curl_exec($ch);
		curl_close($ch);
		return $result;
	}

}
?>