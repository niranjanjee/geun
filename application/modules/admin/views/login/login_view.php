<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

   <div class="login-box">
  <div class="login-logo">
   <b>Admin</b>&nbsp;Management
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login Here</p>
	<?php
	if(isset($loginmsg)){
	echo '<div class="alert alert-danger">
		<i class="icon fa fa-ban"></i>
		'.$loginmsg.'
	</div>';
	}
	?>
	<?php
	$attributes = array('method' => 'post', 'name' => 'loginform', 'id' => 'loginform');
	echo form_open('admin/index', $attributes);
	?>
      <div class="form-group has-feedback">
        <input type="text" placeholder="User Name" class="form-control" name="username" id="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" placeholder="Password" class="form-control" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>
	<p>&nbsp;</p>
    <a href="admin/forgetpassword/">I forgot my password</a><br>
  </div>
  <!-- /.login-box-body -->
</div>