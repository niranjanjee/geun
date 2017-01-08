<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; User List</h3>
			  <a href="/admin/adminusers/adduser" class="pull-right btn btn-success">Add User</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<!--<div class="col-md-12 search-sec">
					<div class="form-group col-md-2">
					  <label for="name">Full Name</label>
					  <input type="text" placeholder="Full Name" id="name" name="name" class="form-control">
					</div>
					<div class="form-group col-md-2 no-padding">
					  <label for="name">Full Name</label>
					  <input type="text" placeholder="Full Name" id="name" name="name" class="form-control">
					</div>
					<div class="form-group col-md-1 ">
					  <button class="btn btn-primary sbtn-marg-top" type="submit">Search</button>
					</div>
				</div>-->
				<?php
				if($this->session->flashdata('saveadminuser_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('saveadminuser_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('saveadminuser_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Contact No.</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				foreach($admin_users as $u)
				{
				?>
                <tr>
                  <td><?php echo $u->name;?></td>
                  <td><?php echo $u->username;?></td>
                  <td><?php echo $u->email;?></td>
				  <td><?php echo $u->contact;?></td>
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
                  <td>
				  <a href="/admin/adminusers/adduser/<?php echo $u->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				  <a href="javascript:void(0);" class="delete-action" rel="/admin/adminusers/deleteuser/<?php echo $u->id;?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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