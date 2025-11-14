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
                  <h3>Product Management</h3>
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
					 $data = $medi->query("select * from tbl_product where id=".$_GET['id']." and store_id=".$sdata['id']."")->fetch_assoc();
					 $count = $medi->query("select * from tbl_product where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					
								
								<form method="post" enctype="multipart/form-data" >
                                    
                                    <div class="card-body">
                                        
                                        


								<div class="form-group mb-3">
									<label>Product Image</label>
									<input type="hidden" name="type" value="edit_product"/>
									<input type="file" name="product_img" class="form-control" >
									<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
									<br>
									<img src="<?php echo $data['img'];?>" width="100" height="100"/>
								</div>
								
								
								

								<div class="form-group mb-3">
									<label>Product Title</label>
									<input type="text" name="title" class="form-control"  value="<?php echo $data['title'];?>" placeholder="Enter Product Title" required>
								</div>
								
								
							 
							
							

  	


								<div class="form-group mb-3">
									<label for="cname">Product Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Product Status</option>
									<option value="1"  <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0"  <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
								
							
							

								
								
								
								
							
							
								<div class="form-group mb-3">
									<label for="cname">Product Category? </label>
									<select name="cat_id"  required class="form-control select2-single" data-placeholder="Select Category">
<option value="" selected disabled>Select
Category</option>
<?php 
$zone = $medi->query("select * from tbl_mcat where store_id=".$sdata["id"]."");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cat_id']){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
								</div>
							
								
 

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Product Description </label>
									<textarea class="form-control" rows="5"  name="description"  style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							</div>	


                                        
										
                                   
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Edit Product</button>
                                    </div>
                                </form>
					 <?php 
				 }
				 else 
				 {
					 ?>
					 <div class="card-body text-center">
						 <h6>
						 Check Own Product Or Add New Product Of Below Click Button.
						 </h6>
						 <a href="add_product.php" class="btn btn-primary">Add Product</a>
						 
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
									<label>Product Image</label>
									<input type="hidden" name="type" value="add_product"/>
									<input type="file" name="product_img" class="form-control"  required>
								</div>
								
								
								

								<div class="form-group mb-3">
									<label>Product Title</label>
									<input type="text" name="title" class="form-control"  placeholder="Enter Product Title" required>
								</div>
								
								
							
							
							

  	


								<div class="form-group mb-3">
									<label for="cname">Product Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							
							
							

								
								
								
									
							
							
								<div class="form-group mb-3">
									<label for="cname">Product Category? </label>
									<select name="cat_id"  required class="form-control select2-single" data-placeholder="Select Category">
<option value="" selected disabled>Select
Category</option>
<?php 
$zone = $medi->query("select * from tbl_mcat where store_id=".$sdata["id"]."");
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
									<label for="cname">Product Description </label>
									<textarea class="form-control" rows="5"  name="description"  style="resize: none;"></textarea>
								</div>
							</div>	

							
							
                                        
										
                                    
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Add Product</button>
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