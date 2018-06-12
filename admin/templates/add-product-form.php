<form class="inventory-form" method="POST" action="config/add-product-config.php" enctype="multipart/form-data">
<?php
Notice::print_notice();
$inventory = new Inventory();
$all_locations = $inventory->all_locations;
 ?>
 	<div class="row">
 	
	    <div class="col-md-8 col-sm-8">
		    <div class="row">
					<div class="form-group clearfix">
					    <div class="col-md-6 col-sm-6">
					    	<label for="p-code">Product Code</label>
					    	<input type="text" name='p-code' class="form-control" id="p-code" required>
				    	</div>

					    
					    <div class="col-md-6 col-sm-6">
					    	<label for="d-code">Dealer Code</label>
					    	<input type="text" name='d-code' class="form-control " id="d-code">
				    	</div>

					</div>
			</div>

				<div class="form-group">
					<label for="p-category">Product Category</label>
				    <select class="form-control" name="p-category">
				    	<option value="wedding">Wedding</option>
				    	<option value="category">Single</option>
				    </select>
			    </div>


			    <div class="product-location">
				    <label for="p-location">Product Location & Quantity</label><span class="add-loc">Add Location</span>
				    <div class="add-loc-cont">
					    <div class="row">
						    <div class="form-group clearfix">
						    	<div class="col-md-6 col-sm-6 col-xs-6">
							    	<select class="form-control select-loc" name="p-location[]">
								    	<?php
								    	foreach($all_locations as $location){
								    		echo '<option value="'.$location.'">'.$location.'</option>';
								    	} 
								    	?>
								    </select>
							    </div>

							    <div class="col-md-6 col-sm-6 col-xs-6">
							    	<input type="text" name='p-quantity[]' class="form-control" id="p-quantity" placeholder="Product Quantity">
							    </div>
							</div>
						</div>
					</div>
				</div>

			<button type="submit" name="inv_submit" class="inv-submit">Submit</button>
		</div>

		<div class="col-md-4 col-sm-4">
			<div class="prod-img-cont"> 
				<div class="img-holder"><img src=""/></div>
				<button class="btn btn-primary open-media">Select</button>
			    <input type="hidden" name='p-image' class="form-control" id="p-image">
		    </div>
	    </div>
	</div>
</form>