<?php 
if(isset($_SESSION['mediname']))
{
	
}
else 
{
	?>
	<script>
	window.location.href="/";
	</script>
	<?php 
}
?>
<div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="dashboard.php"><img class="img-fluid for-light" src="<?php echo $set['weblogo'];?>" alt=""><img class="img-fluid for-dark" src="<?php echo $set['weblogo'];?>" alt=""></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-left"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="dashboard.php"><img class="img-fluid for-light" src="<?php echo $set['weblogo'];?>" alt=""><img class="img-fluid for-dark" src="<?php echo $set['weblogo'];?>" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
			  <?php 
			  if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
			?>
			 <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="dashboard.php"><img class="img-fluid for-light" src="<?php echo $set['weblogo'];?>" alt=""><img class="img-fluid for-dark" src="<?php echo $set['weblogo'];?>" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
				  
                  <li class="sidebar-main-title">  
                    <div>       
                      <h4 class="">General         </h4>
                    </div>
                  </li>
                
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="dashboard.php"><i data-feather="home"> </i><span>Dashboard</span></a></li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="folder-plus"></i><span>Category</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_mcat.php">Add  Category</a></li>
                      <li><a href="list_mcat.php">List Category</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="package"></i><span>Product</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_product.php">Add Product</a></li>
                      <li><a href="list_product.php">List Product</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="package"></i><span>Product Attributes</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_product_attr.php">Add Product Attributes</a></li>
                      <li><a href="list_product_attr.php">List Product Attributes</a></li>
                    </ul>
                  </li>
				  
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="package"></i><span>Deliveries</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_delivery.php">Add Deliveries</a></li>
                      <li><a href="list_delivery.php">List Deliveries</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="image"></i><span>Product Images</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_extra.php">Add Product Images</a></li>
                      <li><a href="list_extra.php">List Product Images</a></li>
                    </ul>
                  </li>
				  <li class="sidebar-main-title">  
                    <div>       
                      <h4 class="">Coupon & FAQ         </h4>
                    </div>
                  </li>
				  
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="percent"></i><span>Coupon</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_coupon.php">Add Coupon</a></li>
                      <li><a href="list_coupon.php">List Coupon</a></li>
                    </ul>
                  </li>
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="info"></i><span>FAQ</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_faq.php">Add FAQ</a></li>
                      <li><a href="list_faq.php">List FAQ</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="image"></i><span>Gallery</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_photo.php">Add Gallery</a></li>
                      <li><a href="list_photo.php">List Gallery</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-main-title">  
                    <div>       
                      <h4 class="">Rider & Timeslot         </h4>
                    </div>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="truck"></i><span>Rider</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_rider.php">Add Rider</a></li>
                      <li><a href="list_rider.php">List Rider</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clock"></i><span>Timeslot</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_time.php">Add Timeslot</a></li>
                      <li><a href="list_time.php">List Timeslot</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-main-title">  
                    <div>       
                      <h4 class="">Orders & Payout         </h4>
                    </div>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shopping-cart"></i><span>Normal Order</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="pending.php">Pending Order</a></li>
                      <li><a href="cancle.php">Cancelled Order</a></li>
					  <li><a href="complete.php">Completed Order</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clipboard"></i><span>Subscription Order</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="pporder.php">Pending Order</a></li>
                      <li><a href="cporder.php">Cancelled Order</a></li>
					  <li><a href="coporder.php">Completed Order</a></li>
                    </ul>
                  </li>
				  
				  </ul>
		<?php } else { ?>
		
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="index-2.html"><img class="img-fluid for-light" src="assets/images/logo/logo-icon.png" alt=""><img class="img-fluid for-dark" src="assets/images/logo/logo-icon-dark.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
				  
                  <li class="sidebar-main-title">  
                    <div>       
                      <h4 class="">General         </h4>
                    </div>
                  </li>
                
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="dashboard.php"><i data-feather="home"> </i><span>Dashboard</span></a></li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="image"></i><span>Banner</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_banner.php">Add Banner</a></li>
                      <li><a href="list_banner.php">List Banner</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="git-pull-request"></i><span>Category</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_category.php">Add Category</a></li>
                      <li><a href="list_category.php">List Category</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">    
                    <div>     
                      <h4 class="">Store Management             </h4>
                    </div>
                  </li>
				  <li class="sidebar-list">           <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="map-pin"></i><span>Delivery Zone                </span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Zone.php">Add Delivery Zone  </a></li>
                      <li><a href="list_Zone.php">List Delivery Zone  </a></li>
                    </ul>
                  </li>
				  
                  <li class="sidebar-list">           <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shopping-bag"></i><span>Store                </span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_store.php">Add Store</a></li>
                      <li><a href="list_store.php">List Store</a></li>
                       <li><a href="list_payout.php">List Payout</a></li>
                      
                    </ul>
                  </li>
				  
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="payment_method.php"><i data-feather="shield"></i><span>Payment Gateway</span></a></li>
				   <li class="sidebar-main-title">    
                    <div>     
                      <h4 class="">Page Management             </h4>
                    </div>
                  </li>
				  <li class="sidebar-list">           <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Pages                </span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Page.php">Add Pages</a></li>
                      <li><a href="list_Page.php">List Pages</a></li>
                    </ul>
                  </li>
                   <li class="sidebar-main-title">    
                    <div>     
                      <h4 class="">User Management             </h4>
                    </div>
                  </li>
                 <li class="sidebar-list">  <a class="sidebar-link sidebar-title link-nav" href="userlist.php"><i data-feather="user"> </i><span>User List</span></a></li>
                  
                </ul>
	<?php } }?>
                <div class="sidebar-img-section">
                  <div class="sidebar-img-content"><img class="img-fluid" src="assets/images/dashboard/upgrade/2.png" alt="">
                    <h4>Let's contact us</h4><a class="btn btn-primary" href="https://join.skype.com/invite/UaLkm7W1aZey" target="_blank">Contact</a>
                  </div>
                </div>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>