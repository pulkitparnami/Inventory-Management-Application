<?php
class Token{
	public static function generate(){
		 $token = bin2hex(openssl_random_pseudo_bytes(16));
	     $_SESSION['tokens'][] = $token;
	     return $token;
		}

	public static function check($post_token){
		foreach ($_SESSION['tokens'] as $key => $value) {
			if($post_token === $value){
				unset($_SESSION['tokens'][$key]);
				return true;
				break;
			}
		}

	}
}
?>