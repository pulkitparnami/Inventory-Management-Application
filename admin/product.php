<?php
include_once('../core/init.php');

if(!isset($_GET['p'])){
	redirect(REL.'/404.php');
}
else{
	$code 			= escape($_GET['p']);
	$inventory	  	= new Inventory();
	$product  		= $inventory->get_product('A901');
	include_once(ROOT.'/templates/header.php');
?>
	<div class="container">
		<div class="row single-product">
			<div class="col-md-5 product-img-case">
				<div class="s-p-img"><img src=<?php echo $product->get_image(); ?> /></div>
			</div>
			<div class="col-md-6 product-summary">
				<div class="s-p-code"><?php echo $product->get_code(); ?></div>
				<div class="s-p-category"><?php echo $product->get_category(); ?></div>
			</div>
		</div>
	</div>
	<?php
		}
	?>

