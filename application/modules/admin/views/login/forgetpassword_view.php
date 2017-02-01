<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <div class="login-box">
  <div class="login-logo">
    <b>Admin</b>&nbsp;Management
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
    <p class="login-box-msg">Enter your email to get password</p>
	    <?php
					$attributes = array('method' => 'post', 'name' => 'forgetpassword', 'id' => 'forgetpassword');
					echo form_open('admin/forgetpassword', $attributes);
					?>             
                   
      <div class="form-group has-feedback">
        <input type="text" placeholder="Email" name="email" id="email" class="form-control">
       <span style="color:red;"> <?php echo form_error('email'); ?></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Send</button>
        </div>
        <!-- /.col -->
      </div>
     <?php echo form_close();?>
	<p>&nbsp;</p>
    <a href="#">Back to login</a><br>
  </div>
  </div>
  <!-- /.login-box-body -->
</div>