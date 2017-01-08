<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Sale Stores</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<?php
				$attributes = array('method' => 'get', 'name' => 'searchuser_admin', 'id' => 'searchuser_admin');
				echo form_open('admin/users/index', $attributes);
				?>
				<div class="col-md-12 search-sec">
					<div class="form-group col-md-2">
					  <label for="name">Search</label>
					  <input type="text" placeholder="Keyword" id="search" name="search" class="form-control" value="<?php echo (isset($search)?$search:'');?>">
					</div>
					<div class="form-group col-md-2 no-padding">
					  <label for="name">Status</label>
					  <select id="filter_status" name="status" class="form-control">
						<option value="">Select Status</option>
						<option value="1" <?php echo (isset($status) && $status == "1"?'selected="selected"':'')?>>Active</option>
						<option value="0" <?php echo (isset($status) && $status == "0"?'selected="selected"':'')?>>Inactive</option>
					  </select>
					</div>
					<div class="form-group col-md-1 ">
					  <button class="btn btn-primary sbtn-marg-top" type="submit">Search</button>
					</div>
				</div>
				<?php echo form_close();?>
				<?php
				if($this->session->flashdata('saveadminsale_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('saveadminsale_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('saveadminsale_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Name</th>
                  <th>Owner</th>
                  <th>Owner's Email</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				if(count($salestores) > 0){
					foreach($salestores as $s)
					{
					?>
					<tr>
					  <td><?php echo $s->name;?></td>
					  <td><?php echo ucwords($s->uname);?></td>
					  <td><?php echo $s->email;?></td>
					  <td>
					  <?php
					  if($s->status == 1)
					  {
						echo '<span class="label label-success">Active</span>';
					  }
					  else if($s->status == 0)
					  {
						echo '<span class="label label-danger">Inactive</span>';
					  }
					  ?>
					  </td>
					  <td class="table-action">
					  <a href="/admin/salestores/edit/<?php echo $s->id;?>" class="edit-action" data-toggle="tooltip" data-placement="top" title="Edit">
						<i class="fa fa-edit" aria-hidden="true"></i>
					  </a>
					   <a href="/admin/salestores/viewproduct/<?php echo $s->id;?>" class="view-action" data-toggle="tooltip" data-placement="top" title="View Products">
						<i class="fa fa-product-hunt" aria-hidden="true"></i>
						</a>
					  <a href="javascript:void(0);" class="delete-action" rel="/admin/salestores/delsalestore/<?php echo $s->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  </td>
					</tr>
					<?php 
					}
				}	
				?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
			<div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php echo $pagination;?>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
</section>
<script>
$(document).ready(function(){
	
});
</script>