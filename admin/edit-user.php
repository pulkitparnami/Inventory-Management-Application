<?php
include('../core/init.php');

if(!isset($_GET['u'])){
	redirect(REL.'/404.php');
}

include(ROOT.'/templates/header.php');

/** User Personal Details **/
$user = new User();
$user->get_user_by('id',38);
$user_id 	= $user->get_user_id();
$email		= $user->get_user_email();
$first_name = $user->get_user_first_name();
$last_name 	= $user->get_user_last_name();
$mobile		= $user->get_user_mobile();

?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="edit-user">
				<form class="form-horizontal">

					<!-- Customer Personal Details -->
					<span class="cd-head"><h3>Customer Details</h3></span>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2" for="e-first_name">First Name</label>
								<div class="col-md-4 col-sm-4">
									<input type="text" class="form-control" name="e-first_name" id="e-first_name" value="<?php echo $first_name; ?>">
							    </div>
						
							    <label class="control-label col-md-2 col-sm-2" for="e-last_name">Last Name</label>
							    <div class="col-md-4 col-sm-4">
							      <input type="text" name="e-last_name"  class="form-control" id="e-last_name" value="<?php echo $last_name; ?>">
							    </div>
							</div>
						</div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-2" for="e-email">Email</label>
					    <div class="col-sm-10">
					      <input type="email" name="e-email" class="form-control" id="e-email" value="<?php echo $email; ?>">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-2" for="e-contact">Contact No.</label>
					    <div class="col-sm-10">
					      <input type="number" name="e-contact" class="form-control" id="e-contact" value="<?php echo $mobile; ?>">
					    </div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
