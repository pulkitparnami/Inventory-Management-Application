<?php
include('../core/init.php');

if(!isset($_GET['od'])){
	redirect(REL.'/404.php');
}

include(ROOT.'/templates/header.php');

?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="edit-order">
				<?php include(ROOT.'/admin/templates/edit-order-form.php'); ?>
			</div>
		</div>
	</div>
</div>