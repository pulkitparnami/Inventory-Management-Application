<?php
session_start();
include_once('../core/init.php');
foreach ($_SESSION as $key => $value) {
	if($key != 'tokens'){
		unset($_SESSION[$key]);
	}
}

redirect(REL);
?>