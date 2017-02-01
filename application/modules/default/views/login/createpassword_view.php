<div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 col-md-9 col-lg-9 registration_main2">
			<?php 
			if(isset($ofo_loginmsg))
			{?>
			<p class="bg-danger bg-danger-helper text-center"><?php echo $ofo_loginmsg;	?></p>
			<?php }?>
			  <form class="form-login" action="" method="post" enctype="multipart/form-data"> 
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="margin:auto;">
             <div class="form-group ">
              <label for="email_login">New Password</label>
              <input type="password" class="form-control" name="npass" id="npass" placeholder="New Password">
                     <span style="color:red;"> <?php echo form_error('npass'); ?></span>
            </div>
            <br />
            <div class="form-group ">
             <label for="password">Confirm Password</label>
             <input type="password" class="form-control"  name="cpass" id="cpass" placeholder="Confirm Password">
               <span style="color:red;"> <?php echo form_error('cpass'); ?></span>
           </div>
             <br />
            <div class="form-group">             
             <button type="submit" class="btn btn-success login_input2">Submit</button>
           </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
			</form>
        </section>
        <aside class="col-right sidebar col-sm-3 wow">
          <div class="block block-banner"><a href="#"><img src="<?php echo base_url();?>/assets/front/images/block-banner.png" alt="block-banner"></a></div>
        </aside>
      </div>
    </div>
  </div>
