<script>
   function doSearch()
   {
      $.ajax({
         type: "POST",
         url:"/searchdata/" + $("#mysearch").val(),
         success:function(result){
         $("#searchresults").html(result);
      }});
   }
</script>

<section class="main-container col2-left-layout">
<input type="text" id="mysearch" style="margin-left:100px; width:270px;" onkeyup="doSearch();">
    <div class="main container">
        <div class="row">
            <aside class="col-left sidebar col-sm-3 col-xs-12">
          		
            
                <div class="side-nav-categories" style="margin-top:20px;">
                    <div class="block-title"> GEMSTONE CATEGERIES</div>
                    <div class="box-content box-category">
                        <ul>
                            <?php
                            foreach ($gems_categories as $cat)
							{
                            ?>
                            <li> <a href="#"><?php echo $cat['name'] ; ?></a> <span class="subDropdown plus"></span>
                          
						
                                <ul class="level0_455">
                                  <?php
                                  	if(isset($cat['name1']))
							{
							?>  <li> <a href="#"> <?php echo $cat['name1']; ?> </a> </li>  <?php
							}
							?>
                                </ul>
                          
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <!--box-content box-category--> 
                </div>
                <div class="block block-banner"><a href="#"><img src="<?php echo base_url(); ?>/assets/front/img/block-banner.png" alt="block-banner"></a></div>
            </aside>
            <section class="col-main col-sm-9 ">
                <div class="category-title">
                    <h1>VARIUS GEMSTONE</h1>
                </div>          
                <div class="category-products"> 
                    <ul class="products-grid">
                        <?php
                            foreach ($gemstones as $g) {
                        ?> 
                            <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="col-item">
                                    <!--<div class="sale-label sale-top-right">Sale</div>-->
                                    <div class="images-container"> <a class="product-image" href="<?php echo base_url(); ?>gemstone/item/<?php echo $g->id; ?>"> 
                                            <?php
                                            if ($g->image != null) {
                                                ?>
                                                <img alt="<?php echo $g->image; ?>" src="<?php echo base_url(); ?>mthumb.php?src=/assets/front/stores/<?php echo $g->store_id; ?>/<?php echo $g->id; ?>/<?php echo $g->image; ?>&w=260&h=208" class="img-responsive">
                                                <?php
                                            } else {
                                                ?>
                                                <img alt="default-gem-imgae" src="<?php echo base_url(); ?>mthumb.php?src=/<?php echo $default_image; ?>&w=260&h=208" class="img-responsive">
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
                                                <a href="<?php echo base_url(); ?>gemstone/item/<?php echo $g->id; ?>" title="<?php echo strtoupper($g->title); ?>"><?php echo strtoupper(substr($g->title, 0, 30)) . "..."; ?></a> 
                                                <span class="text1"><?php echo ucfirst($g->cat_name); ?></span> 
                                            </div>                       
                                            <!--item-title-->
                                            <div class="item-content">                       
                                                <div class="price-box" style="margin-right:20px;">
                                                    <p class="special-price"> <span class="price"> $<?php echo number_format($g->gemstone_price, 2); ?> </span> </p>
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
                    <!------pagitation--------->
                    <div class="toolbar">
                        <div class="pages" style="float:right;">
                            <label>Page:</label>
                            <ul class="pagination">
                                <li><a href="#">&laquo;</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>

                    </div>
                    <!------end pagitation--------->

                </div>
            </section>


        </div>
    </div>
    <div class="brand-logo ">
        <div class="container">
            <div class="slider-items-products">
                <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col6"> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo1.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo2.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo3.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo4.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo5.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo6.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo7.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                        <!-- Item -->
                        <div class="item"> <a href="#x"><img src="<?php echo base_url(); ?>assets/front/img/b-logo8.png" alt="Image"></a> </div>
                        <!-- End Item --> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Two columns content -->