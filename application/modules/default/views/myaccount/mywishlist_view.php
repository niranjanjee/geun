<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.fileupload.css">
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/fileupload/jquery.fileupload.js"></script>
<section class="clearfix wishlist" id="myaccount-section">
	<div class="container">
	  <div class="row">
		<div class="col-xs-12 account-nav">
		  <?php $this->load->view('myaccount_nav_view');?>
		</div>
	  </div>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="inner-wrapper clearfix">
			<h3>Wishlist</h3>
			<?php if($this->session->flashdata('mywish_msg')){?>
			<p class="bg-success"><?php echo $this->session->flashdata('mywish_msg');?></p>
			<?php }
			else
			{
				echo "<p>&nbsp;</p>";
			}?>
			<div class="products-wrapper">
				<div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
							<th></th>	
							<th>Gemstone</th>
							<th>Price</th>
                            <th>Diemension</th>
                            <th>Gemstone Species</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
						if(count($wishlists) > 0){
							foreach($wishlists as $w)
							{?>
                        <tr>
							<td>
							<?php 
								if($w->file_name != null)
								{
							?>
								<img src="<?php echo base_url();?>assets/front/stores/<?php echo $w->store_id;?>/<?php echo $w->product_id;?>/<?php echo $w->file_name;?>" width="80" height="80"/>
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
                            <td><?php echo ucwords($w->product_name)?></td>
                            <td><?php echo '$ '.number_format($w->gemstone_price, 2)?></td>
                            <td><?php echo $w->length." &times; ".$w->width." &times; ".$w->height;?></td>
						    <td><?php echo ucwords($w->gemstone_species)?></td>
						    <td>
								<a href="#" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="javascript:void(0);" class="remove-wishlist" url="/default/myaccount/removewishlist/<?php echo $w->id;?>/<?php echo $w->product_id;?>" data-toggle="tooltip" data-placement="top" title="Remove From Wishlist"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
                        </tr>
						<?php
							}
						}
						else 
						{
							echo '<tr><td colspan="4">No gemstones in your wishlist.</td></tr>';
						}
						?>
                      </tbody>
                    </table>
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
	$(".remove-wishlist").click(function(){
		if(confirm("Do you want to remove from wishlist?"))
		{
			location.href = $(this).attr("url");
		}
	});
});
</script>
