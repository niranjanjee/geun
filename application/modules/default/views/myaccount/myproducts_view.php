<section class="clearfix userdashboard" id="myaccount-section">
	<div class="container">
	  <div class="row">
		<div class="col-xs-12 account-nav">
		  <?php $this->load->view('myaccount_nav_view');?>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-12 col-xs-12">
		  <div class="inner-wrapper clearfix">
			<h3>My Product</h3>
			<?php if($this->session->flashdata('myproduct_msg')){?>
			<div class="col-md-12 col-xs-12"><p class="bg-success"><?php echo $this->session->flashdata('myproduct_msg');?></p></div>
			<?php }
			else
			{
				echo "<p>&nbsp;</p>";
			}?>
			<div class="col-md-12 col-xs-12">
				<div class="col-md-12 col-xs-12">
					<a href="<?php echo base_url()?>default/myaccount/addproduct/<?php echo $sid;?>" class="btn btn-green pull-right">Add Product</a>
				</div>
			</div>
			
			<div class="products-wrapper col-md-12 col-xs-12">
				<div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
							<th></th>
							<th>Title</th>
                            <th>Gemstone</th>
                            <th>Carat Weight</th>
                            <th>Gemstone Species</th>
							<th>Measurements</th>
							<th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
						if(count($products) > 0)
						{
							foreach($products as $p)
							{
					  ?>
                        <tr>
							<td>
							<?php 
								if($p->file_name != null)
								{
							?>
								<img src="<?php echo base_url();?>assets/front/stores/<?php echo $p->store_id;?>/<?php echo $p->id;?>/<?php echo $p->file_name;?>" width="80" height="80"/>
							<?php	
								}
								else
								{
							?>	
								<img src="<?php echo base_url().$default_image?>" width="80" height="80"/>
							<?php	
								}
							?>
							</td>	
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
                          <td>
						  <a href="/default/myaccount/addproduct/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						  <a href="/default/myaccount/productimages/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Add Image"><i class="fa fa-camera" aria-hidden="true"></i></a>
						  <?php 
						  if($p->status == 1)
						  {
						  ?>
						  <a href="javascript:void(0);" relst="<?php echo $p->status?>" url="/default/myaccount/productchstatus/<?php echo $p->status?>/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Do Inactive" class="status-action"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
						   <?php	
						  }
						  else
						  {
						  ?>
						  <a href="javascript:void(0);" relst="<?php echo $p->status?>" url="/default/myaccount/productchstatus/<?php echo $p->status?>/<?php echo $p->store_id?>/<?php echo $p->id?>" data-toggle="tooltip" data-placement="top" title="Do Active" class="status-action"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
						  <?php
						  }
						  ?>
						  </td>
                        </tr>
						<?php
							}
						}
						else
						{
						?>
                        <tr>
                          <td colspan="7">You have no products.</td>
                        </tr>
						<?php
						}
						?>
                      </tbody>
                    </table>
					<div class="box-footer clearfix">
					  <ul class="pagination pagination-sm no-margin pull-right">
						<?php echo $pagination;?>
					  </ul>
					</div>
                </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();  
	$(".status-action").click(function(){
		var msg = "Do you want to do inactive this product?";
		if($(this).attr("relst") == 0)
		{
			msg = "Do you want to do active this product?"
		}
		if(confirm(msg))
		{
			location.href = $(this).attr("url");
		}
	});
});
</script>