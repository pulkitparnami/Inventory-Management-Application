<?php
include('../core/init.php'); 
require_once('../templates/header.php'); 

?>
<div class="container">
	<div class="row">
		<div class="col-md-6 register-modal">
			<span class="glyphicon glyphicon-user"></span>
			<div class="rf-title">Register Customer</div>
			<?php include(ROOT.'/admin/templates/register-form.php'); ?>
		</div>
	</div>
</div>