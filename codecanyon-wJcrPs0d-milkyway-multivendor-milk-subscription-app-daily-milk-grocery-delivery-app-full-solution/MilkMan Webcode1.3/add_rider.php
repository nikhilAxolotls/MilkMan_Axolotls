<?php 
include 'controller/header.php';
?>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
     <?php 
	 include 'controller/topbar.php';
	 ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php 
		include 'controller/sidebar.php';
		?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Rider Management</h3>
                </div>
                <div class="col-6">
                  
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid default-page">
		  <div class="row">
            <div class="col-sm-12">
                <div class="card">
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $medi->query("select * from tbl_rider where id=".$_GET['id']." and store_id=".$sdata["id"]."")->fetch_assoc();
					 $count = $medi->query("select * from tbl_rider where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					
								
								<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group mb-3">
                                            <label>Rider Image</label>
                                            <input type="file" class="form-control" name="cat_img" >
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
											<input type="hidden" name="type" value="edit_rider"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Title</label>
                                            <input type="text" placeholder="Enter Rider Title" value="<?php echo $data['title'];?>" class="form-control" name="title"  required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider email</label>
                                            <input type="email" class="form-control" placeholder="Enter Rider Email" value="<?php echo $data['email'];?>" name="email"  required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Country Code</label>
                                            <input type="text" class="form-control" name="ccode"  value="<?php echo $data['ccode'];?>" placeholder="Enter Rider Country Code" required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Mobile</label>
                                            <input type="text" class="form-control numberonly" name="mobile" value="<?php echo $data['mobile'];?>" placeholder="Enter Rider Mobile" required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider password</label>
                                            <input type="text" class="form-control" placeholder="Enter Rider password" value="<?php echo $data['password'];?>" name="password"  required="">
											
                                        </div>
										
										 <div class="form-group mb-3">
                                            <label>Rider Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Edit Rider</button>
                                    </div>
                                </form>
					 <?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Check Own Rider Data Or Add New Rider Data Of Below Click Button.
						 </h6>
						 <a href="add_rider.php" class="btn btn-primary">Add Rider</a>
						 
						 </div>
						 <?php 
					 }
				 }
				 else 
				 {
				 ?>
                  <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group mb-3">
                                            <label>Rider Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
											<input type="hidden" name="type" value="add_rider"/>
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Title</label>
                                            <input type="text" placeholder="Enter Rider Title" class="form-control" name="title"  required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider email</label>
                                            <input type="email" class="form-control" placeholder="Enter Rider Email" name="email"  required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Country Code</label>
                                            <input type="text" class="form-control" name="ccode"  placeholder="Enter Rider Country Code" required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider Mobile</label>
                                            <input type="text" class="form-control numberonly" name="mobile" placeholder="Enter Rider Mobile" required="">
											
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Rider password</label>
                                            <input type="text" class="form-control" placeholder="Enter Rider password" name="password"  required="">
											
                                        </div>
										
										 <div class="form-group mb-3">
                                            <label>Rider Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Add Rider</button>
                                    </div>
                                </form>
				 <?php } ?>
                </div>
              
                
              </div>
          </div>
		  </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        
      </div>
    </div>
    <!-- latest jquery-->
     <?php 
		include 'controller/pharma.php';
		?>
    
  </body>


</html>