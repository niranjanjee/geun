<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Subcategories</h3>
			  <a href="/admin/storesettings/addshape" class="pull-right btn btn-success">Add Shape</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<?php
				$attributes = array('method' => 'get', 'name' => 'search_admin', 'id' => 'search_admin');
				echo form_open('admin/storesettings/shapes', $attributes);
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
				if($this->session->flashdata('saveshapes_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('saveshapes_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('saveshapes_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Name</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				if(count($shapes) > 0){
					foreach($shapes as $r)
					{
					?>
					<tr>
					  <td><?php echo $r->name;?></td>
					  <td>
					  <?php
					  if($r->status == 1)
					  {
						echo '<span class="label label-success">Active</span>';
					  }
					  else if($r->status == 0)
					  {
						echo '<span class="label label-danger">Inactive</span>';
					  }
					  ?>
					  </td>
					  <td class="table-action">
					  <a href="/admin/storesettings/addshape/<?php echo $r->id;?>" title="Edit Shape"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					  <a href="javascript:void(0);" title="Delete Shape" class="delete-action" rel="/admin/storesettings/deleteshape/<?php echo $r->id;?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
