<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Add Certificate</h3>
				</div>
            <!-- form start -->
				<?php
					$attributes = array('method' => 'post', 'name' => 'addcertificateform_admin', 'id' => 'addcertificateform_admin');
					echo form_open('admin/storesettings/addcertificate', $attributes);
					?>
				  <div class="box-body">
				    <div class="col-md-6">
						<div class="form-group">
						  <label for="name">Certificate Name</label>
						  <input type="text" placeholder="Certificate Name" id="name" name="name" class="form-control" value="<?php echo (isset($certificate->name))?$certificate->name:(isset($name)?$name:'');?>">
						  <?php echo form_error('name'); ?>
						  <?php $certificateid = (isset($certificate->id))?$certificate->id:(isset($certificateid)?$certificateid:'');?>
						  <input type="hidden" id="certificateid" name="certificateid" value="<?php echo $certificateid;?>">
						</div>
						<div class="form-group">
						  <label for="name">Description</label>
						  <textarea placeholder="Description" id="description" name="description" class="form-control" ><?php echo (isset($certificate->description))?$certificate->description:(isset($description)?$description:'');?></textarea>
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
	$("#addcertificateform_admin").validate({
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