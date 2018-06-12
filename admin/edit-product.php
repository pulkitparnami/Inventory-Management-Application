<?php
include('../core/init.php'); 
if(!isset($_GET['p'])){
	redirect(REL.'/404.php');
}
else{
	$prod_code 		= escape($_GET['p']);
	$inventory	  	= new Inventory();
	$product  		= $inventory->get_product($prod_code);
	$all_locations	= $inventory->all_locations;
	include_once(ROOT.'/templates/header.php');
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
		<div class="col-md-12 edit-product-modal">
			<a href="<?php echo REL.'/admin/inventory.php' ?>" class="cust-btn">Back to Inventory</a>
			<div class="inv-title">Edit Product</div>

			<?php include(ROOT.'/admin/templates/edit-product-form.php'); ?>
		</div>
	</div>
</div>
<?php
}
?>
