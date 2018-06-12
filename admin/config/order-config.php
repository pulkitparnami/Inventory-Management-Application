<?php
include('../../core/init.php');
if(isset($_POST['e-udid'])){
	$user_id 	   = intval($_POST['e-udid']);
	$default_page  = REL.'/admin/add-order.php?u='.$user_id;
}
elseif (isset($_POST['e-odid'])) {
	$order_id 	   = intval($_POST['e-odid']);
	$default_page  = REL.'/admin/edit-order.php?od='.$order_id;
}


if(empty($_POST['e-pc_code']) || empty($_POST['e-quantity']) || empty($_POST['e-status']) || empty($_POST['e-location'])){
	Notice::add_notice('Fill all the required fields.','error');
	redirect($default_page);
}
else{
	//Check update or new order
	function is_order($type){
		if((isset($_POST['save_order']) && $type == 'new') || (isset($_POST['update_order']) && $type == 'update')){
			return true;
		}
	}

	$prod_code 	 = strip_tags($_POST['e-pc_code']);
	$locations 	 = $_POST['e-location'];
	$quantities  = $_POST['e-quantity'];
	$status    	 = intval($_POST['e-status']);
	$to_print 	 = isset($_POST['e-toprint']) ? 'true': 'false';
	$to_assemble = isset($_POST['e-toassemble']) ? 'true': 'false';

	$inventory 	   = new Inventory();
	$all_locations = $inventory->all_locations; 
	$inventory->get_product($prod_code);
	$orig_locations_json = $inventory->get_location();
	$orig_locations 	 = json_decode($orig_locations_json,true);

	foreach($locations as $location){
		if(!in_array($location, $all_locations)){
			die('Something went wrong');
		}
	}

	$order_qty = 0;
	foreach ($quantities as $index => $quantity) {
		if(!ctype_digit($quantity) && !empty($quantity)){
			Notice::add_notice('Quantity field should be a number','error');
			redirect($default_page);
			die();
		}
		if(empty($quantity)){
			unset($locations[$index]);
			unset($quantities[$index]);
		}
		$order_qty += $quantity;
	}

	if(!$order_qty){
		Notice::add_notice('Quantity cannot be 0','error');
		redirect($default_page);
		die();
	}

	$order_location 	 = array_combine($locations, $quantities);
	$order_location_json = json_encode($order_location); 
	$ext_orig_locations  = array_intersect_key($orig_locations, $order_location);

	function set_tracking($tracking){
		global $status,$to_print,$to_assemble,$old_status;

		if(is_order('new')){
			$tracking[$status] = date('d-M-Y h:i a');
		}
		elseif(is_order('update')) {
			if($status != $old_status){
				$tracking[$status] = date('d-M-Y h:i a');
			}
		}

		if($to_print == 'false'){
			unset($tracking[5]);
			unset($tracking[3]);
		}
		else{
			if(!array_key_exists(3, $tracking)){
				$tracking[3] = '';
			}
			if(!array_key_exists(5, $tracking)){
				$tracking[5] = '';
			}
		}

		if($to_assemble == 'false'){
			unset($tracking[7]);
		}
		else{
			if(!array_key_exists(7, $tracking)){
				$tracking[7] = '';
			}
		}

		foreach ($tracking as $step => $value) {
			if($step < $status && empty($value)){
				$tracking[$step] = date('d-M-Y h:i a');
			}
			elseif($step > $status && !empty($value)){
				$tracking[$step] = '';
			}
		}

		ksort($tracking);
		return json_encode($tracking);
	}

	function update_product_quantity(){
		global $prod_code,$orig_locations,$order_location,$inventory,$old_order_qty;
		//Update product Quantity
		if(is_order('new')){
			$edit_notes = 'Order Created<br>';
		}
		else{
			$edit_notes = 'Order Updated<br>';
		}
		
		$total_prod_qty = 0;
		foreach ($orig_locations as $location => $quantity) {

			if(isset($order_location[$location])){
				$ord_loc_qty = $order_location[$location];

				if(is_order('update')){
					$quantity = $orig_locations[$location] = $quantity-$ord_loc_qty+$old_order_qty;
				}
				elseif(is_order('new')){
					$quantity = $orig_locations[$location] = $quantity-$ord_loc_qty;
				}
				
				$edit_notes .= 'From: '.$location.' = '.$ord_loc_qty.'<br>';
			}
			$total_prod_qty += $quantity;
			if($quantity === 0){
				unset($orig_locations[$location]);
			}	
		}

		$set_args = array(
			'location' => json_encode($orig_locations),
			'quantity' => $total_prod_qty
			);
		$where_args = array(
			'key'   => 'pc_code',
			'value' => $prod_code
			);
		$inventory->update_product_fields($set_args,$where_args);

		//Update Changelog
		$args = array(
			'pc_code' 	 => $prod_code,
			'old_qty'    => $inventory->get_quantity(),
			'new_qty' 	 => $total_prod_qty,
			'edit_notes' => $edit_notes
			);
		$inventory->update_changelog_fields($args);
	}

	//======ADD ORDER CONFIG=======//
	if(is_order('new')){
		//Quantity is available in stock check.
		$quantity_exceeded = false;
		foreach ($order_location as $location => $quantity) {
			if($quantity > $ext_orig_locations[$location]){
				$quantity_exceeded = true;
				Notice::add_notice('Quantity Unavailable. Only '.$ext_orig_locations[$location].' at '.$location,'error');
			}
		}
		if($quantity_exceeded){
			redirect($default_page);
			die();
		}

		$tracking_raw   = array(
		1=> '',
		3=> '',
		5=> '',
		7=> '',
		9=> ''
		);
		$tracking 	   = set_tracking($tracking_raw);
		$order 		   = new Order();
		$order_success = $order->new_order($user_id,$prod_code,$order_qty,$to_print,$to_assemble,$status,$tracking,$order_location_json);

		if($order_success){
			Notice::add_notice('Order successfull','success');
			update_product_quantity();	
		}
		else{
			Notice::add_notice('Order Error','error');
		}

		redirect(REL.'/admin/add-order.php?u='.$user_id);
	}


	//======EDIT ORDER CONFIG=======//
	if(is_order('update')){

		$order_id 	 = intval($_POST['e-odid']);
		$order_class = new Order();
		$get_order 	 = $order_class->get_order_by('order_id',$order_id );

		foreach($get_order as $old_order){
			$old_tracking   	= $old_order->tracking_details;
			$old_prod_code  	= $old_order->pc_code;
			$old_status     	= $old_order->order_status;
			$old_toprint    	= $old_order->to_print;
			$old_toassemble 	= $old_order->to_assemble;
			$old_order_loc_json = $old_order->retr_location;
			$old_order_loc 		= json_decode($old_order_loc_json,true);
			$old_order_qty 		= $old_order->order_qty;
		}

		$quantity_exceeded = false;
		foreach ($order_location as $location => $quantity) {
			$quantity 	  = (int) $quantity;
			$orig_loc_qty = (int) $ext_orig_locations[$location];
			if(($orig_loc_qty+(int)$old_order_loc[$location]) < $quantity){
				$quantity_exceeded = true;
				Notice::add_notice('Quantity Unavailable. Only '.$orig_loc_qty.' at '.$location,'error');
			}
		}
		if($quantity_exceeded){
			redirect($default_page);
			die();
		}

		if($old_status != $status|| $old_toprint != $to_print || $old_toassemble != $to_assemble){
			$tracking = set_tracking(json_decode($old_tracking,true));
		}
		else{
			$tracking = $old_tracking;
		}

		if($old_prod_code == $prod_code && $old_order_loc_json == $order_location_json && $old_status == $status && $old_toprint == $to_print && $old_toassemble == $to_assemble && $old_tracking == $tracking){
			Notice::add_notice('No changes to save.','error');
		}
		else{
			$update_order = $order_class->update_order($prod_code,$quantity,$to_print,$to_assemble,$status,$tracking,$order_location_json,$order_id);
			if($update_order){
				Notice::add_notice('Order updated successfully.','success');
				update_product_quantity();
			}
			else{
				Notice::add_notice('Error.','error');
			}
		}

	redirect($default_page);
	}
}

?>