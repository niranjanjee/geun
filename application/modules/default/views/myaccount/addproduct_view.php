<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/select2/select2-bootstrap.css">
<script src="<?php echo base_url(); ?>assets/front/js/select2.full.js"></script>

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
			<h3>Add Product</h3>
			<?php if($this->session->flashdata('mystore_msg')){?>
			<p class="bg-success"><?php echo $this->session->flashdata('mystore_msg');?></p>
			<?php }
			else
			{
				echo "<p>&nbsp;</p>";
			}?>		
			<div class="product-wrapper">
				<?php if(isset($product->id)){?>
				<div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="thumbnail">
                      <img alt="default-image" src="<?php echo base_url();?>assets/front/img/default-gem.png">
                      <div class="caption">
					    <span class="btn btn-primary btn-block fileinput-button">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<span>Upload Logo</span>
							<input id="fileupload" type="file" name="files[]">
						</span>
                      </div>
                    </div>
                  </div>
				<?php }?>
				<div class="col-md-10 col-sm-9 col-xs-12">
					  <?php
						$pid_wis = (isset($pid) && $pid > 0)?"/".$pid:"";
						$attributes = array('method' => 'post', 'name' => 'myproductform', 'id' => 'myproductform', 'class' => 'form-horizontal', 'role' => 'form');
						echo form_open('/default/myaccount/addproduct/'.$sid.$pid_wis, $attributes);
						?>
						<input type="hidden" id="sid" name="sid" class="form-control" value="<?php echo (isset($sid) && $sid != null)?$sid:0;?>">
						<input type="hidden" id="pid" name="pid" class="form-control" value="<?php echo (isset($pid) && $pid != null)?$pid:0;?>">
                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Title</label>
                          <div class="col-md-9 col-sm-9 user-info">
                             <input type="text" placeholder="" id="title" name="title" maxlength="200" class="form-control" value="<?php echo (isset($product->title) && $product->title != null)?$product->title:(isset($title)?$title:'');?>">
							 <?php echo form_error('title'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Gemstone</label>
                          <div class="col-md-9 col-sm-9 user-info">
                            <select name="gemstone_category" id="gemstone_category" class="form-control">
								<option value="">Select Gemstone</option>
								<?php foreach($gemstone_categories as $s){
									$sel = "";
									if(isset($gemstone_category) && $gemstone_category == $s->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $s->id;?>" <?php echo $sel;?>><?php echo ucwords($s->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('gemstone_category'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="gemstone_species">Gemstone Species</label>
                          <div class="col-md-9 col-sm-9 user-info">
                            <select name="gemstone_specie" id="gemstone_specie" class="form-control">
								<option value="">Select Gemstone Species</option>
								<?php foreach($gemstone_species as $s){
									$sel = "";
									if(isset($gemstone_specie) && $gemstone_specie == $s->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $s->id;?>" <?php echo $sel;?>><?php echo ucwords($s->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('gemstone_specie'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Price per caret</label>
                          <div class="col-md-9 col-sm-9 user-info">
                            <input type="text" placeholder="" id="gemstone_price" name="gemstone_price" maxlength="145" class="form-control" value="<?php echo isset($gemstone_price)?$gemstone_price:'';?>">
							<?php echo form_error('gemstone_price'); ?>
                          </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label" for="">Carat Weight</label>
						    <div class="col-md-9 col-sm-9 no-lt-padding no-rt-padding">
							  <div class="col-md-3 col-sm-3 no-rt-padding">
								<input type="text" placeholder="0.00" id="carat_weight1" name="carat_weight1" maxlength="5" class="form-control" value="<?php echo isset($carat_weight1)?$carat_weight1:'';?>">
							  </div>
							  <div class="col-md-2 col-sm-3 no-lt-padding">
								<p class="form-caret">Carets</p>
							  </div>
							  <?php echo form_error('carat_weight1');  ?>
							</div>  
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Stone ID</label>
                          <div class="col-md-9 col-sm-9 user-info">
                             <input type="text" placeholder="" id="stone_ID" name="stone_ID" maxlength="30" class="form-control" value="<?php echo isset($stone_ID)?$stone_ID:'';?>">
							 <?php echo form_error('stone_ID'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Measurements</label>
						    <div class="col-md-9 col-sm-9 no-lt-padding no-rt-padding">
							    <div class="col-md-4 col-sm-3">
									<input type="text" placeholder="Height" id="height" name="height" class="form-control" value="<?php echo isset($height)?$height:'';?>">
									<?php echo form_error('height'); ?>
							    </div>
							    <div class="col-md-4 col-sm-3">
									<input type="text" placeholder="Width" id="width" name="width" class="form-control" value="<?php echo isset($width)?$width:'';?>">
									<?php echo form_error('width'); ?>
							    </div>
							    <div class="col-md-4 col-sm-3">
									<input type="text" placeholder="Length" id="length" name="length" class="form-control" value="<?php echo isset($length)?$length:'';?>">
									<?php echo form_error('length'); ?>
							    </div>
							     	
						    </div>
                        </div>	
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="color">Color</label>
                          <div class="col-md-9 col-sm-9">
							<div class="col-md-12 col-sm-12 product-colors">
                            <?php 
							foreach($colors as $c){ ?>
								<label class="col-md-3">
								  <input type="checkbox" name="color[]" id="color<?php echo $c->id?>" value="<?php echo $c->id?>" <?php echo (isset($color) && in_array($c->id, $color))?'checked="checked"':'';?>>
								  <?php echo ucwords($c->name);?>&nbsp;&nbsp;<img src="/assets/front/img/colors/<?php echo $c->color_image;?>" />
								</label>
							<?php 
							} ?>
							</div>
							<?php echo form_error('color'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Shape</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="shape" id="shape" class="form-control">
								<option value="">Select Shape</option>
								<?php foreach($shapes as $s){
									$sel = "";
									if(isset($shape) && $shape == $s->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $s->id;?>" <?php echo $sel;?>><?php echo ucwords($s->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('shape'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Cutting</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="cutting" id="cutting" class="form-control">
								<option value="">Select Cutting</option>
								<?php foreach($cuttings as $c){
									$sel = "";
									if(isset($cutting) && $cutting == $c->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $c->id;?>" <?php echo $sel;?>><?php echo ucwords($c->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('cutting'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Clarity</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="clarity" id="clarity" class="form-control">
								<option value="">Select Clarity</option>
								<?php foreach($clarities as $c){
									$sel = "";
									if(isset($clarity) && $clarity == $c->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $c->id;?>" <?php echo $sel;?>><?php echo ucwords($c->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('clarity'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="transparency">Transparency</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="transparency" id="transparency" class="form-control">
								<option value="">Select Transparency</option>
								<?php foreach($transparencies as $t){
									$sel = "";
									if(isset($transparency) && $transparency == $t->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $t->id;?>" <?php echo $sel;?>><?php echo ucwords($t->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('transparency'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Geographical Origin</label>
                          <div class="col-md-9 col-sm-9">
                            <input type="text" placeholder="" id="geo_origin" name="geo_origin" class="form-control" value="<?php echo isset($geo_origin)?$geo_origin:'';?>">
							<?php echo form_error('geo_origin'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Treatments</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="treatment" id="treatment" class="form-control">
								<option value="">Select Treatments</option>
								<?php foreach($treatments as $t){
									$sel = "";
									if(isset($treatment) && $treatment == $t->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $t->id;?>" <?php echo $sel;?>><?php echo ucwords($t->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('treatment'); ?>
                          </div>
                        </div>	
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Certificates</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="certificate" id="certificate" class="form-control">
								<option value="">Select Certificate</option>
								<?php foreach($certificates as $c){
									$sel = "";
									if(isset($certificate) && $certificate == $c->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $c->id;?>" <?php echo $sel;?>><?php echo ucwords($c->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('certificate'); ?>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Special Offer</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="offer" id="offer" class="form-control">
								<option value="">Select Offer</option>
								<?php foreach($offers as $f){
									$sel = "";
									if(isset($offer) && $offer == $f->id){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $f->id;?>" <?php echo $sel;?>><?php echo ucwords($f->name);?></option>
								<?php }?>
							</select>
							<?php echo form_error('offer'); ?>
                          </div>
                        </div>						
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Stone Location</label>
						  <div class="col-md-9 col-sm-9 no-lt-padding no-rt-padding">
							  <div class="col-md-4 col-sm-4">
								<select name="country" id="country" class="form-control">
									<option value="">Select Country</option>
									<?php foreach($countries as $c){
										$sel = "";
										if(isset($country) && $country == $c->id){
											$sel = 'selected="selected"';
										}
									?>
									<option value="<?php echo $c->id;?>" <?php echo $sel;?>><?php echo ucwords($c->country_name);?></option>
									<?php }?>
								</select>
								<?php echo form_error('country'); ?>
							  </div>
							   <div class="col-md-4 col-sm-4">
								<select name="state" id="state" class="form-control">
									<option value="">Select State</option>
									<?php 
									if(isset($states))
									{
										foreach($states as $s){
										$sel = "";
										if(isset($state) && $state == $s->id){
											$sel = 'selected="selected"';
										}
									?>
									<option value="<?php echo $s->id;?>" <?php echo $sel;?>><?php echo ucwords($s->state_name);?></option>
									<?php 
										}
									}	
									?>
								</select>
								<?php echo form_error('state'); ?>
							  </div>
							  <div class="col-md-4 col-sm-4 user-info">
								 <input type="text" placeholder="Enter City" id="city" name="city" maxlength="50" class="form-control" value="<?php echo isset($city)?ucwords($city):'';?>">
								 <?php echo form_error('city'); ?>
							  </div>
							  </div>	
                        </div>		
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Price Negotiable</label>
                          <div class="col-md-9 col-sm-9">
                            <select name="negotiable" id="negotiable" class="form-control">
								<option value="">Select</option>
								<?php foreach($negotiables as $k => $n){
									$sel = "";
									if(isset($negotiable) && $negotiable == $k){
										$sel = 'selected="selected"';
									}
								?>
								<option value="<?php echo $k;?>" <?php echo $sel;?>><?php echo ucwords($n);?></option>
								<?php }?>
							</select>
							<?php echo form_error('certificate'); ?>
                          </div>
                        </div>				
						<div class="form-group">
                          <label class="col-md-3 col-sm-3 control-label" for="">Description</label>
                          <div class="col-md-9 col-sm-9">
                            <textarea name="description" id="description" class="form-control" cols="121" rows="4"><?php echo isset($description)?$description:'';?></textarea>
                          </div>
                        </div> 	
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12">
                            <button class="btn btn-green pull-right" type="submit">SAVE INFO</button>
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
	
	$( "#gemstone_category" ).select2({
		theme: "bootstrap"
	});
	$(".select2-container--bootstrap").css("width", "");
	$("#myproductform #country").change(function(){
		$.ajax({
			method:'POST',
			url:'/default/myaccount/getstates',
			data:{"country":$(this).val(), "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				$("#myproductform #state").html('<option value="">Loading...</option>');
			},
			success:function(response){
				var state_html = '<option value="">Select State</option>';
				$.each(response.states, function(i, v){
					state_html += '<option value="'+v.id+'">'+v.state_name+'</option>'
				});
				$("#myproductform #state").html(state_html);
			},
			error:function(){
				alert("Some technical error...");
			}
		});
	});
	
	$("#myproductform").validate({
		rules: {
			title: {
				required: true,
			},
			gemstone_category: {
				required: true,
			},
			gemstone_specie: {
				required: true,
			},
			gemstone_price: {
				required: true,
				number:true
			},
			carat_weight1: {
				required: true,   
				number:true	
			},
			height: {
				required: true,
				number:true	
			},
			width: {
				required: true,
				number:true	
			},
			length: {
				required: true,
				number:true	
			},
		},
		errorPlacement: function(error, element) {	
			if (element.attr("name") == "gemstone_category") {
				error.insertAfter( $(".select2 ") );
			}else{
				error.insertAfter(element);
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
	
});
</script>