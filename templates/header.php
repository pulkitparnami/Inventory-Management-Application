<!DOCTYPE html> 
<html>
<head>

	<?php
	
		//Page Attributes 
		$pa_attr 		= new PageAttr();
		$pa_filename 	= str_replace('-','_',basename($_SERVER['PHP_SELF'],'.php'));
		$pa_inst 		= $pa_attr->$pa_filename();
	?>

	<title><?php echo $pa_attr->site_title; ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $pa_attr->description; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Asap|Bree+Serif|Baloo+Da|Hammersmith+One" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href=<?php echo REL.'/assets/css/style.css'; ?>>

	<script   src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
	<script type="text/javascript" src=<?php echo REL.'/assets/js/main.js'; ?>></script>
	<script type="text/javascript" src="<?php echo REL.'/assets/js/media-uploader.js'; ?>"></script>

	<?php if(is_page('changelog') || is_page('order-list')){ ?>
		<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
		<script type="text/javascript" src="<?php echo REL.'/assets/js/datepicker-init.js'; ?>"></script>
		
	<?php } ?>
	
</head>

<body class="<?php echo $pa_attr->body_class; ?>">
<div class="header">
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-6 topbar-left"></div>
				<div class="col-md-6 topbar-right">
					<ul class="topr-ul">
						<li>
							<?php if(user_loggedin()){ ?>
								<form class="logout-user" method="POST" action=<?php echo REL.'/config/logout-user-config.php'; ?>>
									<input type="submit" name="logout_submit" value="Log Out">
								</form>
							<?php }else{ ?>
								<a href="<?php echo REL; ?>">Log In</a>
							<?php } ?>
						</li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="header-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="site-title">
						<a href="<?php echo REL; ?>">Website</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
		if(is_admin()){
			include(ROOT.'/admin/templates/admin-menu.php');
		}
	?>		
</div>


