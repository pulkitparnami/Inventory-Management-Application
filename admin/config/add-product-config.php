<?php
include_once('../../core/init.php');

$inventory = new Inventory(); //Instantiating

if(isset($_POST['inv_submit'])){

	if(!empty($_POST['p-code']) && !empty($_POST['p-quantity']) && !empty($_POST['p-category']) && !empty($_POST['p-location'])){

		$default_page = REL.'/admin/add-product.php';
		$locations = array_combine($_POST['p-location'], $_POST['p-quantity']);
		$total_qty = 0;

		foreach ($locations as $location => $quantity) {
			if(!$quantity){
				unset($locations[$location]);
			}
			elseif(!ctype_digit($quantity)){
				Notice::add_notice('Quantity field must contain only numbers','error');
				redirect($default_page);
			}
			$total_qty += (int) $quantity;	
		}
	
		$prod_code 			= trim(strip_tags($_POST['p-code']));
		$dealer_code 		= (!empty($_POST['d-code']) ? trim(strip_tags($_POST['d-code'])) : null);
		$category    		= trim(strip_tags($_POST['p-category']));
		$img_uploaded_name 	= trim(strip_tags($_POST['p-image']));
		if(empty($img_uploaded_name)){$img_uploaded_name = 'placeholder.png';}

		//Check if product already exists
		if($inventory->get_product_by('pc_code',$prod_code)){
			Notice::add_notice('Product with product code '.$prod_code.' already exists. <a href="'.REL.'/admin/edit-product.php?p='.$prod_code.'" class="ap-note">View Product</a>','error');
			redirect($default_page);
		}
		else{
			if($dealer_code){
				$product = $inventory->get_product_by('dealer_code',$dealer_code);
				if($product){
					$orig_prod_code = $inventory->get_prod_code();
					Notice::add_notice('Product with dealer code '.$dealer_code.' already exists. <a href="'.REL.'/admin/edit-product.php?p='.$orig_prod_code.'" class="ap-note">View Product</a>','error');
					redirect($default_page);
				}
			}
		}
		$product_added = $inventory->add_product($category,$total_qty,$img_uploaded_name,$dealer_code,json_encode($locations),$prod_code); // Adding Product

		if($product_added){
			// update changelog
			$inventory->update_changelog($img_uploaded_name,$prod_code,'-','-',$total_qty,$_SESSION['user_name'],'Product Added');
			Notice::add_notice('Product added successfully. <a href="'.REL.'/admin/edit-product.php?p='.$prod_code.'" class="ap-note">Edit Product</a>','success');
			redirect($default_page);
		}
	}
	else{
		Notice::add_notice('Please fill all the fields.','error');
		redirect($default_page);
	}
}

?>