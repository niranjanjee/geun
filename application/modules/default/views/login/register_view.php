<div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
          <!---------section right------------>
        <section class="col-main col-sm-9 wow registration_main">
           <div class="category-title">
            <h1> Please fill out the form below.</h1>
          </div>
		  <?php
		$attributes = array('method' => 'post', 'name' => 'createaccountform', 'id' => 'createaccountform', 'class' => 'form-horizontal', 'role' => 'form');
		echo form_open('register', $attributes);
		?>
           <div class="static-contain">
            <fieldset class="group-select">
              <ul>
                <li id="billing-new-address-form">
                  <fieldset>
                    <ul>                     
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="name">  Name<span class="required">*</span></label>
                            <br>
							<input type="text" class="input-text" id="name" name="name" value="<?php isset($name)?$name:'';?>">
							<?php echo form_error('name'); ?>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="email"> Email Id <span class="required">*</span> </label>
                            <br>
                            <input type="email" class="input-text" id="email" name="email" value="<?php isset($email)?$email:'';?>">
							<?php echo form_error('email'); ?>
                          </div>
                        </div>
                      </li>
                       <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="password"> Password <span class="required">*</span></label>
                            <br>
                            <input type="password" class="input-text" id="password" name="password">
							<?php echo form_error('password'); ?>
                          </div>
                          <div class="input-box name-lastname">
                            <label for="confpassword"> Confirm Password <span class="required">*</span> </label>
                            <br>
                            <input type="password" class="input-text" id="confpassword" name="confpassword">
							<?php echo form_error('confpassword'); ?>
                          </div>
                        </div>
                      </li>

                      
                    </ul>
                  </fieldset>
                </li>
                <br>

                <p class="require"><em class="required">* </em>Required Fields</p>
                <input name="hideit" id="hideit" value="" style="display:none !important;" type="text">
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"> <span> Submit </span> </button>
                </div>
              </ul>
            </fieldset>
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
  <script>
$(document).ready(function(){
	$("#createaccountform-submit").click(function(){
		$("#createaccountform").submit();
	});
	$("#createaccountform").validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6
			},
			confpassword: {
				required: true,
				minlength: 6,         
				equalTo: function(){
                    return "#password";
                } 
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>