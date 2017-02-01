<section class="clearfix userdashboard" id="myaccount-section">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 account-nav">
              <?php $this->load->view('myaccount_nav_view');?>
            </div>
			<?php
$sid = "";
 $storeid = get_table_record("gem_stores", 0, "id", array("user_id" => $this->session->user['id']));
 if(count($storeid) > 0 && isset($storeid[0]->id))
 {
	$sid = $storeid[0]->id;
 }
?>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="inner-wrapper clearfix">
                <h3>Welcome <span><?php echo ucwords($this->session->user['name']);?></span></h3>
                <p>&nbsp;</p>
                <ul class="list-inline text-center">
                  <li><a class="btn btn-default btn-lg" href="/default/myaccount/myprofile"><i aria-hidden="true" class="fa fa-user"></i>My Profile</a></li>
				  <li><a class="btn btn-default btn-lg" href="/default/myaccount/mystore<?php echo ($sid !="")?'/'.$sid:'';?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>My Store</a></li>
                  <li><a class="btn btn-default btn-lg" href="/default/myaccount/mymessages"><i class="fa fa-envelope" aria-hidden="true"></i>My Messages</a></li>
                  <li><a class="btn btn-default btn-lg" href="/default/myaccount/wishlist"><i aria-hidden="true" class="fa fa-gift"></i>Wishlist</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>