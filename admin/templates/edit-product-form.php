<form class="inventory-form" method="POST" action="config/edit-product-config.php" enctype="multipart/form-data">
<?php

	Notice::print_notice();

	//Current product values
	$image 	  		= $product->get_image();
	$prod_code      = $product->get_prod_code();
	$dealer_code    = $product->get_dealer_code();
	$category 		= $product->get_category();

 ?>
 	<div class="row">
		<div class="col-md-8 col-sm-8">
			<div class="row">
				<div class="form-group clearfix">
					<div class="col-md-6 col-sm-6">
					    <label for="p-code">Product Code</label>
					    <input type="text" name='p-code' value= "<?php echo $prod_code; ?>" class="form-control" id="p-code" required>
			        	<input type="hidden" name="old-pcode" value="<?php echo $prod_code; ?>">
				    </div>

				    <div class="col-md-6 col-sm-6">
					    <label for="p-code">Dealer Code</label>
					    <input type="text" name='d-code' value= "<?php echo $dealer_code; ?>" class="form-control" id="d-code">
				    </div>
				</div>
			</div>

			<div class="form-group">
				<label for="p-category">Product Category</label>
			    <select class="form-control" name="p-category">
			    	<option value="wedding" <?php if($category == 'wedding'){echo 'selected';} ?>>Wedding</option>
			    	<option value="single" <?php if($category == 'single'){echo 'selected';} ?>>Single</option>
			    </select>
		    </div>

		    <div class="product-location">
			    <label for="p-location">Product Location & Quantity</label><span class="add-loc">Add Location</span>
			    <?php 
			    $locations = json_decode($product->get_location(),true);
			    if(!empty($locations)){
				    foreach ($locations as $location => $quantity) {
				    	$location = escape($location);
				    	$quantity = (int) $quantity;
		    	?>
				    <div class="add-loc-cont">
					    <div class="row">
						    <div class="form-group clearfix">
						    	<div class="col-md-6 col-sm-6 col-xs-6">
							    	<select class="form-control select-loc" name="p-location[]">
								    	<?php
								    	foreach($all_locations as $stock_location){
								    		if($location == $stock_location){
								    			$selected = 'selected';
								    		}
								    		else{
								    			$selected = '';
								    		}
								    		echo '<option value="'.$stock_location.'" '.$selected.'>'.$stock_location.'</option>';
								    	} 
									    ?>
								    </select>
							    </div>

							    <div class="col-md-6 col-sm-6 col-xs-6">
							    	<input type="text" name='p-quantity[]' class="form-control" id="p-quantity" placeholder="Product Quantity" value="<?php echo $quantity; ?>">
							    </div>
							</div>
						</div>
					</div> 
		    	<?php }}else{ ?>
		    		<div class="add-loc-cont">
					    <div class="row">
						    <div class="form-group clearfix">
						    	<div class="col-md-6 col-sm-6 col-xs-6">
							    	<select class="form-control" name="p-location[]">
								    	<option value="shop">Shop</option>
								    	<option value="basement">Basement</option>
								    	<option value="first floor">First Floor</option>
								    	<option value="second floor">Second Floor</option>
								    	<option value="third floor">Third Floor</option>
								    	<option value="home">Home</option>
								    </select>
							    </div>

							    <div class="col-md-6 col-sm-6 col-xs-6">
							    	<input type="text" name='p-quantity[]' class="form-control" id="p-quantity" placeholder="Product Quantity">
							    </div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div> 
			<button type="submit" name="inv_submit" class="inv-submit">Update</button>
		</div>

		<div class="col-md-4 col-sm-4">
 			<div class="prod-img-cont">
				<div class="img-holder"><img src="<?php echo REL.'/uploads/'.$image?>"/></div>
				<button class="btn btn-primary open-media">Select</button>
				<input type="hidden" name='p-image' class="form-control" id="p-image">
			</div>
		</div>
	</div>
</form>

