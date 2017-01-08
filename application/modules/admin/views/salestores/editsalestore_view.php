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
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Sales Store</h3>
				</div>
            <!-- form start -->	
				  <div class="box-body">
					<?php
					$attributes = array('method' => 'post', 'name' => 'editsalesstoreform_admin', 'id' => 'editsalesstoreform_admin');
					echo form_open('admin/salestores/edit', $attributes);
					?>
				    <div class="col-md-5">
						<input type="hidden" placeholder="" id="sid" name="sid" class="form-control" value="<?php echo (isset($sid) && $sid != null)?$sid:0;?>">
                        <div class="form-group">
                          <label for="">Store Name</label>                          
                            <input type="text" placeholder="" id="name" name="name" class="form-control" value="<?php echo (isset($store->name) && $store->name != null)?$store->name:(isset($name)?$name:'');?>">
							<?php echo form_error('name'); ?>                          
                        </div>
                        <div class="form-group">
                          <label for="">Address</label>                          
                             <input type="text" placeholder="" id="address" name="address" class="form-control" value="<?php echo (isset($store->address) && $store->address != null)?$store->address:(isset($address)?$address:'');?>">
							 <?php echo form_error('address'); ?>                         
                        </div>
                        
						
						<div class="form-group">
                          <label for="">City</label>                          
                            <input type="text" placeholder="" id="city" name="city" class="form-control" value="<?php echo (isset($store->city) && $store->city != null)?$store->city:(isset($city)?$city:'');?>">
							<?php echo form_error('city'); ?>                         
                        </div>
						
						<div class="form-group">
                          <label for="">Contact No.</label>                          
                            <input type="text" placeholder="" id="contact_no" name="contact_no" class="form-control" value="<?php echo (isset($store->contact_no) && $store->contact_no != null)?$store->contact_no:(isset($contact_no)?$contact_no:'');?>">
							<?php echo form_error('contact_no'); ?>                        
                        </div> 
						<div class="form-group">
						  <label>Status</label>
						  <select class="form-control" name="status" id="status">
							<option value="1" <?php echo (isset($status) && $status == 1)?'selected="selected"':'';?>>Active</option>
							<option value="0" <?php echo (isset($status) && $status == 0)?'selected="selected"':'';?>>Inactive</option>
						  </select>
						</div>
                    </div>
					<div class="col-md-5">
						<div class="form-group">
                          <label for="">Country</label>         
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
						<div class="form-group">
                          <label for="">State</label>           
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
						<div class="form-group">
                          <label for="">Zipcode</label>                          
                            <input type="text" placeholder="" id="zipcode" name="zipcode" class="form-control" value="<?php echo (isset($store->zipcode) && $store->zipcode != null)?$store->zipcode:(isset($zipcode)?$zipcode:'');?>">
							<?php echo form_error('zipcode'); ?>                          
                        </div>						
						<div class="form-group">
                          <label for="">About Store</label>                          
                            <textarea name="about_store" id="about_store" class="form-control" cols="121" rows="4"><?php echo (isset($store->about_store) && $store->about_store != null)?$store->about_store:(isset($about_store)?$about_store:'');?></textarea>
							<?php echo form_error('about_store'); ?>                          
                        </div> 
					</div>
					<?php echo form_close();?>
					<div class="col-md-2">
						<div class="thumbnail">
						<?php
							 $logo_path = ($store->logo != null)?$this->config->item('store_img_upload_path').$store->id."/".$store->logo:null;
							if($logo_path == null)
							{
								$logo_path = $default_image;
							}
						?>
							<img src="<?php echo base_url().$logo_path;?>" id="store-logo" alt="default-image">
						</div>
						<?php
						$attributes = array('method' => 'post', 'name' => 'storeuploadform', 'id' => 'storeuploadform', 'class' => 'form-horizontal text-center', 'role' => 'form');
						echo form_open_multipart('/default/myaccount/uploadfile', $attributes);
						?>
						<span class="btn btn-primary fileinput-button">
							<i class="fa fa-picture-o" aria-hidden="true"></i> Upload
							<input id="file_upload" name="file_upload" type="file">
						</span>
						<span><img alt="loader-image" class="ajaxloader" style="display:none;" src=""></span>
						<input type="hidden" name="sid" id="sid" value="<?php echo isset($store->id)?$store->id:0?>" />
						<input type="hidden" name="ajax" id="ajax" value="1" />
						<?php echo form_close();?>	
						<p class="text-center img-note"><i>Max Size:5MB<br>Max Dimension:400&times;400</i></p>
					</div>
				  </div>				  
				  <!-- /.box-body -->
				  <div class="box-footer">
					<button class="btn btn-primary" type="button" id="adminstore_save">Save</button>
				  </div>
          </div>
		</div>
</div>
</section>
<script>
$(document).ready(function(){
	$("#editsalesstoreform_admin #country").change(function(){
		$.ajax({
			method:'POST',
			url:'/admin/salestores/getstates',
			data:{"country":$(this).val(), "ajax":1, "<?php echo $this->security->get_csrf_token_name()?>":"<?php echo $this->security->get_csrf_hash()?>"},
			dataType:'json',
			beforeSend:function(){
				$("#editsalesstoreform_admin #state").html('<option value="">Loading...</option>');
			},
			success:function(response){
				var state_html = '<option value="">Select State</option>';
				$.each(response.states, function(i, v){
					state_html += '<option value="'+v.id+'">'+v.state_name+'</option>'
				});
				$("#editsalesstoreform_admin #state").html(state_html);
			},
			error:function(){
				alert("Unable to fetch data...")
			}
		});
	});
	
	$("#adminstore_save").click(function(){
		$("#editsalesstoreform_admin").submit();
	})

	$("#editsalesstoreform_admin").validate({
		rules: {
			name: {
				required: true,
			},
			address: {
				required: true,
				maxlength:150
			},
			country: {
				required: true,
			},
			state: {
				required: true,
			},
			city: {
				required: true,     
			},
			zipcode: {
				required: true
			},
			contact_no: {
				required: true,
				digits:true,
			}
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>
<script>
$(function () {
    $('#file_upload').fileupload({
		timeout:8000,
        url: '<?php echo base_url()?>admin/salestores/uploadfile',
        dataType: 'json',
        progressall: function (e, data) {
			$("#storeuploadform img.ajaxloader").attr('src', '<?php echo base_url();?>assets/front/img/ajax-loader.gif');
			$("#storeuploadform img.ajaxloader").show();
        }
    }).on('fileuploadadd', function (e, data) {
        $("#progress").show();
    }).on('fileuploaddone', function (e, data) {
		data = data.result;
		if(data.status == "success")
		{		
			$("img#store-logo").attr("src", "/assets/front/stores/"+data.sid+"/"+data.upload_data.file_name+"?"+new Date().getTime());
		}
		else if(data.status == "failed")
		{
			alert(data.error);
		}
		else
		{
			alert("File is not uploaded. Some technical error happened...");
		}
        
		$("#storeuploadform img.ajaxloader").hide();
    }).on('fileuploadfail', function (e, data) {
		alert("upload failed");
		$("#storeuploadform img.ajaxloader").hide();		
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>