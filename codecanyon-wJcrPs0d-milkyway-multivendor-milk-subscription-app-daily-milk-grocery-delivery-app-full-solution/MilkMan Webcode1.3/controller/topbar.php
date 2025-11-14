 <div class="page-header">
        <div class="header-wrapper row m-0">
          
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index-2.html"><img class="img-fluid for-light" src="assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="assets/images/logo/logo-dark.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col horizontal-wrapper ps-0">
           
          </div>
          <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">   
              
              
              
              
             
              <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="profile-nav onhover-dropdown p-0 me-0">
			  <?php 
			  if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
			
			?>
			<div class="d-flex profile-media"><img class="b-r-50" src="assets/images/dashboard/profile.png" alt="">
                  <div class="flex-grow-1"><span><?php echo $set['webname'];?></span>
                    <p class="mb-0 font-roboto">Store <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
				<ul class="profile-dropdown onhover-show-div">
                 
                  <li><a href="logout.php"><i data-feather="log-out"> </i><span>Log out</span></a></li>
                </ul>
		<?php } else { ?>
                <div class="d-flex profile-media"><img class="b-r-50" src="assets/images/dashboard/profile.png" alt="">
                  <div class="flex-grow-1"><span><?php echo $set['webname'];?></span>
                    <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
				<ul class="profile-dropdown onhover-show-div">
                  <li><a href="profile.php"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="setting.php"><i data-feather="file-text"></i><span>Setting</span></a></li>
                  <li><a href="logout.php"><i data-feather="log-out"> </i><span>Log out</span></a></li>
                </ul>
	<?php } }?>
                
              </li>
            </ul>
          </div>
         
        </div>
      </div>