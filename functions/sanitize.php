<?php
//Sanitize
function escape($string){
	return htmlentities($string,ENT_QUOTES,'UTF-8');
}
//Redirect
function redirect($location){
	return header('Location: '.$location);
}

//User Logged In Check
function user_loggedin(){
	if(isset($_SESSION['user_permission'])){
		return true;
	}
	else{
		return false;
	}
}

//Current page
function is_page($page_name){
	if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == $page_name){
		return true;
	}
	else{
		return false;
	}
}

//Check admin
function is_admin(){
	if(isset($_SESSION['user_permission']) && $_SESSION['user_permission'] == 1){
		return true;
	}
}

?>