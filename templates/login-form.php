<?php 
	if(isset($_GET['logError'])){

		$html = '<div class="alert login-error alert-danger">';

		if(isset($_GET['logA'])){
			$html .= 'Something went wrong , Please try again.';
		}
		elseif(isset($_GET['logB'])){
			$html .= 'Mobile/Password cannot be empty.';
		}
		elseif(isset($_GET['logC'])){
			$html .= 'Mobile/Email not found.';
		}
		elseif(isset($_GET['logD'])){
			$html .= 'Incorrect password.';
		}
		elseif(isset($_GET['logE'])){
			$html .= 'Something went wrong , Please try again.';
		}

		$html .= '</div>';
		echo $html;
	}
?>
<form method="POST" action="<?php echo REL.'/config/login-user-config.php'; ?>" class="login-form">
	<div class="form-group">
		<span class="glyphicon glyphicon-phone"></span>
	    <input type="text" name='l-mobileno' class="form-control" id="l-mobileno" placeholder="Mobile Number or Email Id">
	    
  </div>
  <div class="form-group">
  		<span class="glyphicon glyphicon-lock"></span>
	    <input type="password" name='l-password' class="form-control" id="l-password" placeholder="Password">
  </div>
  <input type="hidden" name="token" value=<?php  echo Token::generate(); ?>>
  <button type="submit" name="login_submit" class="login-btn" >Login</button>

</form>