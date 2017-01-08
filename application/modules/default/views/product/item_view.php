<link rel="stylesheet" href="<?php echo base_url();?>/assets/front/light_box/src/light.css">
<link href="<?php echo base_url();?>/assets/front/light_box/src/jquery.littlelightbox.css" rel="stylesheet" type="text/css">
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9">
                <div class="product-view bounceInUp animated">
                    <div class="product-essential">
                        <div class="sl_top"><?php echo $product->title;?></div>
						<!-----------slider------------>
						<?php 
						$pimages = get_table_record("gem_product_gallery", 0, "name, ", array("product_id" => $product->id), "is_primary", "DESC");
						if(count($pimages) > 0){
						?>
						<div id="jssor_1" class="slide1 ">        
							<div data-u="slides" class="slide2">
							<?php 
								foreach($pimages as $p){?>
								<div data-p="112.50">
									<img data-u="image" src="<?php echo base_url();?>mthumb.php?src=/assets/front/stores/<?php echo $product->store_id;?>/<?php echo $product->id;?>/<?php echo $p->name;?>&w=800&h=391" />
									<div data-u="thumb">
										<img class="i" src="<?php echo base_url();?>mthumb.php?src=/assets/front/stores/<?php echo $product->store_id;?>/<?php echo $product->id;?>/<?php echo $p->name;?>&w=96&h=77" />
									</div>
								</div>
							<?php }?>	
							</div>
							<!-- Thumbnail Navigator -->
							<div data-u="thumbnavigator" class="jssort11 slide_thumb" data-autocenter="2">							   
								<div data-u="slides" style="cursor: default;">
									<div data-u="prototype" class="p">
										<div data-u="thumbnailtemplate" class="tp"></div>
									</div>
								</div>								
							</div>
							<!-- Arrow Navigator -->
							<span data-u="arrowleft" class="jssora02l slide_thumb2"  data-autocenter="2"></span>
							<span data-u="arrowright" class="jssora02r slide_thumb3"  data-autocenter="2"></span>
						</div>    
						<!-----------slider------------>
						<?php }?>
					</div>
	            </div>
          <p class="item_inf"> GEMSTONE SPECIFICATION</p>           
           <div class="col-sm-12">
           <table class="table table-bordered text3">
            <tbody>
            <tr>
               <td><strong>Gemstone:</strong></td>
                <td><?php echo $product->title." (".ucfirst($product->gemstone).")";?></td>
            </tr>
			<?php
			if($product->stone_ID != null)
			{
			?>
            <tr>
				<td><strong>Stone ID:</strong></td>
				<td><?php echo $product->stone_ID;?></td>
            </tr>
			<?php
			}
			?>
            <tr>
               <td><strong>Weight (carats)</strong></td>
               <td><?php echo $product->weight;?>  </td>
            </tr>
			<tr>
				<td><strong>Measurements</strong></td>
				<td><?php echo number_format($product->length, 2);?> x <?php echo number_format($product->width, 2);?> x <?php echo number_format($product->height, 2);?> mm</td>
			</tr>
			<?php 
			if($product->color != null)
			{
			$pcolors = explode("::", trim($product->color, "::"));
			?>
			<tr>
				<td><strong>Colors</strong></td>
				<td>
					<?php 
					foreach($pcolors as $k => $c){
						$color = get_table_record("gem_colors", $c, "color_image, ", array("status" => "1"), "name", "ASC");
						if(count($color) > 0){
					?>
				   <img alt="<?php echo $color->color_image;?>" src="/assets/front/img/colors/<?php echo $color->color_image;?>" />
				   <?php 
						}
				    } ?>
				</td>
            </tr>
			<?php
			} ?>
			<?php
			if($product->shape != null)
			{
			?>
			<tr>
				<td><strong>Shape</strong></td>
				<td><?php echo ucfirst($product->shape); ?></td>
			</tr>
			<?php } ?>
			<?php
			if($product->cutting != null)
			{
			?>
			<tr>
				<td><strong>Cutting</strong></td>
				<td><?php echo ucfirst($product->cutting); ?></td>
			</tr>
			<?php } ?>
			<?php
			if($product->clarity != null)
			{ ?>
		    <tr>
		        <td><strong>Clarity</strong></td>
		        <td><?php echo ucfirst($product->clarity); ?></td>
		    </tr>
			<?php
			} ?>
			<?php
			if($product->transparency != null)
			{
			?>
            <tr>
                <td><strong>Transparency</strong></td>
                <td><?php echo ucfirst($product->transparency); ?></td>
            </tr>
			<?php } ?>
			<?php
			if($product->geo_origin != null)
			{
			?>
            <tr>
                <td><strong>Geographical Origin</strong></td>
                <td><?php echo ucfirst($product->geo_origin); ?></td>
            </tr>
			<?php } ?>
			<?php
			if($product->treatment != null)
			{
			?>
		    <tr>
		        <td><strong>Treatment</strong></td>
		        <td><?php echo ucfirst($product->treatment); ?></td>
		    </tr>
			<?php
			} ?>
			
			<?php	
			if($product->certificate != null)
			{ ?>
            <tr>
                <td><strong>Certificate</strong></td>
                <td><?php echo ucfirst($product->certificate); ?></td>
            </tr>
			<?php } ?>			
			<?php
			if($product->offer_id != null)
			{ ?>
            <tr>
                <td><strong>Special Offer</strong></td>
                <td><?php echo ucfirst($product->offer); ?></td>
            </tr>
			<?php } ?>
			<?php
			if($product->country_name != null || $product->state_name != null || $product->city != null )
			{
			?>
			<tr>
                <td><strong>Stone Location</strong></td>
                <td><?php 
				$origin = $product->city.", ".$product->state_name.", ".$product->country_name;
				echo trim($origin, ",");?>
				</td>
            </tr>
			<?php
			} ?>
			<?php
			if($product->description != null){
			?>
			<tr>
                <td><strong>Description</strong></td>
                <td><?php echo $product->description; ?></td>
            </tr>
			<?php
			}
			?>
            </tbody>
        </table>
    </div>

           <!------ slider----->
            <div class="col-sm-12">
            <div class="slider-items-products">
              <div class="new_title center" style="margin-bottom:20px;">
                <h2>Store Gallery</h2>
              </div>
                   
                <div class="row">

                    <div class="col-lg-3">
                    <a class="lightbox thumbnail" href="<?php echo base_url();?>/assets/front/images/l1.jpg" data-littlelightbox-group="gallery" title="Company Photos ">
                    <img src="<?php echo base_url();?>/assets/front/images/l1.jpg" alt="Flying is life" />
                       <span class="pic_title"> Photos Title </span> 
                    </a>
                    </div>

                    <div class="col-lg-3">
                    <a class="lightbox thumbnail" href="<?php echo base_url();?>/assets/front/images/l2.jpg" data-littlelightbox-group="gallery" title="Company Photos ">
                    <img src="<?php echo base_url();?>/assets/front/images/l2.jpg" alt="Life is like climbing a mountain" />
                        <span class="pic_title"> Photos Title </span> 
                    </a>
                    </div>

	                    <div class="col-lg-3">					
                        <a class="lightbox thumbnail" href="<?php echo base_url();?>/assets/front/images/l3.jpg" data-littlelightbox-group="gallery" title="Company Photos ">
                        <img src="<?php echo base_url();?>/assets/front/images/l3.jpg" alt="Skiing, flying in white" />
                            <span class="pic_title"> Photos Title </span> 
                        </a>
                        </div>

                    <div class="col-lg-3">
                    <a class="lightbox thumbnail" href="<?php echo base_url();?>/assets/front/images/l4.jpg" data-littlelightbox-group="gallery" title="Company Photos ">
                    <img src="<?php echo base_url();?>/assets/front/images/l4.jpg" alt="Love nature as if love myself" />
                        <span class="pic_title"> Photos Title </span> 
                    </a>
                    </div>

                </div>
            </div>
          </div>
     </section>
        <!-------right menu----------->
    <aside class="col-right sidebar col-sm-3 ">
        <div class="block block-account">
       <div class="right-bar">
        <div class="gr1-1">
          <div class="input-group input-group-bid op-2"> <span class="input-group-addon">$</span>
            <input name="bid" class="form-control input-bid" value="<?php echo number_format(($product->gemstone_price * $product->weight), 2);?>" type="text">
            <span class="input-group-btn">
            <input name="button" value="Full Price" class="btn btn-bid btn-primary" type="submit">
            </span>
            <div> </div>
          </div>
          <div class="input-group input-group-bid"> <span class="input-group-addon">$</span>
            <input name="bid" class="form-control input-bid" value="<?php echo number_format($product->gemstone_price, 2);?>" type="text">
            <span class="input-group-btn">
            <input name="button" value="Price per" class="btn btn-bid btn-primary" type="submit">
            </span>
            <div> </div>
          </div>
          <br>
		  <?php 
		  if($product->is_negotiable == 1)
		  {
		  ?>
          <p class="heer"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp;Negotiable</a></p>
		  <?php 
		  }
		  else if($product->is_negotiable == 2)
		  {
		  ?>
		  <p class="heer"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp;Non Negotiable</a></p>
		  <?php
		  }?>
          <p class="heer"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp;Make On Offer</a></p>
          <p class="heer"> <a data-toggle="collapse" data-parent="#accordion" href="#"><span class="glyphicon glyphicon-heart"> </span>&nbsp;&nbsp;Add  to Watch List</a></p>
          <p class="heer"> <a data-toggle="collapse" data-parent="#accordion" href="#"><i class="fa fa-comments" aria-hidden="true"></i> &nbsp;&nbsp;Send an enquiry</a></p>
          <p>  &nbsp;&nbsp; &nbsp; Share: <img src="<?php echo base_url();?>/assets/front/images/fa.png"/> <img src="<?php echo base_url();?>/assets/front/images/tw.png"/> <img src="<?php echo base_url();?>/assets/front/images/pi.png"/>  <img src="<?php echo base_url();?>/assets/front/images/gp.png"/></p>
          <p align="center"> <strong>* All prices in USD</strong></p>
        </div>
        <br>

        <div class="gr1-3">
        <div class="you-like-1"><i class="fa fa-plane"></i> Pricing Details</div>
        <table class="table table-condensed">
          <tbody class="text3">
            
            <tr> 
              <td>Full Price</td>
              <td class="text-right">$<?php echo number_format(($product->gemstone_price * $product->weight), 2);?></td>
            </tr>
            <tr>
              <td>Viewed</td>
              <td class="text-right"><?php echo $product->total_viewed;?></td>
            </tr>
            <tr>
              <td>Posted Date</td>
              <td class="text-right"><?php echo date("dS M Y", strtotime($product->created_at));?></td>
            </tr>
            
          </tbody>
        </table>
        </div>
        <br>
        <div class="gr1-3">
        <div class="you-like-1"><i class="fa fa-plane"></i>  Shipping & Insurance </div>
        
        <table class="table table-condensed">
          <tbody class="text3">
            
           <tr>
              <td>Text</td>
              <td class="text-right">Text-1</td>
            </tr>
            <tr>
              <td>Text</td>
              <td class="text-right">Text-1</td>
            </tr> <tr>
              <td>Text</td>
              <td class="text-right">Text-1</td>
            </tr>
           
          </tbody>
        </table>       
		<?php
		if($product->payment_options != null)
		{
		?>
         <div class="you-like-1"> <i class="fa fa-usd"></i> Buying Options </div>        
        <table class="table table-condensed">
          <tbody class="text3">
		  <?php 
		  $payment_options = explode("::", trim($product->payment_options, "::"));
		  foreach($payment_options as $k => $p){
		  ?>
		  <tr><td> <a href="#"> <?php 
		  $payment_opt = get_table_record("gem_buying_options", $p, "name", array("status" => "1"), "name", "ASC");
		  echo $payment_opt->name;
		  ?> </a></td></tr>
		  <?php
		  }
		  ?>
          </tbody>
        </table>
		<?php }?>
        </div>
        <br>
        <div class="gr1-3">
        <div class="you-like-1"><i class="fa fa-plane"></i> About <?php echo $product->store_name;?></div>
               <p align="center" style="padding:10px;">
			   <?php 
			   if($product->logo != null)
			   {
			   ?>
			   <img class="img-responsive" src="<?php echo base_url();?>mthumb.php?src=/assets/front/stores/<?php echo $product->store_id;?>/<?php echo $product->logo;?>&w=200&h=150" />
			   <?php
			   }
			   else
			   {
			   ?>
			   <img class="img-responsive" src="<?php echo base_url();?>mthumb.php?src=/<?php echo $default_image;?>&w=200&h=150" />
			   <?php
			   }
			   ?>
			   </p>            
               <p><a href="#" class="list-group-item"><i class="fa fa-user"></i> Profile </a><a href="#" class="list-group-item"><i class="fa fa-star"></i> Ratting&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>   </a></p>
               <p class="heer-2"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp;<i class="fa fa-tags"></i> Visit <?php echo $product->store_name;?></a></p>
               
               <p class="heer-2"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp;<i class="fa fa-comment"></i> Contact <?php echo $product->store_name;?></a></p>
               <p class="heer-2"> <a data-toggle="collapse" data-parent="#accordion" href="#">&nbsp;&nbsp; <i class="fa fa-heart"></i> <span class="action">Add to Favourite saller list</span></a></p>
               
               <!--<ul style="padding:10px 10px 10px 10px;">
                  <li class="text-success">
                  <strong><i class="fa fa-check"></i> Saller Authencity</strong>
                  </li>
                  <li>
                  <i class="flag-icon flag-icon-it"></i>
                  Resitor user sence May 2013
                  </li>
                  <li>
                  <i class="flag-icon flag-icon-it"></i>
                  Exhbitor at hongkong gems and jewellery shop
                 </li>
               </ul>-->
               <br>
        </div>
      </div>
            </div>
        </aside>
      </div>
   </div>
  </div>
  <script src="<?php echo base_url();?>/assets/front/light_box/src/jquery.littlelightbox.js"></script>
  <script src="<?php echo base_url();?>/assets/front/slider/jssor.slider-21.1.6.mini.js" type="text/javascript"></script>
    <script type="text/javascript">
	$('.lightbox').littleLightBox();
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
                $AutoPlay: true,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Cols: 5,
                    $SpacingX: 5,
                    $SpacingY: 5,
                    $Orientation: 2,
                    $Align: 0
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 907);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);

        });
    </script>
	<?php set_total_viewed($product->id);?>