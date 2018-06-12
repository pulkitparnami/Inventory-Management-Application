<?php
include('core/init.php'); 
require_once('templates/header.php'); 
//Instantiating user
$user = new User();
?>
<div class="container">
	<?php if(!user_loggedin()){ ?>
	<div class="row">
		<div class="col-md-6 col-sm-10 col-xs-10 login-modal">
			<span class="glyphicon glyphicon-user"></span>
			<div class="lf-title">Login Form</div>
			<?php include('templates/login-form.php'); ?>
		</div>
	</div>
	<?php }else{  // Begin if user logged in?> 

	<?php if($_SESSION['user_permission'] == '1'){
		echo '<a href="'.REL.'/admin" class="btn btn-primary">ADMIN DASHBOARD</a>';
	}?>

	<?php } // End else ?>

</div>
<?php require_once('templates/footer.php'); ?>


