<?php
if(!isset($_GET['od'])){
	redirect(REL.'/404.php');
}

$order_class = new Order();
$order 		 = $order_class->get_order_by('order_id',$_GET['od'])[0];

if(!empty($order)){
	$prod_code 	 = escape($order->pc_code);
	$quantity    = intval($order ->order_qty);
	$status    	 = intval($order->order_status);
	$to_print  	 = escape($order->to_print);
	$to_assemble = escape($order->to_assemble);

	$order_location_json = $order->retr_location;
	$order_location  	 = json_decode($order_location_json,true);

	$prod_location_json = $order->location;
	$prod_location = json_decode($prod_location_json,true);

	$difference = array_diff_key($prod_location, $order_location);
	foreach($difference as $location => $quantity){
		$difference[$location] = 0;
	}

	$ord_prod_locations = array_merge($order_location, $difference);

}
Notice::print_notice();
?>


<form class="order-form" method="POST" action="<?php echo REL.'/admin/config/order-config.php'; ?>">
	
		<div class="form-group ord-sprod">
			<label for="e-pc_code">Product Code</label>
		       <input type="text" name="src-product" id="src-product" class="form-control src-product" placeholder="Search Product" autocomplete="off" value="<?php echo $prod_code; ?>">
  			   <div class="src-prod-results src-results"></div>

		      <input type="hidden" name="e-pc_code"  class="form-control" id="e-pc_code" value="<?php echo $prod_code; ?>">
		      <span class="e-prodsel"></span>
	    </div>

	    <div class="row">
	    	<div class="form-group">
	    		<div class="col-md-4 col-sm-4">Location</div>
	    		<div class="col-md-4 col-sm-4">Quantity</div>
	    	</div>
	    </div>
	    <div class="ord-stk">
	    <?php foreach($ord_prod_locations as $location => $quantity){ ?>
	    	<div class="ord-stk-content">
			    <div class="row">
				    <div class="form-group">
				    	<div class="col-md-4 col-sm-4">
				    		<input type="text" class="form-control e-location" name="e-location[]" placeholder="Location" disabled="disabled" value="<?php echo $location; ?>">
				    		<input type="hidden" class="form-control e-location" name="e-location[]" placeholder="Location" value="<?php echo escape($location); ?>">
						</div>

						<div class="col-md-4 col-sm-4">
							<input type="number" class="form-control e-quantity" name="e-quantity[]" value="<?php echo intval($quantity); ?>">
							<span class="e-qty-avail">
								<?php
								if(isset($prod_location[$location])){
									echo 'In Stock: '.$prod_location[$location];
								}
								else{
									echo 'In Stock: 0';
								}
								?>	
							</span>
						</div>
				    </div>
			    </div>
		    </div>
	    <?php } ?>
	    </div>
		
	<div class="form-group">
		<div class="cd-order-additions">
			<label class="checkbox-inline">
					<input type="checkbox" id="e-toprint" value="true" name="e-toprint" <?php echo $to_print == 'true' ? 'checked' : null ?>> Print
			</label>

			<label class="checkbox-inline">
					<input type="checkbox" id="e-toassemble" value="true" name="e-toassemble" <?php echo $to_assemble == 'true' ? 'checked' : null ?> > Assemble
			</label>
		</div>
	</div>

	<div class="form-group">
	  <label for="e-status">Status</label>
		  <select class="form-control" id="e-status" name="e-status">
		    <option value="1" <?php echo $status == '1' ? 'selected': null ?>>Order Placed</option>
		    <option value="3" <?php echo $status == '3' ? 'selected': null ?>>Ready to Print</option>
		    <option value="5" <?php echo $status == '5' ? 'selected': null ?>>Printing Completed</option>
		    <option value="7" <?php echo $status == '7' ? 'selected': null ?>>Assembled</option>
		    <option value="9" <?php echo $status == '9' ? 'selected': null ?>>Ready to Dispatch</option>
		  </select>
	</div>

	<div class="form-group"> 
		<input type="submit" class="btn btn-info" name="update_order" value="Update Order">
		<input type="hidden" name="e-odid" value="<?php echo $_GET['od']; ?>">
	</div>
</form>