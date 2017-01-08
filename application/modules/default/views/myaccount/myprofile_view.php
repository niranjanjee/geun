<section class="clearfix userdashboard" id="myaccount-section">
	<div class="container">
	  <div class="row">
		<div class="col-xs-12 account-nav">
		  <?php $this->load->view('myaccount_nav_view');?>
		</div>
	  </div>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="inner-wrapper clearfix">
			<h3>My Profile</h3>
			<?php if($this->session->flashdata('myprofile_msg')){?>
			<p class="bg-success"><?php echo $this->session->flashdata('myprofile_msg');?></p>
			<?php }
			else
			{
				echo "<p>&nbsp;</p>";
			}?>
			<div class="profile-wrapper">
				<div class="col-md-10 col-sm-9 col-xs-12">
					  <?php
						$attributes = array('method' => 'post', 'name' => 'myprofileform', 'id' => 'myprofileform', 'class' => 'form-horizontal', 'role' => 'form');
						echo form_open('/default/myaccount/myprofile', $attributes);
						?>
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Name</label>
                          <div class="col-md-10 col-sm-9 user-info">
                            <p><?php echo $user->title.' '.ucwords($user->name);?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Email Address</label>
                          <div class="col-md-10 col-sm-9 user-info">
                             <p class="p-info"><?php echo $user->email;?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Contact No.</label>
                          <div class="col-md-10 col-sm-9">
                            <input type="text" placeholder="" id="contact_no" name="contact_no" class="form-control" value="<?php echo (isset($user->contact_no) && $user->contact_no != null)?$user->contact_no:(isset($contact_no)?$contact_no:'');?>">
							<?php echo form_error('contact_no'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Skype ID</label>
                          <div class="col-md-10 col-sm-9">
                            <input type="text" placeholder="" id="skypeid" name="skypeid" class="form-control" value="<?php echo (isset($user->skypeid) && $user->skypeid != null)?$user->skypeid:(isset($skypeid)?$skypeid:'');?>">
							<?php echo form_error('skypeid'); ?>
                          </div>
                        </div>
                                                
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12">
                            <input class="btn btn-green pull-right" type="submit" value="SAVE INFO" name="save_info"/>
                          </div>
                        </div>
                      <?php echo form_close();?>
                 </div>
				
				 <div class="col-md-10 col-sm-9 col-xs-12">
				  <hr style="color:#688534;border:1px solid #688534;background-color:#688534;">
				  <h3>Change Password</h3>
					  <?php
						$attributes = array('method' => 'post', 'name' => 'myprofilechangpasswordform', 'id' => 'myprofilechangpasswordform', 'class' => 'form-horizontal', 'role' => 'form');
						echo form_open('/default/myaccount/myprofile', $attributes);
						?>                        
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Old Password</label>
                          <div class="col-md-10 col-sm-9">
                            <input type="password" placeholder="" id="old_password" name="old_password" class="form-control" value="<?php echo (isset($old_password)?$old_password:'')?>">
							<?php echo form_error('old_password'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">New Password</label>
                          <div class="col-md-10 col-sm-9">
                            <input type="password" placeholder="" id="new_password" name="new_password" class="form-control">
							<?php echo form_error('new_password'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label" for="">Confirm Password</label>
                          <div class="col-md-10 col-sm-9">
                            <input type="password" placeholder="" id="confpassword" name="confpassword" class="form-control">
							<?php echo form_error('confpassword'); ?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12">
							<input class="btn btn-green pull-right" type="submit" value="CHANGE PASSWORD" name="change_passord"/>
                          </div>
                        </div>
                      <?php echo form_close();?>
                 </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
  <script>
$(document).ready(function(){
	$("#myprofilechangpasswordform").validate({
		rules: {
			old_password: {
				required: true,
				minlength: 6
                },   
			new_password: {
				required: true,
				minlength: 6
                },
			confpassword: {
				required: true,
				minlength: 6,
				equalTo: function(){
						return "#new_password";
					}
                }		
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>