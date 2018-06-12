<?php
include('../core/init.php');
include(ROOT.'/templates/header.php');

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="<?php echo REL.'/admin/config/order-list-config.php'; ?>" class="order-list-form">
				<?php include(ROOT.'/templates/datepicker-form.php'); ?>
			</form>
			<div class="orderlist-content"></div>
		</div>
	</div>
</div>