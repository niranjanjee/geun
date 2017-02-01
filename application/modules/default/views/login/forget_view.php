<div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
          <!---------section right------------>
        <section class="col-sm-9 col-md-9 col-lg-9 registration_main2">
	<?php 
			if(isset($loginmsg))
			{?>
			<p class="bg-danger bg-danger-helper text-center"><?php echo $loginmsg;	?></p>
			<?php }?>
			<?php
			$attributes = array('method' => 'post', 'name' => 'createaccountform', 'id' => 'createaccountform', 'class' => 'login-form');
			echo form_open('forget', $attributes);
			?>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="margin:auto;">
             <div class="form-group "><h3 style="margin-left:150px;">Reset your password</h3>
              <label for="email_login">Enter your email address and we will send you a link to reset your password.</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                  <span style="color:red;"> <?php echo form_error('email'); ?></span>
            </div>
      
             <br />
            <div class="form-group">             
             <button type="submit" class="btn btn-success login_input2">Submit</button>
           </div>
        
                </div>
                <div class="col-sm-2"></div>
            </div>
			<?php echo form_close();?>
        </section>
       <!---------end section right------------>
        <aside class="col-right sidebar col-sm-3 wow">
          <div class="block block-banner"><a href="#"><img src="<?php echo base_url();?>/assets/front/images/block-banner.png" alt="block-banner"></a></div>
        </aside>
      </div>
    </div>
  </div>
