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
                  <h3>Extra Image Management</h3>
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
					 $data = $medi->query("select * from tbl_extra where id=".$_GET['id']." and store_id=".$sdata["id"]."")->fetch_assoc();
					 
					 $count = $medi->query("select * from tbl_extra where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					 <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
										<div class="form-group mb-3">
									<label for="cname">Product? </label>
									<select name="mid"  required class="form-control select2-single" data-placeholder="Select Product">
<option value="" selected disabled>Select
Product</option>
<?php 
$zone = $medi->query("select * from tbl_product where store_id=".$sdata["id"]."");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['mid']){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
								</div>
								
                                        <div class="form-group mb-3">
                                            <label>Product Image</label>
                                            <input type="file" class="form-control" name="cat_img" >
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
											<input type="hidden" name="type" value="edit_extra"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Product Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Edit  Product Image</button>
                                    </div>
                                </form>
					 <?php
					 }
else 
{
	?>
	<div class="card-body text-center">
						 <h6>
						 Check Own Extra Image Or Add New Extra Image Of Below Click Button.
						 </h6>
						 <a href="add_extra.php" class="btn btn-primary">Add Extra Image</a>
						 
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
									<label for="cname">Product? </label>
									<select name="mid"  required class="form-control select2-single" data-placeholder="Select Product">
<option value="" selected disabled>Select
Product</option>
<?php 
$zone = $medi->query("select * from tbl_product where store_id=".$sdata["id"]."");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
								</div>
								
                                        <div class="form-group mb-3">
                                            <label>Product Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
											<input type="hidden" name="type" value="add_extra"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Product Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Add Product Image</button>
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