<?php
ini_set( 'session.cookie_httponly', 1 ); // Setting cookie to http only
session_start();

//TimeZone
date_default_timezone_set('Asia/Kolkata');

//Absolute path (Document root)
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/website');

//Relative path
define('REL', "http://" . $_SERVER['SERVER_NAME'].'/website');

//Functions
include_once(ROOT.'/functions/sanitize.php');

//Auto Load Classes
spl_autoload_register(function($class_name){
	include_once(ROOT.'/classes/'.$class_name.'.php');
});

//Checking admin permissions.
if(strpos($_SERVER["REQUEST_URI"],'/admin/') !== false){
	if(!isset($_SESSION['user_permission']) || $_SESSION['user_permission'] != 1){
		redirect(REL.'/index.php');
	}
}




?>
