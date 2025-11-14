<?php 
include 'controller/header.php';
if(isset($_SESSION['mediname']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
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
                <form class="theme-form">
                  <h2 class="text-center">Sign in to account</h2>
                  <p class="text-center">Enter your username & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="text" required="" id="username" name="username" placeholder="TEST">
					<input type="hidden" name="type" value="login"/>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" id="password-field" required="" placeholder="*********">
                      
                    </div>
                  </div>
				  
				  <div class="form-group">
                  <label>Type?</label>
                  <div class="input-group"><span class="input-group-text"><i class="fa fa-users"></i></span>
                    <select class="form-control" name="stype" id="stype" required>
					<option value="">Select A Type</option>
					<option value="mowner">Master Admin</option>
					<option value="sowner">Store Panel</option>
					</select>
                  </div>
                </div>
				
                  <div class="form-group mb-0">
                   
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                 
                </form>
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