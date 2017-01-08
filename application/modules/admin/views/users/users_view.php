<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; User List</h3>
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
				if($this->session->flashdata('user_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('user_msg_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('user_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Full Name</th>
                  <th>Contact No.</th>
				  <th>Skype ID</th>
                  <th>Email</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				foreach($users as $u)
				{
				?>
                <tr>
                  <td><?php echo $u->name;?></td>
                  <td><?php echo $u->contact_no;?></td>
				  <td><?php echo $u->skypeid;?></td>
                  <td><?php echo $u->email;?></td>
                  <td>
				  <?php
				  if($u->status == 1)
				  {
					echo '<span class="label label-success">Active</span>';
				  }
				  else if($u->status == 0)
				  {
					echo '<span class="label label-danger">Inactive</span>';
				  }
				  ?>
				  </td>
                  <td class="table-action">
				  <?php
				  if($u->status == 1)
				  {
				  ?>
					<a href="javascript:void(0);" class="change-status" rel="/admin/users/changestatus/<?php echo $u->id;?>/1"><i class="fa fa-level-down" aria-hidden="true"></i></a>
				  <?php	
				  }
				  else if($u->status == 0)
				  {
				  ?>
					<a href="javascript:void(0);" class="change-status" rel="/admin/users/changestatus/<?php echo $u->id;?>/0"><i class="fa fa-level-up" aria-hidden="true"></i></a>
				  <?php
				  }
				  ?>
				  
				  <a href="javascript:void(0);" class="delete-action" rel="/admin/users/deleteuser/<?php echo $u->id;?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                </tr>
				<?php 
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