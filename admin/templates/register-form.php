<?php 
  Notice::print_notice();
?>

<form method="POST" action=<?php echo REL.'/admin/config/register-user-config.php' ?> class="register-form">
  <div class="form-group">
    <label for="r-fname">First Name</label>
    <input type="text" name='r-fname' class="form-control" id="r-fname" placeholder="First name">
    <span class="r-fname-error rie-active r-input-error"></span>
  </div>
  <div class="form-group">
    <label for="r-lname">Last Name</label>
    <input type="text" name='r-lname' class="form-control" id="r-lname" placeholder="Last name">
    <span class="r-lname-error rie-active r-input-error"></span>
  </div>
 <div class="form-group">
    <label for="r-email">Email Id</label>
    <input type="text" name='r-email' class="form-control" id="r-email" placeholder="Email" maxlength="100">
    <span class="r-email-error rie-active r-input-error"></span>
  </div>
  <div class="form-group">
    <label for="r-mobileno">Mobile no.</label>
    <input type="text" name='r-mobileno' class="form-control" id="r-mobileno" placeholder="Mobile no."
    >
      <span class="r-mobile-error rie-active r-input-error"></span>
  </div>
  <div class="form-group">
    <label for="r-password">Password</label>
    <div class="generate-pass">
      <input type="password" name='r-password' class="form-control" id="r-password" placeholder="Password">
      <span class="btn-spass">Show</span>
      <button type="button" class="btn btn-primary btn-gpass">Generate</button>
      <div class="r-pass-error rie-active r-input-error" style="clear: both;"></div>
    </div>
  </div>

  <input type="hidden" name="token" value=<?php  echo Token::generate(); ?>>
  <button type="submit" name="register_submit" class="btn btn-primary register_submit" >Register</button>
</form>
