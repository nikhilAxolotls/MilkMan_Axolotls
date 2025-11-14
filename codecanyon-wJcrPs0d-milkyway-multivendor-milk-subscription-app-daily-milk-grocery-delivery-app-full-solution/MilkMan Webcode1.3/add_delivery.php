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
                  <h3>Deliveries Management</h3>
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
				<div class="card-body">
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $medi->query("select * from tbl_delivery where id=".$_GET['id']." and store_id=".$sdata['id']."")->fetch_assoc();
					  $count = $medi->query("select * from tbl_delivery where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					 <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Title</label>
                                        <input type="text" class="form-control" name="cname" value="<?php echo $data['title'];?>"  placeholder="Enter Deliveries Title" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries IN Digit</label>
										<input type="hidden" name="type" value="edit_delivery"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        <input type="number" class="form-control" name="ddigit" value="<?php echo $data['de_digit'];?>"  placeholder="Enter Deliveries Digit" required>
                                        
                                    </div>
                                    
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1"<?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary">Update Deliveries</button>
                                </form>
					 <?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Check Own Deliveries Or Add New Deliveries Of Below Click Button.
						 </h6>
						 <a href="add_delivery.php" class="btn btn-primary">Add Deliveries</a>
						 
						 </div>
						 <?php 
					 }
				 }
				 else 
				 {
				 ?>
                  <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Title</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter Deliveries Title" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries IN Digit</label>
										<input type="hidden" name="type" value="add_delivery"/>
                                        <input type="number" class="form-control" name="ddigit"  placeholder="Enter Deliveries Digit" required>
                                        
                                    </div>
                                    
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary" >Add Deliveries</button>
                                </form>
				 <?php } ?>
                </div>
              
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