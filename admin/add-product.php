<?php
include('../core/init.php'); 
require_once('../templates/header.php'); 
?>
<?php 
$media_size = array(
	array(
		'width'  => 80,
		'height' => 80,
		'folder' =>'80X80'
		)
	);
include(ROOT.'/admin/templates/media-upload.php'); 
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 add-product-modal">
			<a href="<?php echo REL.'/admin/inventory.php' ?>" class="cust-btn">Back to Inventory</a>
			<div class="inv-title">Add new product</div>
			<?php include(ROOT.'/admin/templates/add-product-form.php'); ?>
		</div>
	</div>
</div>