<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Add Offer</h3>
				</div>
            <!-- form start -->
				<?php
					$attributes = array('method' => 'post', 'name' => 'addofferform_admin', 'id' => 'addofferform_admin');
					echo form_open('admin/storesettings/addoffer', $attributes);
					?>
				  <div class="box-body">
				    <div class="col-md-6">
						<div class="form-group">
						  <label for="name">Offer Title</label>
						  <input type="text" placeholder="Offer Title" id="name" name="name" class="form-control" value="<?php echo (isset($offer->name))?$offer->name:(isset($name)?$name:'');?>">
						  <?php echo form_error('name'); ?>
						  <?php $offerid = (isset($offer->id))?$offer->id:(isset($offerid)?$offerid:'');?>
						  <input type="hidden" id="offerid" name="offerid" value="<?php echo $offerid;?>">
						</div>
						<div class="form-group">
						  <label for="name">Description</label>
						  <textarea placeholder="Description" id="description" name="description" class="form-control" ><?php echo (isset($offer->description))?$offer->description:(isset($description)?$description:'');?></textarea>
						  <?php echo form_error('description'); ?>
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
	$("#addofferform_admin").validate({
		rules: {
			name: {
				required: true,
			},
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>