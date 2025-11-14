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
                  <h3>FAQ Management</h3>
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
					 $data = $medi->query("select * from tbl_faq where id=".$_GET['id']." and store_id=".$sdata['id']."")->fetch_assoc();
					  $count = $medi->query("select * from tbl_faq where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					 <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Question</label>
                                    
                                  <input type="text" class="form-control" placeholder="Enter Question" value="<?php echo $data['question'];?>" name="question" aria-label="Username" aria-describedby="basic-addon1">
                               
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Answer</label>
                                    
                                  <input type="text" class="form-control" placeholder="Enter Answer" value="<?php echo $data['answer'];?>" name="answer" aria-label="Username" aria-describedby="basic-addon1">
                                <input type="hidden" name="type" value="edit_faq"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                    
                                        <label  for="inputGroupSelect01">Select Status</label>
                                    
                                    <select  class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
                                        <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary">Edit FAQ</button>
                                </form>
					 <?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Check Own FAQ Or Add New FAQ Of Below Click Button.
						 </h6>
						 <a href="add_faq.php" class="btn btn-primary">Add FAQ</a>
						 
						 </div>
						 <?php 
					 }
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Question</label>
                                    
                                  <input type="text" class="form-control" placeholder="Enter Question"  name="question" aria-label="Username" aria-describedby="basic-addon1">
                            
								</div>
								
								<div class="form-group mb-3">
                                   
                                        <label  id="basic-addon1">Enter Answer</label>
                                    
                                  <input type="text" class="form-control" placeholder="Enter Answer"  name="answer" aria-label="Username" aria-describedby="basic-addon1">
                                <input type="hidden" name="type" value="add_faq"/>	
								</div>
								
                                    
                                   <div class="form-group mb-3">
                                   
                                        <label  for="inputGroupSelect01">Select Status</label>
                                    
                                    <select class="form-control" name="status" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Unpublish</option>
                                       
                                    </select>
                                </div>
                                    <button type="submit" class="btn btn-primary">Add FAQ</button>
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