<?php
include('../core/init.php');

if(!isset($_GET['u'])){
	redirect(REL.'/404.php');
}

include(ROOT.'/templates/header.php');

/** User Personal Details **/
$user = new User();
$user->get_user_by('id',$_GET['u']);
$user_id 	= $user->get_user_id();
$email		= $user->get_user_email();
$first_name = $user->get_user_first_name();
$last_name 	= $user->get_user_last_name();
$mobile		= $user->get_user_mobile();

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="sgUserName">
				<h2><?php echo $first_name.' '.$last_name; ?></h2>
			</div>
			<div class="sgHeadBtns">
				<a class="btn btn-primary" href="<?php echo REL.'/admin/add-order.php?u='.$user_id; ?>">Add new order</a>
			</div>

			<div class="my-orders">
				<?php include(ROOT.'/templates/my-orders.php'); ?>
			</div>
		</div>
	</div>
</div>