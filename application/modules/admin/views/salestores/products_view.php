<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
	<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->template->section;?> &raquo; Sale Stores(<?php echo ucwords($store_name->name);?>) &raquo; Products</h3>
			  <a href="/admin/salestores" class="pull-right btn btn-success">Back</a>
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
				if($this->session->flashdata('saveadminproduct_msg')){
					echo '<div class="col-md-12 alert '.$this->session->flashdata('saveadminproduct_class').' fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>'.$this->session->flashdata('saveadminproduct_msg').'</div>';
				}
				?>
              <table class="table table-hover">
                <tbody><tr>
                  <th>Title</th>
                  <th>Gemstone</th>
                  <th>Carat Weight</th>
				  <th>Gemstone Species</th>
				  <th>Measurements</th>
				  <th>Status</th>
				  <th>Action</th>
                </tr>
				<?php 
				if(count($products) > 0){
					foreach($products as $p)
					{
					?>
					<tr>
					  <td><?php echo $p->title;?></td>
					  <td><?php echo ucwords($p->gemstone);?></td>
					  <td><?php echo $p->weight." Caret";?></td>
					  <td><?php echo ucwords($p->gemstone_species);?></td>
					  <td><?php echo $p->length." &times; ".$p->width." &times; ".$p->height;?></td>
					  <td>
					  <?php 
						  if($p->status == 1)
						  {
						  ?>
							<span class="label label-success">Active</span>
						  <?php	
						  }
						  else
						  {
						  ?>
						  <span class="label label-danger">Inactive</span>
						  <?php
						  }
						  ?>
					  </td>
					  <td class="table-action">
							<a href="/admin/salestores/productedit/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						    <a href="/admin/salestores/productimages/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Add Image"><i class="fa fa-camera" aria-hidden="true"></i></a>
						  <a href="javascript:void(0);" class="delete-action" rel="/admin/salestores/delproduct/<?php echo $p->store_id;?>/<?php echo $p->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  </td>
					</tr>
					<?php 
					}
				}else{
					echo '<tr><td colspan="7">No product found...</td></tr>';
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