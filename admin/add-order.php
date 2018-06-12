<?php
include('../core/init.php');

if(!isset($_GET['u'])){
	redirect(REL.'/404.php');
}

include(ROOT.'/templates/header.php');
?>
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<div class="pg-head">
				<h2>Add new order</h2>
			</div>

			<div class="add-order">
				<?php include(ROOT.'/admin/templates/add-order-form.php'); ?>
			</div>
		</div>
	</div>
</div>
