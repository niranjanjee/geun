<style>
#auctions-sidebar .radio, .checkbox{width:100%;}
</style>
<section class="main-container col2-left-layout">
    <div class="main container">
      <div class="row">
      <!-------------left menu------------>
       <aside class="col-left sidebar col-sm-3 " id="search-filter">
          <div class="side-nav-categories search-filter">
            <div class="block-title"> Search Options</div>
            <!--block-title--> 
            
            
            
             <div class="panel ">
    
       <div id="auctions-sidebar">
            <div class="list-group sidebar-list ">
                <a href="#" class="list-group-item ">                    
                  <span class="badge">96</span>
                  <b> All Alexandrite  </b>          
                </a>
                
               <a href="#" class="list-group-item ">                    
                  <span class="badge">4</span>
                  <b>  Alexandrite Cabochons  </b>          
                </a>

                <a href="#" class="list-group-item ">                    
                  <span class="badge">1</span>
                  <b> Alexandrite Parcels    </b>          
                </a>

                <a href="#" class="list-group-item ">                    
                  <span class="badge">82</span>
                  <b> Alexandrite Rough   </b>          
                </a>

                <a href="#" class="list-group-item ">                    
                  <span class="badge">1</span>
                  <b>  Alexandrite Specimens   </b>          
                </a>

                 
            </div>
        

        <div class="panel-body">
            <?php
			$attributes = array('method' => 'get', 'name' => 'searchfilterform', 'id' => 'searchfilterform', 'role' => 'form');
			echo form_open('/search', $attributes);
			?>    
            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search title or category" value="<?php echo (isset($searchdata['keyword'])?html_escape($searchdata['keyword']):'')?>">
            </div>
            <div class="form-group">
                <label for="start_bid_min">Price (USD)</label>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" name="start_bid_min" id="start_bid_min" placeholder="min" value="">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" name="start_bid_max" id="start_bid_max" placeholder="max" value="">
                        </div>
                    </div>
                </div>
            </div>

           

            <div class="form-group">
                <label for="more">Auction Type</label>

                       <div class="checkbox">
                            <label for="certified_gemstones">
                                <input type="checkbox" name="certified_gemstones" id="certified_gemstones" value="1">
                                Certified Gemstones                            

                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="beryllium_treated">
                                <input type="checkbox" name="beryllium_treated" id="beryllium_treated" value="1">
                                Beryllium Treated 

                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="filled_cavities_or_fissurecobalts">
                                <input type="checkbox" name="filled_cavities_or_fissurecobalts" id="filled_cavities_or_fissurecobalts" value="1">
                                Filled Cavities or Fissure/Cobalts                            

                            </label>
                        </div>
                            <div class="checkbox">
                            <label for="heat_treatment">
                                <input type="checkbox" name="heat_treatment" id="heat_treatment" value="1">
                                Heat Treatment                            

                            </label>
                        </div>
                           <div class="checkbox">
                            <label for="no_treatment">
                                <input type="checkbox" name="no_treatment" id="Checkbox15" value="1">
                                No Treatment 

                            </label>
                        </div>
                           <div class="checkbox">
                            <label for="surface_diffusion">
                                <input type="checkbox" name="surface_diffusion" id="surface_diffusion" value="1">
                                Surface Diffusion

                            </label>
                        </div>
                    
                <div class="checkbox">
                    <label for="free_shipping">
                        <input type="checkbox" name="free_shipping" id="free_shipping" value="1">
                        Free Shipping  

                    </label>
                </div>

                <div class="checkbox">
                    <label for="buy_now">
                        <input type="checkbox" name="buy_now" id="buy_now" value="1">
                        Buy it Now  

                    </label>
                </div>

                <div class="checkbox">
                    <label for="make_an_offer">
                        <input type="checkbox" name="make_an_offer" id="make_an_offer" value="1">
                        Make an Offer                    </label>
                </div>

                <div class="checkbox">
                    <label for="no_reserve">
                        <input type="checkbox" name="no_reserve" id="no_reserve" value="1">
                        No Reserve  

                    </label>
                </div>

                <div class="checkbox">
                    <label for="has_video">
                        <input type="checkbox" name="has_video" id="has_video" value="1">
                        Items with videos  

                    </label>
                </div>

                <div class="checkbox">
                    <label for="closed">
                        <input type="checkbox" name="closed" id="closed" value="1">
                        Closed items 

                    </label>
                </div>
            </div>

            <div class="form-group">
                
                <label for="dimensions">Dimensions (mm)</label>

                <div class="form-group">
                    <label for="width">
                        <small>Length</small>
                    </label>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="length_min" id="length_min" placeholder="min" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="length_max" id="length_max" placeholder="max" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="width">
                        <small>Width</small>
                    </label>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="width_min" id="width_min" placeholder="min" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="width_max" id="width_max" placeholder="max" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="width">
                        <small>Depth</small>
                    </label>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="depth_min" id="depth_min" placeholder="min" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="depth_max" id="depth_max" placeholder="max" value="">
                                <span class="input-group-addon">mm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="weight">Weight (carats)</label>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="weight_min" id="weight_min" placeholder="min" value="">
                            <span class="input-group-addon">cts</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="weight_max" id="weight_max" placeholder="max" value="">
                            <span class="input-group-addon">cts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
				<label for="more">Favourites</label>
				<div class="checkbox">
					<label for="favourite_sellers">
						<input type="checkbox" name="favourite_sellers" id="favourite_sellers" value="1" disabled="">
						Only favourite sellers 

					</label>
				</div>
			</div>            
            <input type="hidden" name="order" value="">
            <input type="hidden" name="view" value="">
            <input type="submit" class="btn btn-primary" value="Show Items">
            or <a href="#">start over</a>
           <?php echo form_close();?>
        </div>
    </div>
