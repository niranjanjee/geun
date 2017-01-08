<?php
$sid = "";
 $storeid = get_table_record("gem_stores", 0, "id", array("user_id" => $this->session->user['id']));
 if(count($storeid) > 0 && isset($storeid[0]->id))
 {
	$sid = $storeid[0]->id;
 }
?>
<div class="col-xs-12 account-nav">
  <div class="btn-group" role="group">
	<a class="btn btn-default <?php echo ($active_tabs == "dashboard")?'active':''?>" href="/default/myaccount/dashboard"><i aria-hidden="true" class="fa fa-th"></i>Account Dashboard</a>
	<a class="btn btn-default <?php echo ($active_tabs == "mystore")?'active':''?>" href="/default/myaccount/mystore<?php echo ($sid !="")?'/'.$sid:'';?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>My Store</a>
	<?php if($sid != ""){?>
	<a class="btn btn-default <?php echo ($active_tabs == "myproducts")?'active':''?>" href="/default/myaccount/myproducts/<?php echo $sid;?>"><i class="fa fa-product-hunt" aria-hidden="true"></i>
</i>My Products</a>
	<?php }?>
	<a class="btn btn-default <?php echo ($active_tabs == "mymessages")?'active':''?>" href="/default/myaccount/mymessages"><i class="fa fa-envelope" aria-hidden="true"></i>My Messages</a>
	<a class="btn btn-default <?php echo ($active_tabs == "wishlist")?'active':''?>" href="/default/myaccount/wishlist"><i aria-hidden="true" class="fa fa-gift"></i>Wishlist</a>
	<a class="btn btn-default <?php echo ($active_tabs == "myprofile")?'active':''?>" href="/default/myaccount/myprofile"><i aria-hidden="true" class="fa fa-user"></i>My Profile</a>
  </div>
</div>