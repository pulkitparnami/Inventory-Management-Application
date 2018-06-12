<?php
include('../core/init.php'); 
require_once('../templates/header.php'); 
?>
<div class="container">
	<div class="row">
		<div class="col-md-11 changelog-table">
			<form action="changelog-config.php" method="POST" class="changelog-dp-form">
				<?php include_once(ROOT.'/templates/datepicker-form.php'); ?>
			</form>
			<div class="changelog-content"></div>
		</div>
	</div>
</div>