</div>

<!--block-title--> 

          </div>
          
      </aside>

<!-------------end left menu------------>
        <section class="col-main col-sm-9 ">
          <div class="category-title">
            <h1>VARIUS GEMSTONE</h1>
          </div>
          <div class="category-products">
            <ul class="products-grid">
              <?php
				foreach($gemstones as $g)
				{
			?> 
              <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <div class="col-item">
                  <!--<div class="sale-label sale-top-right">Sale</div>-->
                 <div class="images-container"> <a class="product-image" href="<?php echo base_url();?>gemstone/item/<?php echo $g->id;?>"> 
				 <?php
					if($g->image != null)
					{
					?>
					<img alt="<?php echo $g->image;?>" src="<?php echo base_url();?>mthumb.php?src=/assets/front/stores/<?php echo $g->store_id;?>/<?php echo $g->id;?>/<?php echo $g->image;?>&w=260&h=208" class="img-responsive">
					<?php
					}
					else
					{
					?>
					<img alt="default-gem-imgae" src="<?php echo base_url();?>mthumb.php?src=/<?php echo $default_image;?>&w=260&h=208" class="img-responsive">
					<?php
					}
					?>
				 </a>
                    <div class="actions">
                      <div class="actions-inner">
                        <button type="button" title="Add to Wishlist" class="button btn-cart"> <i class="fa fa-eye" aria-hidden="true"></i> </button>
                        <ul class="add-to-links">
                          <li><a href="wishlist.html" title="Make an Offe" class="link-wishlist"> <i class="fa fa-random"></i></a></li>
                          <li><a href="compare.html" title="Like a Product"  class="link-compare"> <i class="fa fa-thumbs-o-up" ></i> </a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="info">
                    <div class="info-inner">
                      <div class="item-title"> 
                          <a href="<?php echo base_url();?>gemstone/item/<?php echo $g->id;?>" title="<?php echo strtoupper($g->title);?>"><?php echo strtoupper(substr($g->title, 0, 30))."...";?></a> 
                          <span class="text1"><?php echo ucfirst($g->cat_name);?></span> 
                      </div>                       
                      <!--item-title-->
                      <div class="item-content">                       
                        <div class="price-box" style="margin-right:20px;">
                          <p class="special-price"> <span class="price"> $<?php echo number_format($g->gemstone_price, 2);?> </span> </p>
                          <!--<p class="old-price"> <span class="price-sep">-</span> <span class="price"> $50.00 </span> </p>-->
                        </div>
                      </div>
                      <!--item-content--> 
                    </div>
                    <!--info-inner-->  
                    <div class="clearfix"> </div>
                  </div>
                </div>
              </li>
			  <?php
			  }
			  ?>
            </ul>
          </div>
        </section>
      </div>
    </div>
  </section>
  <script>
  $(document).ready(function(){
  var total_gemstone = "<?php echo count($gemstones);?>";
  if(total_gemstone > 9){
		$(window).scroll(function (event) {	
		var scroll = $(window).scrollTop();
			//console.log(scroll);
			if(scroll > 600)
			{//Height from top (note: It can be changed as your requirement)
				var offset = $(".footer").offset();
				if((offset.top - scroll) < 655)
				{
					var top = offset.top - ($("#search-filter").height() + 93 );
					$("#search-filter").css("top",top+"px");
					$("#search-filter .search-filter").css({"width": "100%", "position": "static"})				
				}
				else
				{
					$("#search-filter").css("top","-800px")
					$("#search-filter .search-filter").css({"position": "fixed", "width": "19.5%"});
				}
			}
			else
			{
				$("#search-filter").css("top","0px");
				$("#search-filter .search-filter").css({"position": "static", "width": "auto"});
			}
		});
	}
  });
	</script>