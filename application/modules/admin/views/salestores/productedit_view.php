<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/fileupload/jquery.fileupload.css">
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.ui.widget.js"></script> 
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.iframe-transport.js"></script> 
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.fileupload.js"></script>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; <?php echo ucwords($store_name->name);?> &raquo; Product</h3>
				  <a href="/admin/salestores/viewproduct/<?php echo $sid;?>" class="pull-right btn btn-success">Back</a>
				</div>
            <!-- form start -->	
				  <div class="box-body">
					<?php
					$attributes = array('method' => 'post', 'name' => 'editproductform_admin', 'id' => 'editproductform_admin');
					echo form_open('admin/salestores/productedit/'.$sid.'/'.$pid, $attributes);
					?>
				    <div class="col-md-6">
						<input type="hidden" placeholder="" id="sid" name="sid" class="form-control" value="<?php echo (isset($sid) && $sid != null)?$sid:0;?>">
						<input type="hidden" placeholder="" id="pid" name="pid" class="form-control" value="<?php echo (isset($pid) && $pid != null)?$pid:0;?>">
                        <div class="form-group">
                          <label for="">Title</label>                          
                            <input type="text" placeholder="" id="title" name="title" maxlength="200" class="form-control" value="<?php echo isset($title)?$title:'';?>">
							 <?php echo form_error('title'); ?>                         
                        </div>
                        <div class="form-group">
                          <label for="">Gemstone</label>
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
                        <div class="form-group">
                          <label>Gemstone Species</label>
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
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-lt-padding">
							  <label for="">Price</label>
								<input type="text" placeholder="" id="gemstone_price" name="gemstone_price" maxlength="145" class="form-control" value="<?php echo isset($gemstone_price)?$gemstone_price:'';?>">
								<?php echo form_error('gemstone_price'); ?>
							</div>
							<div class="form-group col-md-6 no-rt-padding">
							  <label for="">Carat Weight</label>
								<input type="text" placeholder="0.00" id="carat_weight1" name="carat_weight1" maxlength="5" class="form-control" value="<?php echo isset($carat_weight1)?$carat_weight1:'';?>">
								<?php echo form_error('carat_weight1'); ?>
							</div>
						</div>
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-4 no-rt-lt-padding">
							  <label for="">Height</label>
								<input type="text" placeholder="Height" id="height" name="height" class="form-control" value="<?php echo isset($height)?$height:'';?>">
							    <?php echo form_error('height'); ?>
							</div>
							<div class="form-group col-md-4 no-rt-padding">
							  <label for="">Width</label>
								<input type="text" placeholder="Width" id="width" name="width" class="form-control" value="<?php echo isset($width)?$width:'';?>">
							   <?php echo form_error('width'); ?>
							</div>
							<div class="form-group col-md-4 no-rt-padding">
							  <label for="">Length</label>
								<input type="text" placeholder="Length" id="length" name="length" class="form-control" value="<?php echo isset($length)?$length:'';?>">
								<?php echo form_error('length'); ?>
							</div>
						</div>
						<div class="col-md-12 no-rt-lt-padding">
							<label for="">Colors</label>
							<div class="form-group product-colors clearfix">
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
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-lt-padding">
							  <label for="">Stone ID</label>
								<input type="text" placeholder="" id="stone_ID" name="stone_ID" maxlength="30" class="form-control" value="<?php echo isset($stone_ID)?$stone_ID:'';?>">
								<?php echo form_error('stone_ID'); ?>
							</div>
							<div class="form-group col-md-6 no-rt-padding">
								<label for="shape">Shape</label> 
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
						  <label>Status</label>
						  <select class="form-control" name="status" id="status">
							<option value="1" <?php echo (isset($status) && $status == 1)?'selected="selected"':'';?>>Active</option>
							<option value="0" <?php echo (isset($status) && $status == 0)?'selected="selected"':'';?>>Inactive</option>
						  </select>
						</div>	     
                    </div>
					<div class="col-md-6">
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-padding">
								<label for="cutting">Cutting</label> 
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
							<div class="form-group col-md-6 no-rt-padding">
								<label for="clarity">Clarity</label> 
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
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-padding">
								<label for="transparency">Transparency</label> 
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
							<div class="form-group col-md-6 no-rt-padding">
								<label for="geo_origin">Geographical Origin</label> 
								<input type="text" placeholder="" id="geo_origin" name="geo_origin" class="form-control" value="<?php echo isset($geo_origin)?$geo_origin:'';?>">
								<?php echo form_error('geo_origin'); ?>
							</div>
						</div>
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-padding">
								<label for="treatment">Treatments</label> 
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
							<div class="form-group col-md-6 no-rt-padding">
								<label for="certificate">Certificate</label> 
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
						
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-padding">
								<label for="offer">Offer</label> 
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
							<div class="form-group col-md-6 no-rt-padding">
								<label for="country">Country</label> 
								<select name="country" id="country" class="form-control">
									<option value="">Select Country</option>
									<?php foreach($countries as $c){
										$sel = "";
										if((isset($store->country_id) && $store->country_id == $c->id) || (isset($country) && $country == $c->id)){
											$sel = 'selected="selected"';
										}
									?>
									<option value="<?php echo $c->id;?>" <?php echo $sel;?>><?php echo $c->country_name;?></option>
									<?php }?>
								</select>
								<?php echo form_error('country'); ?>  
							</div>
						</div>
						<div class="col-md-12 no-rt-lt-padding">
							<div class="form-group col-md-6 no-rt-padding">
								<label for="offer">State</label> 
								<select name="state" id="state" class="form-control">
									<option value="">Select State</option>
									<?php if(isset($states)){
										foreach($states as $s){
										$sel = "";
										if((isset($store->state_id) && $store->state_id == $s->id) || (isset($state) && $state == $s->id)){
											$sel = 'selected="selected"';
										}
									?>
									<option value="<?php echo $s->id;?>" <?php echo $sel;?>><?php echo $s->state_name;?></option>
									<?php 
										}
									}
									?>
								</select>
								<?php echo form_error('state'); ?>
							</div>
							<div class="form-group col-md-6 no-rt-padding">
								<label for="city">City</label> 
								<input type="text" placeholder="Enter City" id="city" name="city" maxlength="50" class="form-control" value="<?php echo isset($city)?ucwords($city):'';?>">
								 <?php echo form_error('city'); ?>
							</div>
						</div>		
						<div class="col-md-12 no-rt-lt-padding">	
							<div class="form-group col-md-12 no-rt-padding">
							  <label for="">Description</label>                          
								<textarea name="about_store" id="about_store" class="form-control" cols="121" rows="4"><?php echo (isset($store->about_store) && $store->about_store != null)?$store->about_store:(isset($about_store)?$about_store:'');?></textarea>
								<?php echo form_error('about_store'); ?>                          
							</div> 
						</div>	
					</div>
					<?php echo form_close();?>
				  </div>				  
				  <!-- /.box-body -->
				  <div class="box-footer">
					<button class="btn btn-primary" type="button" id="adminproduct_save">Save</button>
				  </div>
          </div>
		</div>
</div>
</section>
<script>
$(document).ready(function(){
	$("#editproductform_admin #country").change(function(){
		$.ajax({
			method:'POST',
			url:'/admin/salestores/getstates',
			data:{"country":$(this).val(), "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				$("#editproductform_admin #state").html('<option value="">Loading...</option>');
			},
			success:function(response){
				var state_html = '<option value="">Select State</option>';
				$.each(response.states, function(i, v){
					state_html += '<option value="'+v.id+'">'+v.state_name+'</option>'
				});
				$("#editproductform_admin #state").html(state_html);
			},
			error:function(){
				alert("Unable to fetch data...")
			}
		});
	});
	
	$("#adminproduct_save").click(function(){
		$("#editproductform_admin").submit();
	})
	$("#editproductform_admin").validate({
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
		submitHandler: function(form) {
			form.submit();
		}
	});

});
</script>
