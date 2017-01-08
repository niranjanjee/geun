<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Add Category</h3>
				</div>
            <!-- form start -->
				<?php
					$attributes = array('method' => 'post', 'name' => 'addcatform_admin', 'id' => 'addcatform_admin');
					echo form_open('admin/storesettings/addcategory', $attributes);
					?>
				  <div class="box-body">
				    <div class="col-md-6">
						<div class="form-group">
						  <label for="name">Category Name</label>
						  <input type="text" placeholder="Category Name" id="name" name="name" class="form-control" value="<?php echo (isset($category->name))?$category->name:(isset($name)?$name:'');?>">
						  <?php echo form_error('name'); ?>
						  <?php $catid = (isset($category->id))?$category->id:(isset($catid)?$catid:'');?>
						  <input type="hidden" id="catid" name="catid" value="<?php echo $catid;?>">
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
	$("#addcatform_admin").validate({
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