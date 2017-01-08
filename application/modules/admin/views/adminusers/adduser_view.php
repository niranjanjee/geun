<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Add user</h3>
				</div>
            <!-- form start -->
				<?php
					$attributes = array('method' => 'post', 'name' => 'adduserform_admin', 'id' => 'adduserform_admin');
					echo form_open('admin/adminusers/adduser', $attributes);
					?>
				  <div class="box-body">
				    <div class="col-md-6">
						<div class="form-group">
						  <label for="name">Full Name</label>
						  <input type="text" placeholder="Full Name" id="name" name="name" class="form-control" value="<?php echo (isset($adminuser->name))?$adminuser->name:(isset($name)?$name:'');?>">
						  <?php echo form_error('name'); ?>
						  <?php $adminid = (isset($adminuser->id))?$adminuser->id:(isset($adminid)?$adminid:'');?>
						  <input type="hidden" id="adminid" name="adminid" value="<?php echo $adminid;?>">
						</div>
						<div class="form-group">
						  <label for="email">Email</label>
						  <input type="text" placeholder="Email" id="email" name="email" class="form-control" value="<?php echo (isset($adminuser->email))?$adminuser->email:(isset($email)?$email:'');?>">
						  <?php echo form_error('email'); ?>
						</div>
						<div class="form-group">
						  <label for="contact">Contact No.</label>
						  <input type="text" placeholder="Contact No." id="contact" name="contact" class="form-control" value="<?php echo (isset($adminuser->contact))?$adminuser->contact:(isset($contact)?$contact:'');?>">
						  <?php echo form_error('contact'); ?>
						</div>
						<div class="form-group">
						  <label for="username">Username</label>
						  <input type="text" placeholder="User Name" id="username" name="username" class="form-control" value="<?php echo (isset($adminuser->username))?$adminuser->username:(isset($username)?$username:'');?>">
						  <?php echo form_error('username'); ?>
						</div>
						<div class="form-group">
						  <label for="password">Password</label>
						  <input type="password" placeholder="Password" id="password" name="password" class="form-control">
						  <?php echo form_error('password'); ?>
						</div>
						<div class="form-group">
						  <label for="password">Confirm Password</label>
						  <input type="password" placeholder="Confirm Password" id="confpassword" name="confpassword" class="form-control">
						  <?php echo form_error('confpassword'); ?>
						</div>
						<div class="form-group">
						  <label>Status</label>
						  <select class="form-control" name="status" id="status">
							<option value="1" <?php echo (isset($status) && $status == 1)?'selected="selected"':'';?>>Active</option>
							<option value="0" <?php echo (isset($status) && $status == 0)?'selected="selected"':'';?>>Inactive</option>
						  </select>
						</div>
					</div>
				  </div>
				  <!-- /.box-body -->

				  <div class="box-footer">
					<button class="btn btn-primary" type="submit">Submit</button>
				  </div>
				 <?php echo form_close();?>
          </div>
		</div>
</div>
</section>
<script>
$(document).ready(function(){
	var adminid = "<?php echo $adminid?>";
	$("#adduserform_admin").validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			contact: {
				required: true,
				minlength: 10
			},
			password: {
				required: function(){
                    return  adminid == 0;
                },
				minlength: function(){
                    if(adminid == 0){
						return 5;
					}
                }         
			},
			confpassword: {
				required: function(){
                    return  adminid == 0;
                },
				minlength: function(){
                    if(adminid == 0){
						return 5;
					}
                },         
				equalTo: function(){
                    if(adminid == 0){
						return "#password";
					}
                } 
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>