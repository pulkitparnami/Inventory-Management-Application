<?php
if(!isset($_GET['u'])){
	redirect(REL.'404.php');
}
Notice::print_notice();
?>


<form class="order-form" method="POST" action="<?php echo REL.'/admin/config/order-config.php'; ?>">
	
		<div class="form-group ord-sprod">
			<label for="e-pc_code">Product Code</label>
		       <input type="text" name="src-product" id="src-product" class="form-control src-product" placeholder="Search Product" autocomplete="off">
  			   <div class="src-prod-results src-results"></div>

		      <input type="hidden" name="e-pc_code"  class="form-control" id="e-pc_code">
		      <span class="e-prodsel"></span>
	    </div>

	    <div class="row">
	    	<div class="form-group">
	    		<div class="col-md-4 col-sm-4">Location</div>
	    		<div class="col-md-4 col-sm-4">Quantity</div>
	    	</div>
	    </div>
	    <div class="ord-stk">
	    	<div class="ord-stk-content">
			    <div class="row">
				    <div class="form-group">
				    	<div class="col-md-4 col-sm-4">
				    		<input type="text" class="form-control e-location" name="e-location[]" placeholder="Location" disabled="disabled">
				    		<input type="hidden" class="form-control e-location" name="e-location[]" placeholder="Location"">
						</div>

						<div class="col-md-4 col-sm-4">
							<input type="number" class="form-control e-quantity" name="e-quantity[]">
							<span class="e-qty-avail"></span>
						</div>
				    </div>
			    </div>
		    </div>
	    </div>
		
	<div class="form-group">
		<div class="cd-order-additions">
			<label class="checkbox-inline">
					<input type="checkbox" id="e-toprint" value="true" name="e-toprint"> Print
			</label>

			<label class="checkbox-inline">
					<input type="checkbox" id="e-toassemble" value="true" name="e-toassemble"> Assemble
			</label>
		</div>
	</div>

	<div class="form-group">
	  <label for="e-status">Status</label>
		  <select class="form-control" id="e-status" name="e-status">
		    <option value="1">Order Placed</option>
		    <option value="3">Ready to Print</option>
		    <option value="5">Printing Completed</option>
		    <option value="7">Assembled</option>
		    <option value="9">Ready to Dispatch</option>
		  </select>
	</div>

	<div class="form-group">
	  	<input type="submit" class="btn btn-info" name="save_order" value="Add Order">
	  	<input type="hidden" name="e-udid" value="<?php echo $_GET['u']; ?>"> 
	</div>
</form>