<?php
include('../core/init.php');
$mobile_no =  escape($_POST['mobile_no']);
if(strlen($mobile_no) === 10){
	$user = new User();
	$user_exists = $user->check_user($mobile_no);
	echo $user_exists ? 'true' : 'false';
}


?>