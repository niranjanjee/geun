        <script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.mockjax.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/gemstone.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/auto-styles.css" type="text/css">
        <script type="text/javascript">
       var BASEURL='<?php echo base_url();?>';
        $(this).ready( function()
        {
            var countriesArray = $.map(countries, function (value, key) { return { value: value, data: key }; });

        // Initialize ajax autocomplete:
        $('#autocomplete-ajax').autocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                //window.location.href = BASEURL+'category/'+suggestion.data; 
                if(suggestion.data!=''){
                   productList(suggestion.data)
               }
                //$('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            //$('#itemId').val(suggestion.data);
        },
        onHint: function (hint) {
            //alert(hint);
            $('#itemId').val(hint);
        },
        onInvalidateSelection: function() {
            $('#selction-ajax').html('You selected: none');
        }
    });
        });
        </script>
<section class="main-container col2-left-layout">
<div id="suggesstion-box"></div>
    <div class="main container">
        <div class="row">
            <aside class="col-left sidebar col-sm-3 col-xs-12">
          		
            
                <div class="side-nav-categories" style="margin-top:20px;">
                    <div class="block-title"> GEMSTONE CATEGERIES</div>
                    <div class="box-content box-category">
                        <ul>
                              <div class="search_herd">
      
               
                  
<!--                    <input type="text" name="printable_name" id="id" autocomplete="off" role="textbox" aria-autocomplete="list" style="height:30px;">-->
                    <div style="position: relative;">
                        <input type="text" name="itemName" class="form-control" id="autocomplete-ajax" style="position: absolute; z-index: 2; background: transparent;" value=""/>
                    </div>
                                  <div class="clearfix">&nbsp;</div>
                                  <div class="clearfix">&nbsp;</div>
                              </div>
                            <?php
                            foreach ($gems_categories as $cat)
							{
                            ?>
                            <li> <a class="getproduct cp" href="#" data-id="<?php echo $cat['id'];?>"><?php echo $cat['name'] ; ?></a> <?php if($cat['name1']<>''){?><span class="subDropdown plus"></span><?php } ?>
                          
						
                                <ul class="level0_455">
                                  <?php
                                  	if(isset($cat['name1']))
							{
                                            ?>  <li> <a href="#" class="getsubproduct" data-id="<?php echo $cat['name1']?>"> <?php echo $cat['name1']; ?> </a> </li>  <?php
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
            
            </aside>
            <section class="col-main col-sm-9 ">
                <div class="category-title">
                    <h1><?php if($getcatName==''){?><?php }else{echo $getcatName;} ?></h1>
                </div>          
                <div class="category-products"> 
                    <ul class="products-grid product">
                        <?php
                        if(count($gemstones)>0){
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
                        }}else{
                        
                        ?>
                            <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="col-item">
                            <span class="text-center text-danger">No record found</span>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                    <?php if(count($gemstones)>0){?>
                    <!------pagitation--------->
<!--                    <div class="toolbar">
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

                    </div>-->
                    <!------end pagitation--------->
                    <?php }?>
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
        
        <script type="text/javascript">
            //url: "<?php //echo base_url(); ?>" + "index.php/ajax_post_controller/user_data_submit",
            
            $(".getproduct").click(function(){
               var cid=$(this).attr("data-id");
               //alert(cid);
               if(cid!=''){
                   productList(cid)
               }
            });
            
            $(".getsubproduct").click(function(){
               var cname=$(this).attr("data-id");
               //alert(cid);
               if(cname!=''){
                   $.ajax({
                    type:"POST",
                    url:'/default/home/GetProductByAjaxSubCid',
                    data:"cn="+cname,
                    dataType:'json',
                    success:function(obj){
                        var html_str='';
                        //alert(obj.result);
                        if(obj.result == 'S'){
                           $.each( obj.data, function( key, value ) {
                            html_str+='<li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">';
                                html_str+='<div class="col-item">';
                                    html_str+='<div class="images-container">';
                                              html_str+="<a class=\"product-image\" href=\""+BASEURL+"gemstone/item/"+value.id+"\">";
                                               html_str+='<a class="product-image" href="'+BASEURL+'gemstone/item/'+value.id+'"></a>';
                                            if(value.image != '') {
                                                html_str+='<img alt"'+value.image+'" src="'+BASEURL+'mthumb.php?src=/assets/front/stores/'+value.store_id+'/'+value.id+'/'+value.image+'&w=260&h=208" class="img-responsive">';
                                            } else {
                                                html_str+='<img alt="default-gem-imgae" src="'+BASEURL+'mthumb.php?src=/&w=260&h=208" class="img-responsive">';
                                            }
                                        html_str+='</a>';
                                        html_str+='<div class="actions">';
                                            html_str+='<div class="actions-inner">';
                                                html_str+='<button type="button" title="Add to Wishlist" class="button btn-cart"> <i class="fa fa-eye" aria-hidden="true"></i> </button>';
                                                html_str+='<ul class="add-to-links">';
                                                    html_str+='<li><a href="wishlist.html" title="Make an Offe" class="link-wishlist"> <i class="fa fa-random"></i></a></li>';
                                                    html_str+='<li><a href="compare.html" title="Like a Product"  class="link-compare"> <i class="fa fa-thumbs-o-up" ></i> </a></li>';
                                                html_str+='</ul>';
                                            html_str+='</div>';
                                        html_str+='</div>';
                                    html_str+='</div>';
                                    html_str+='<div class="info">';
                                        html_str+='<div class="info-inner">';
                                            html_str+='<div class="item-title">'; 
                                                html_str+='<a href="'+BASEURL+'gemstone/item/'+value.id+'" title="'+value.title+'">'+value.title+'</a>';
                                                html_str+='<span class="text1">'+value.cat_name+'</span>';
                                            html_str+='</div>';                       
                                            
                                            html_str+='<div class="item-content">';                       
                                                html_str+='<div class="price-box" style="margin-right:20px;">';
                                                    html_str+='<p class="special-price"> <span class="price"> $'+value.gemstone_price+' </span> </p>';
                                                    
                                                html_str+='</div>';
                                            html_str+='</div>';
                                           
                                        html_str+='</div>';
            
                                        html_str+='<div class="clearfix"> </div>';
                                    html_str+='</div>';
                                html_str+='</div>';
                            html_str+='</li>';
                        
                       
                        
                        });
                         $(".product").html(html_str);
                        }else{
                            $(".product").html('<li class="text-center">No Record Found.</li>');
                        }

                    }

                 });
               }
            });
            //
            
            function productList(cid){
                $.ajax({
                    type:"POST",
                    url:'/default/home/GetProductByAjaxCid',
                    data:"cn="+cid,
                    dataType:'json',
                    success:function(obj){
                        var html_str='';
                        //alert(obj.result);
                        if(obj.result == 'S'){
                           $.each( obj.data, function( key, value ) {
                            html_str+='<li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">';
                                html_str+='<div class="col-item">';
                                    html_str+='<div class="images-container">';
                                              html_str+="<a class=\"product-image\" href=\""+BASEURL+"gemstone/item/"+value.id+"\">";
                                               html_str+='<a class="product-image" href="'+BASEURL+'gemstone/item/'+value.id+'"></a>';
                                            if(value.image != '') {
                                                html_str+='<img alt"'+value.image+'" src="'+BASEURL+'mthumb.php?src=/assets/front/stores/'+value.store_id+'/'+value.id+'/'+value.image+'&w=260&h=208" class="img-responsive">';
                                            } else {
                                                html_str+='<img alt="default-gem-imgae" src="'+BASEURL+'mthumb.php?src=/&w=260&h=208" class="img-responsive">';
                                            }
                                        html_str+='</a>';
                                        html_str+='<div class="actions">';
                                            html_str+='<div class="actions-inner">';
                                                html_str+='<button type="button" title="Add to Wishlist" class="button btn-cart"> <i class="fa fa-eye" aria-hidden="true"></i> </button>';
                                                html_str+='<ul class="add-to-links">';
                                                    html_str+='<li><a href="wishlist.html" title="Make an Offe" class="link-wishlist"> <i class="fa fa-random"></i></a></li>';
                                                    html_str+='<li><a href="compare.html" title="Like a Product"  class="link-compare"> <i class="fa fa-thumbs-o-up" ></i> </a></li>';
                                                html_str+='</ul>';
                                            html_str+='</div>';
                                        html_str+='</div>';
                                    html_str+='</div>';
                                    html_str+='<div class="info">';
                                        html_str+='<div class="info-inner">';
                                            html_str+='<div class="item-title">'; 
                                                html_str+='<a href="'+BASEURL+'gemstone/item/'+value.id+'" title="'+value.title+'">'+value.title+'</a>';
                                                html_str+='<span class="text1">'+value.cat_name+'</span>';
                                            html_str+='</div>';                       
                                            
                                            html_str+='<div class="item-content">';                       
                                                html_str+='<div class="price-box" style="margin-right:20px;">';
                                                    html_str+='<p class="special-price"> <span class="price"> $'+value.gemstone_price+' </span> </p>';
                                                    
                                                html_str+='</div>';
                                            html_str+='</div>';
                                           
                                        html_str+='</div>';
            
                                        html_str+='<div class="clearfix"> </div>';
                                    html_str+='</div>';
                                html_str+='</div>';
                            html_str+='</li>';
                        
                       
                        
                        });
                         $(".product").html(html_str);
                        }else{
                            $(".product").html('<li class="text-center">No Record Found.</li>');
                        }

                    }

                 });
            }
        </script>
<!-- End Two columns content -->