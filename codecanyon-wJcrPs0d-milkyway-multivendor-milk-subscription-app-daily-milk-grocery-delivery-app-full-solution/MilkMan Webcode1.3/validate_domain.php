<?php 
include 'controller/header.php';
?>
    <!-- Loader ends-->
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div>
              <div><a class="logo" href="#"><img class="img-fluid for-light" src="<?php echo $set['weblogo'];?>" alt="logo image"></a></div>
              <div class="login-main"> 
			  <div id="getmsg"></div>
                <div class="theme-form">
                  <h2 class="text-center">Validate Domain</h2>
                  <p class="text-center">Validate Domain To Use Our Services.</p>
                 <div class="form-group">
                    <label class="col-form-label">Enter Envato Purchase Code</label>
                    <div class="form-input position-relative">
                      <input type="text" class="form-control" id="inputCode" placeholder="Enter Envato Purchase Code" required="">
                      
                    </div>
                  </div>
				  
				
				
                  <div class="form-group mb-0">
                   
                    <div class="text-end mt-3">
                     <button class="btn btn-primary btn-block w-100" id="sub_activate">Activate Domain               </button>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
       <?php 
		include 'controller/pharma.php';
		?>
    </div>
  </body>


</html>