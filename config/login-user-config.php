<?php

include_once('../core/init.php');
if(isset($_POST['login_submit']) && Token::check($_POST['token'])){

	if(!empty($_POST['l-mobileno']) && !empty($_POST['l-password'])){		 // Check if login form is submitted
		$mobile_no = escape($_POST['l-mobileno']);
		$password  = escape($_POST['l-password']);

		$user_inst = new User();
		$user_info = $user_inst->login_user($mobile_no);

		if($user_info){												  		 // Check if Mobile number exists.
			$password_hashed = $user_info->get_user_password();
			$password_verify = password_verify($password,$password_hashed);
		
			if(!$password_verify){ 											 // Proceed (Password matched).

				if($user_inst->login_user($mobile_no)){						 // Proceed (Login Successfull).
					session_regenerate_id(); // Regenerate session id
					$_SESSION['user_id'] 		 = $user_inst->get_user_id();
					$_SESSION['user_permission'] = $user_inst->get_user_permission();
					$_SESSION['user_name'] 		 = $user_inst->get_user_first_name();

					if($_SESSION['user_permission'] == '1'){				  // Check user permissions.
						redirect(REL.'/admin/index.php');
					}
					else{
						redirect(REL.'/index.php');
					}
				}
				else{
					redirect(REL.'/index.php?logError&logE');
				}
				
			}
			else{
				redirect(REL.'/index.php?logError&logD');
			}		
		}
		else{
			redirect(REL.'/index.php?logError&logC');
		}
	}
	else{
		redirect(REL.'/index.php?logError&logB');
	}
}
else{
	redirect(REL.'/index.php?logError&logA');
}


?>