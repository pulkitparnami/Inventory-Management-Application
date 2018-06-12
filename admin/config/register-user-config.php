<?php
include('../../core/init.php');

if(isset($_POST['register_submit']) && Token::check($_POST['token'])){
	if(!empty($_POST['r-fname']) && !empty($_POST['r-lname']) && !empty($_POST['r-mobileno']) && !empty($_POST['r-password'])){
		//escaping entered data
		$fname 	   = escape($_POST['r-fname']);
		$lname     = escape($_POST['r-lname']);
		$email     = escape($_POST['r-email']);
		$mobile_no = escape($_POST['r-mobileno']);
		$password  = escape($_POST['r-password']);

		//length
		$len_fname     = strlen($fname);
		$len_lname     = strlen($lname);
		$len_mobile_no = strlen($mobile_no);
		$len_password  = strlen($password);
		$default_page  = REL.'/admin/register.php';

		if($len_fname < 20 && $len_fname >= 3 && $len_lname  < 20 && $len_lname  >= 3  && $len_password >= 7 && $len_mobile_no ===10 && filter_var($email,FILTER_VALIDATE_EMAIL) && ctype_digit($mobile_no))
		{
			$user = new User();
			$user_exists =$user->check_user($mobile_no);
			if(!$user_exists){
				$password_hash = password_hash($password,PASSWORD_DEFAULT,['cost'=>12]);
				$user->register_user($fname,$lname,$email,$password_hash,$mobile_no);
				Notice::add_notice('Registration successfull <a href="'.REL.'/admin/single-user.php?u='.$user->get_inserted_id().'">View Customer</a>','success');
				redirect($default_page);
			}
			
		}
		else{
			Notice::add_notice('Characters limit failed / Invalid Email','error');
			redirect($default_page);
		}

		
	}
	else{
		Notice::add_notice('Fill all required fields','error');
		redirect($default_page);
	}
}
else{
	redirect(REL.'/admin/404.php');
}
?>







