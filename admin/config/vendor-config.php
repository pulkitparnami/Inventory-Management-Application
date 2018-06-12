<?php
include_once('../../core/init.php');
?>
<?php
$vendor_name 	= strip_tags($_POST['vendor-name']);
$vendor_address = strip_tags($_POST['vendor-address']);
$vendor_city 	= strip_tags($_POST['vendor-city']);
$vendor_info 	= strip_tags($_POST['vendor-info']);
$default_page 	= REL.'/admin/add-vendor.php';

if(empty($vendor_name) || empty($vendor_city)){
	Notice::add_notice('Please fill all the required fields','error');
	redirect($default_page);
	die();
}

if(isset($_POST['create_vendor'])){
	$vendor = new Vendor();
	$vendor_added = $vendor->add_vendor($vendor_name,$vendor_address,$vendor_city,$vendor_info);
	if($vendor_added){
		Notice::add_notice('Vendor added successfully.','success');
	}
	else{
		Notice::add_notice('Error.','error');
	}
	redirect($default_page);
	die();
}
?>