<?php
class Notice{

	public static function add_notice($string,$type){
		if($type == 'error'){
			$_SESSION['notice']['error'][] = $string;
		}
		elseif($type == 'success'){
			$_SESSION['notice']['success'][] = $string;
		}
	}

	public static function print_notice(){
		if(!empty($_SESSION['notice'])){
			foreach ($_SESSION['notice'] as $notice_type => $notice_messages) {
				if($notice_type == 'error'){
					foreach ($notice_messages as $notice_message) {
						echo '<div class="alert alert-danger">'.$notice_message.'</div>';
					}
				}
				elseif($notice_type == 'success'){
					foreach ($notice_messages as $notice_message) {
						echo '<div class="alert alert-success">'.$notice_message.'</div>';
					}
				}
			}

			self::clear_notice();
		}
	}

	public static function clear_notice(){
		$_SESSION['notice'] = array();
	}
}
?>