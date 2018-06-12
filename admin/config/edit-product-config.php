<?php

include_once('../../core/init.php');

$inventory = new Inventory(); //Instantiating
$old_pcode	  = strip_tags($_POST['old-pcode']);
$default_page = REL.'/admin/edit-product.php?p='.$old_pcode;

if(isset($_POST['inv_submit'])){
	if(!empty($_POST['p-code']) && !empty($_POST['p-quantity']) && !empty($_POST['p-category']) && !empty($_POST['p-location'])){

		$product  	   	 	= $inventory->get_product($old_pcode);
		$old_locations_json = $product->get_location();
		$old_locations 		= json_decode($old_locations_json,true);
		$old_qty	  		= $product->get_quantity();
		$prod_code    		= trim(strip_tags($_POST['p-code']));
		$new_page     		= REL.'/admin/edit-product.php?p='.$prod_code;
		$edit_notes   		= '';

		$locations = array_combine($_POST['p-location'], $_POST['p-quantity']);
		
		if($old_locations_json !== json_encode($locations)){
			$total_qty = 0;
			foreach ($locations as $location => $quantity) {
				$old_loc_qty = (int) $old_locations[$location];
				if(!$quantity){
					unset($locations[$location]);
				}
				elseif(!ctype_digit($quantity)){
					Notice::add_notice('Quantity field must contain only numbers','error');
					redirect($default_page);
					die();
				}
				$quantity = (int) $quantity;
				$total_qty += $quantity;
				$same_location_qty = false;

				if($old_loc_qty != $quantity && !empty($quantity)){
					$qty_change = abs($old_loc_qty - $quantity);
					if($quantity > $old_loc_qty){
						$edit_notes .= strtoupper($location).'- <i class="fa fa-arrow-up" aria-hidden="true"></i>'.$qty_change.' || New Qty: '.$quantity.'<br>';
					}
					else{
						$edit_notes .= strtoupper($location).'- <i class="fa fa-arrow-down" aria-hidden="true"></i>'.$qty_change.' || New Qty: '.$quantity.'<br>';
					}
				}
			}
		}
		else{
			$total_qty = $old_qty;
			$same_location_qty = true;
		}


		$dealer_code 	   = (!empty($_POST['d-code']) ? trim(strip_tags($_POST['d-code'])) : null);
		$category   	   = trim(strip_tags($_POST['p-category']));
		$uploaded_img_name = trim(strip_tags($_POST['p-image']));

		//Update changelog variables
		$old_img 	  = $product->get_image();
		$old_cat	  = $product->get_category();
		$old_dcode	  = $product->get_dealer_code();
		$new_qty	  = $total_qty;
		$qty_edited	  = $new_qty - $old_qty;
		
		if(!$uploaded_img_name){ $uploaded_img_name  = $old_img;}

		if($old_img == $uploaded_img_name && $old_cat == $category && $prod_code == $old_pcode && $dealer_code == $old_dcode && $same_location_qty){
			Notice::add_notice('No Changes to save.','error');
			redirect($default_page); //No changes to save.
		}
		else{

			//Check if product already exists
			if($prod_code != $old_pcode && $inventory->get_product_by('pc_code',$prod_code)){
				Notice::add_notice('Product with product code '.$prod_code.' already exists. <a href="'.REL.'/admin/edit-product.php?p='.$prod_code.'" class="ap-note">View Product</a>','error');
				redirect($default_page);
				die();
			}
			else{

				if($dealer_code != $old_dcode && $inventory->get_product_by('dealer_code',$dealer_code)){
					$orig_prod_code = $inventory->get_prod_code();
					Notice::add_notice('Product with dealer code '.$dealer_code.' already exists. <a href="'.REL.'/admin/edit-product.php?p='.$orig_prod_code.'" class="ap-note">View Product</a>','error');
					redirect($default_page);
					die();
				}
			}
			$insert_location = json_encode($locations);
			$product_updated = $inventory->update_product($category,$total_qty,$uploaded_img_name,$insert_location,$dealer_code,$prod_code,$old_pcode); //Updating Product

	
			//Check if other attributes changed.
			

			if($old_pcode != $prod_code){
				$edit_notes .= 'Product Code updated from '.$old_pcode.' to '.$prod_code.'<br>';
			}

			if($old_dcode != $dealer_code){
				$edit_notes .= 'Dealer Code updated from '.$old_dcode.' to '.$dealer_code.'<br>';
			}

			if($old_cat != $category){
				$edit_notes .= 'Category updated from '.$old_cat.' to '.$category.'<br>'; 
			}

			if($old_img != $uploaded_img_name){
				$edit_notes .= 'Product Image updated.<br>'; 
			}
			
			$changelog_updated = $inventory->update_changelog($uploaded_img_name,$prod_code,$qty_edited,$old_qty,$new_qty,$_SESSION['user_name'],$edit_notes); //Updating Changelog.
			if(!$changelog_updated){
				die('z');
			}
			Notice::add_notice('Product updated successfully.','success');
			redirect($new_page);
		}		
	}
	else{
		Notice::add_notice('Please fill all the fields.','error');
		redirect($default_page);
	}
}

?>