<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Add Shape</h3>
				</div>
            <!-- form start -->
				<?php
					$attributes = array('method' => 'post', 'name' => 'addshapeform_admin', 'id' => 'addshapeform_admin');
					echo form_open('admin/storesettings/addshape', $attributes);
					?>
				  <div class="box-body">
				    <div class="col-md-6">
						<div class="form-group">
						  <label for="name">Shape</label>
						  <input type="text" placeholder="Shape" id="name" name="name" class="form-control" value="<?php echo (isset($shape->name))?$shape->name:(isset($name)?$name:'');?>">
						  <?php echo form_error('name'); ?>
						  <?php $shapeid = (isset($shape->id))?$shape->id:(isset($shapeid)?$shapeid:'');?>
						  <input type="hidden" id="shapeid" name="shapeid" value="<?php echo $shapeid;?>">
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
	$("#addshapeform_admin").validate({
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