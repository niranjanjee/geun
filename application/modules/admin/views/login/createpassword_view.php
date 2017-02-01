<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


   <div class="login-box">
  <div class="login-logo">
    <b>New</b>&nbsp;Password
  </div>
  <?php
	if(isset($loginmsg)){
	echo '<div class="alert alert-danger">
		<i class="icon fa fa-ban"></i>
		'.$loginmsg.'
	</div>';
	}
	?>
  <div class="login-box-body">
    <p class="login-box-msg"></p>
	  <form class="form-login" action="" method="post" enctype="multipart/form-data">           
                   
      <div class="form-group has-feedback">
        <input type="password" placeholder="New Password" name="npassword" id="npassword" class="form-control">
       <span style="color:red;"> <?php echo form_error('npassword'); ?></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
           <div class="form-group has-feedback">
     
        <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" class="form-control">
       <span style="color:red;"> <?php echo form_error('cpassword'); ?></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Change password</button>
        </div>
        <!-- /.col -->
      </div>
  </form>
	<p>&nbsp;</p>
    
  </div>
  </div>
  <!-- /.login-box-body -->
</div>