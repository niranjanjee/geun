<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Offers</h3>
			  <a href="/admin/storesettings/addoffer" class="pull-right btn btn-success">Create Offer</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<?php
				$attributes = array('method' => 'get', 'name' => 'search_admin', 'id' => 'search_admin');
				echo form_open('admin/storesettings/specialoffers', $attributes);
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
				if($this->session->flashdata('saveoffer_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('saveoffer_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('saveoffer_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Name</th>
				  <th>Description</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				if(count($offers) > 0){
					foreach($offers as $c)
					{
					?>
					<tr>
					  <td><?php echo $c->name;?></td>
					  <td><?php echo $c->description;?></td>
					  <td>
					  <?php
					  if($c->status == 1)
					  {
						echo '<span class="label label-success">Active</span>';
					  }
					  else if($c->status == 0)
					  {
						echo '<span class="label label-danger">Inactive</span>';
					  }
					  ?>
					  </td>
					  <td class="table-action">
					  <a href="/admin/storesettings/addoffer/<?php echo $c->id;?>" title="Edit Offer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					  <a href="javascript:void(0);" title="Delete Offer" class="delete-action" rel="/admin/storesettings/deleteoffer/<?php echo $c->id;?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					</tr>
					<?php 
					}
				}else{
					echo '<tr><td colspan="3">No record found...</td></tr>';
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
