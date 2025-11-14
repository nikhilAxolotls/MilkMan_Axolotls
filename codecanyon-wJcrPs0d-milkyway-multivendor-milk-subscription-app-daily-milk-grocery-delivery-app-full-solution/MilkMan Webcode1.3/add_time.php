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
                  <h3>Timeslot Management</h3>
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
					 $data = $medi->query("select * from tbl_time where id=".$_GET['id']." and store_id=".$sdata['id']."")->fetch_assoc();
					  $count = $medi->query("select * from tbl_time where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					 <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Min Time</label>
                                    
                                  <input type="time" class="form-control" placeholder="Enter Min Time" value="<?php echo $data['mintime'];?>" name="mintime" >
                               
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Max Time</label>
                                    
                                  <input type="time" class="form-control" placeholder="Enter Max Time" value="<?php echo $data['maxtime'];?>" name="maxtime">
                                <input type="hidden" name="type" value="edit_time"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                    
                                        <label  for="inputGroupSelect01">Time Status</label>
                                    
                                    <select  class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
                                        <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary">Edit Time</button>
                                </form>
					 <?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Check Own Timeslot Or Add New Timeslot Of Below Click Button.
						 </h6>
						 <a href="add_time.php" class="btn btn-primary">Add Timeslot</a>
						 
						 </div>
						 <?php 
					 }
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Min Time</label>
                                    
                                  <input type="time" class="form-control" placeholder="Enter Min Time"  name="mintime">
                            
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Max Time</label>
                                    
                                  <input type="time" class="form-control" placeholder="Enter Max Time"  name="maxtime">
                                <input type="hidden" name="type" value="add_time"/>	
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                   
                                        <label  for="inputGroupSelect01">Time Status</label>
                                    
                                    <select class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Unpublish</option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary">Add Time</button>
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