var BASEURL='';
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