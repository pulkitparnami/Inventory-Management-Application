<?php
include('../core/init.php');
if(!isset($_GET['v'])){
	redirect(REL.'/404.php');
} 
require_once(ROOT.'/templates/header.php');
$vendor = new Vendor();
$cities = $vendor->cities;
$vendor->get_vendor($_GET['v']);
$vendor_name 	= $vendor->get_name();
$vendor_address = $vendor->get_address();
$vendor_city 	= $vendor->get_city();
$vendor_info 	= $vendor->get_info();
?>
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<?php Notice::print_notice(); ?>
			<form class="add-vendor-form" method="POST" action="<?php echo REL.'/admin/config/vendor-config.php'; ?>">
				<div class="form-group">
					<label for="vendor-name">Vendor Name</label>
					<input type="text" id="vendor-name" name="vendor-name" class="form-control" value="<?php echo $vendor_name; ?>">
				</div>

				<div class="row form-group">
					<div class="col-md-6 col-sm-6">
						<label for="vendor-address">Vendor Address</label>
						<textarea rows="3" id="vendor-address" name="vendor-address" class="form-control"><?php echo $vendor_address; ?></textarea>
					</div>
					<div class="col-md-6 col-sm-6">
						<label for="vendor-city">Vendor City</label>
						<select name="vendor-city" id="vendor-city" class="form-control">
							<?php
							foreach ($cities as $city) {
								if($vendor_city == $city){
									$selected = 'selected';
								}
								else{
									$selected = '';
								}
								echo '<option value="'.$city.'" '.$selected.'>'.$city.'</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="vendor-info">Other Info</label>
						<textarea rows="3" id="vendor-info" name="vendor-info" class="form-control"><?php echo $vendor_info; ?></textarea>
				</div>
				<input type="submit" class="btn btn-primary" value="Create Vendor" name="create_vendor">
			</form>
		</div>
	</div>
</div>