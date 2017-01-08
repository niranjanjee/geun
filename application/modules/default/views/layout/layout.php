<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Gemstone</title>
<!-- Favicons Icon -->
<link rel="icon" href="images/flag.png" type="image/x-icon" />

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/css/bootstrap.min1.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/font-awesome.css" type="text/css">
<link href="<?php echo base_url(); ?>assets/front/css/font.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/revslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/owl.theme.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style-me.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script> 


</head>

<body>
<div class="page"> 
  <!-- Header -->
  <header class="header-container">
    <div class="header-top">
      <div class="container">
        <div class="row">          
          <div class="col-xs-2">
            <div class="dropdown block-language-wrapper"> <a role="button"  class="block-language dropdown-toggle" href="/"> <img src="<?php echo base_url(); ?>/assets/front/images/gem-icon.png" alt="assets/front/images/gem-icon.png"> <span class="hidden-xs">Welcome visitor! </span> </a>
            </div>
          </div>
          <div class="col-xs-10"> 
            <!-- Header Top Links -->
            <div class="toplinks">
              <div class="links">			  
                <div class="myaccount"><a title="My Account" href="#"><span class="glyphicon glyphicon-check"></span> Checkout </a></div>
				<?php if(isset($this->session->user['id'])){?>	
				<div class="myaccount"><a title="My Account" href="/default/myaccount/dashboard"><i class="fa fa-user"></i></span> My Account </a></div>
				<div class="wishlist"><a title="Logout" href="/default/login/logout"><span class="glyphicon glyphicon-lock"></span>  Logout  </a></div>
				<?php }else{
				?>
				<div class="wishlist"><a title="Login" href="/login"><span class="glyphicon glyphicon-lock"></span>  Login  </a></div>
                <div class="wishlist"><a title="Register" href="/register"> <span class="glyphicon glyphicon-edit"></span>  Register  </a></div>
				<?php
				}?>
                
                <div class="phone hidden-xs"> +1 (00) 86 868 868 666</div>
              </div>
            </div>
            <!-- End Header Top Links --> 
          </div>
        </div>
      </div>
    </div>
    <div class="header container">
      <div class="row">
        <div class="col-lg-2 col-sm-3 col-md-2 col-xs-12"> 
          <!-- Header Logo --> 
          <a class="logo" title="" href="/"><img alt="Magento Commerce" src="<?php echo base_url(); ?>/assets/front/images/logo.png"></a> 
          <!-- End Header Logo --> 
        </div>
       
        <!-- Top Cart -->
        <div class="col-lg-10 col-sm-9 col-md-10 col-xs-12 message">
         
          <div class="signup"><a title="Login" href="#"><span class=" glyphicon glyphicon-user usericon"></span> <span class="hidden-xs">  Welcome User </span></a></div> 	
          <span class="or"> | </span>
          <div class="signup"><a title="Login" href="#"><span class="glyphicon glyphicon-heart usericon"></span> <span class="hidden-xs">  Item Watched </span></a></div> 	
          <span class="or"> | </span>
          <div class="signup"><a title="Login" href="#"><span class="glyphicon glyphicon-comment usericon"></span> <span class="hidden-xs">  Message </span></a></div>
        </div>
        <!-- End Top Cart --> 
      </div>
    </div>
  </header>
  <!-- end header --> 





  <!-- Navbar -->
  <nav>
    <div class="container">
      <div class="nav-inner"> 
        
        <!-- mobile-menu -->
        <div class="hidden-desktop" id="mobile-menu">
          <ul class="navmenu">
            <li>
              <div class="menutop">
                <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                <h2>Menu</h2>
              </div>
              <ul style="display:none;" class="submenu">
                <li>
                  <ul class="topnav">

                     <li class="level0 nav-9 level-top last parent "> </li>
                     <li class="level0 nav-7 level-top parent"> 
                       <div style="margin-bottom:25px;">
                      <select name="category_id" class="search_res ">
                         <option value="37"> <b>Gemstone</b></option>
                         <option value="42">&nbsp;Gemstone1</option>
                         <option value="42">&nbsp;Gemstone2</option>
                         <option value="42">&nbsp;Gemstone3</option>
                         <option value="42">&nbsp;Gemstone4</option>
                         <option value="42">&nbsp;Gemstone5</option>
                      </select>
                       <select name="category_id" class="search_res ">
                         <option value="37">Shape</option>
                         <option value="42">&nbsp;Gemstone1</option>
                         <option value="42">&nbsp;Gemstone2</option>
                         <option value="42">&nbsp;Gemstone3</option>
                         <option value="42">&nbsp;Gemstone4</option>
                         <option value="42">&nbsp;Gemstone5</option>
                      </select>
                       <select name="category_id" class="search_res ">
                         <option value="37">Size</option>
                         <option value="42">&nbsp;Gemstone1</option>
                         <option value="42">&nbsp;Gemstone2</option>
                         <option value="42">&nbsp;Gemstone3</option>
                         <option value="42">&nbsp;Gemstone4</option>
                         <option value="42">&nbsp;Gemstone5</option>
                      </select>
                       <select name="category_id" class="search_res ">
                         <option value="37">Location</option>
                         <option value="42">&nbsp;Gemstone1</option>
                         <option value="42">&nbsp;Gemstone2</option>
                         <option value="42">&nbsp;Gemstone3</option>
                         <option value="42">&nbsp;Gemstone4</option>
                         <option value="42">&nbsp;Gemstone5</option>
                      </select>

                      <button id="Button2" class="search-btn-bg2"><span class="glyphicon glyphicon-search"></span></button>
                      </div>
        

                     </li>

                    <li class="level0 nav-6 level-top first parent"> <a class="level-top" href="index.html"> <span>Home</span> </a>
                     
                    </li>
                 
                    <li class="level0 nav-6 level-top"> <a class="level-top" href="#"> <span>Gemstone</span> </a>
                     
                    </li>
                   
                    <li class="level0 parent drop-menu"><a href="blog.html"><span>Seller Store</span> </a>
                      <ul class="level1">
                        <li class="level1 first"><a href="#"><span> <b>Store By Country</b> </span></a></li>
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Country1</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Country2</span> </a> </li>
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Country3</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Country4</span> </a> </li>

                        <li class="level1 first"><a href="#"><span> <b>Store By Location</b> </span></a></li>

                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Location1</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Location2</span> </a> </li>
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Location3</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Location4</span> </a> </li>
                      </ul>
                    </li>

                     <li class="level0 parent drop-menu"><a href="blog.html"><span>Information</span> </a>
                      <ul class="level1">
                        
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Granding Scale</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Gem Certification</span> </a> </li>
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Gemstone Solution</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Astrological Use</span> </a> </li>

                        <li class="level1 first"><a href="#"><span> <b>Store By Location</b> </span></a></li>

                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>List of Articles</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Shipping & Returns</span> </a> </li>
                        <li class="level1 first"><a href="blog_posts_table_view.html"><span>Privacy Notice</span></a></li>
                        <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>About Us</span> </a> </li>
                      </ul>
                    </li>


                   
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          <!--navmenu--> 
        </div>
        <!--End mobile-menu --> 



        <a class="logo-small" title="Magento Commerce" href="index.html"><img alt="Magento Commerce" src="<?php echo base_url(); ?>/assets/front/images/gem-icon.png"></a>
        <ul id="nav" class="hidden-xs">
          <li class="level0 parent drop-menu"><a href="index.html" class="active1"><span>Home</span> </a>
           
          </li>
          <li class="level0 parent drop-menu"><a href="#"><span>Gemstone</span> </a></li>
          
         
          
          <li class="level0 nav-5 level-top parent"><a href="grid.html"><span>Seller Store</span> </a>
            <div class="level0-wrapper dropdown-6col" style="display: none;">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center">
                  <ul class="level0">
                    <li class="level1 nav-6-1 parent item"> <a href="grid.html"><span>Store By Country </span></a> 
                      <!--sub sub category-->
                      <ul class="level1">
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country1</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country2</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country3</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country4</span></a> </li>
                      </ul>
                      <!--sub sub category--> 
                    </li>
                    <li class="level1 nav-6-1 parent item"> <a href="grid.html"><span>Store By Location </span></a> 
                      <!--sub sub category-->
                      <ul class="level1">
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location1</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location2</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location3</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location4</span></a> </li>
                      </ul>
                      <!--sub sub category--> 
                    </li>
                   
                    
                  </ul>
                </div>
              </div>
              <!--level0-wrapper2--> 
            </div>
          </li>
          <li class="level0 nav-5 level-top parent"><a href="grid.html"><span>Information</span> </a>
            <div class="level0-wrapper dropdown-6col" style="display: none;">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center">
                  <ul class="level0">
                    <li class="level1 nav-6-1 parent item"> <a href="grid.html"><span>Store By Country </span></a> 
                      <!--sub sub category-->
                      <ul class="level1">
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country1</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country2</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country3</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Country4</span></a> </li>
                      </ul>
                      <!--sub sub category--> 
                    </li>
                    <li class="level1 nav-6-1 parent item"> <a href="grid.html"><span>Store By Location </span></a> 
                      <!--sub sub category-->
                      <ul class="level1">
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location1</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location2</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location3</span></a> </li>
                        <li class="level2 nav-6-1-1"> <a href="grid.html"><span>Location4</span></a> </li>
                      </ul>
                      <!--sub sub category--> 
                    </li>
                   
                    
                  </ul>
                </div>
              </div>
              <!--level0-wrapper2--> 
            </div>
          </li>
        
          <li class="nav-custom-link level0 level-top parent"> 
           
                 <div class="search-box">
            <form method="POST" id="Form1" name="Categories">
              <select name="category_id" class="cate-dropdown hidden-xs">
                 <option value="37"> <b>Gemstone</b></option>
                 <option value="42">&nbsp;Gemstone1</option>
                 <option value="42">&nbsp;Gemstone2</option>
                 <option value="42">&nbsp;Gemstone3</option>
                 <option value="42">&nbsp;Gemstone4</option>
                 <option value="42">&nbsp;Gemstone5</option>
              </select>
               <select name="category_id" class="cate-dropdown hidden-xs">
                 <option value="37">Shape</option>
                 <option value="42">&nbsp;Gemstone1</option>
                 <option value="42">&nbsp;Gemstone2</option>
                 <option value="42">&nbsp;Gemstone3</option>
                 <option value="42">&nbsp;Gemstone4</option>
                 <option value="42">&nbsp;Gemstone5</option>
              </select>
               <select name="category_id" class="cate-dropdown hidden-xs">
                 <option value="37">Size</option>
                 <option value="42">&nbsp;Gemstone1</option>
                 <option value="42">&nbsp;Gemstone2</option>
                 <option value="42">&nbsp;Gemstone3</option>
                 <option value="42">&nbsp;Gemstone4</option>
                 <option value="42">&nbsp;Gemstone5</option>
              </select>
               <select name="category_id" class="cate-dropdown hidden-xs">
                 <option value="37">Location</option>
                 <option value="42">&nbsp;Gemstone1</option>
                 <option value="42">&nbsp;Gemstone2</option>
                 <option value="42">&nbsp;Gemstone3</option>
                 <option value="42">&nbsp;Gemstone4</option>
                 <option value="42">&nbsp;Gemstone5</option>
              </select>

              <button id="Button1" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span></button>
            </form>
          </div>             
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- end nav --> 
 <?php echo $content;?>
  <!-- Footer -->
  <footer class="footer">    
    <div class="footer-middle container">
      <div class="col-md-3 col-sm-4">
        <div class="footer-logo"><a href="index.html" title="Logo"><img src="images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus diam arcu. </p>
        <div class="payment-accept">
          <div>
		  <img src="<?php echo base_url(); ?>/assets/front/images/payment-1.png" alt="payment"> 
		  <img src="<?php echo base_url(); ?>/assets/front/images/payment-2.png" alt="payment"> 
		  <img src="<?php echo base_url(); ?>/assets/front/images/payment-3.png" alt="payment"> 
		  <img src="<?php echo base_url(); ?>/assets/front/images/payment-4.png" alt="payment">
		  </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-4">
        <h4>Shopping Guide</h4>
        <ul class="links">
          <li class="first"><a href="#" title="How to buy">How to buy</a></li>
          <li><a href="faq.html" title="FAQs">FAQs</a></li>
          <li><a href="#" title="Payment">Payment</a></li>
          <li><a href="#" title="Shipment&lt;/a&gt;">Shipment</a></li>
          <li><a href="delivery.html" title="delivery">Delivery</a></li>
          <li class="last"><a href="#" title="Return policy">Return policy</a></li>
        </ul>
      </div>
      <div class="col-md-2 col-sm-4">
        <h4>Style Advisor</h4>
        <ul class="links">
          <li class="first"><a title="Your Account" href="login.html">Your Account</a></li>
          <li><a title="Information" href="#">Information</a></li>
          <li><a title="Addresses" href="#">Addresses</a></li>
          <li><a title="Addresses" href="#">Discount</a></li>
          <li><a title="Orders History" href="#">Orders History</a></li>
          <li class="last"><a title=" Additional Information" href="#">Additional Information</a></li>
        </ul>
      </div>
      <div class="col-md-2 col-sm-4">
        <h4>Information</h4>
        <ul class="links">
          <li class="first"><a href="sitemap.html" title="Site Map">Site Map</a></li>
          <li><a href="#/" title="Search Terms">Search Terms</a></li>
          <li><a href="#" title="Advanced Search">Advanced Search</a></li>
          <li><a href="contact_us.html" title="Contact Us">Contact Us</a></li>
          <li><a href="#" title="Suppliers">Suppliers</a></li>
          <li class=" last"><a href="#" title="Our stores" class="link-rss">Our stores</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-4">
        <h4>Contact us</h4>
        <div class="contacts-info">
          <address>
          <i class="add-icon">&nbsp;</i>123 Main Street, Anytown, <br>
          &nbsp;CA 12345  USA
          </address>
          <div class="phone-footer"><i class="phone-icon">&nbsp;</i> +1 800 123 1234</div>
          <div class="email-footer"><i class="email-icon">&nbsp;</i> <a href="mailto:support@magikcommerce.com">support@magikcommerce.com</a> </div>
        </div>
      </div>
    </div>


    <div class="footer-bottom">
     <div class="container">
      <div class="col-sm-5 col-xs-12 coppyright"> &copy; 2016 Gemstone. All Rights Reserved.  </div>
      <div class="col-sm-7 col-xs-12 company-links">
        <ul class="links">
          
          <li class="last"><a href="#" title="Magento Extensions">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    </div>
  </footer>
  <!-- End Footer --> 
</div>

<!-- JavaScript --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/common.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.validate.min.js" type="text/javascript"></script> 
</body>
</html>
