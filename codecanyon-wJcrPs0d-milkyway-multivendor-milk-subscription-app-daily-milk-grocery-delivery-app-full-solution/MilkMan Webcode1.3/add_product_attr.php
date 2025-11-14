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
					 $data = $medi->query("select * from tbl_product_attribute where id=".$_GET['id']." and store_id=".$sdata['id']."")->fetch_assoc();
					 $count = $medi->query("select * from tbl_product_attribute where id=".$_GET['id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 {
					 ?>
					
								
								
					                               <form method="post" >
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<input type="hidden" name="type" value="edit_product_attr"/>
									<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
									<select name="product" class="form-control select2-single" data-placeholder="Select Product" required>
									<option value="" selected disabled>Select
Product</option>
									<?php 
									$product = $medi->query("select * from tbl_product where status=1 and store_id=".$sdata['id']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['product_id'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type" value="<?php echo $data['title'];?>" class="form-control" required>
								</div>
								</div>
							
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="<?php echo $data['discount'];?>" class="form-control" step="any" required>
								</div>
								</div>
								
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="<?php echo $data['normal_price'];?>" class="form-control" required step="any">
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Subscription Price</label>
									<input type="number" name="sprice" placeholder="Enter product Subscription Price" value="<?php echo $data['subscribe_price'];?>" class="form-control" required step="any">
								</div>
								</div>
								
								
							
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" <?php if($data['out_of_stock'] == 1){echo 'selected';}?>>Yes</option>
									<option value="0"<?php if($data['out_of_stock'] == 0){echo 'selected';}?>>No</option>
									
									</select>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Subscription Required?</label>
									<select name="srequire" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" <?php if($data['subscription_required'] == 1){echo 'selected';}?>>Yes</option>
									<option value="0"<?php if($data['subscription_required'] == 0){echo 'selected';}?>>No</option>
									
									</select>
								</div>
								</div>

				
								
							</div>
                                        
										
                                    
                                    
                                        <button name="upattr" class="btn btn-primary">Update product Attributes</button>
                                   </div>
                                </form>
					 <?php 
				 }
				 else 
				 {
					 ?>
					 <div class="card-body text-center">
						 <h6>
						 Check Own Product Attributes Or Add New Product Attributes Of Below Click Button.
						 </h6>
						 <a href="add_product_attr.php" class="btn btn-primary">Add Product Attributes</a>
						 
						 </div>
					 <?php 
				 }
				 }
				 else 
				 {
				 ?>
               
								 <form method="post" >
                                    
                                    
                                        <div class="card-body">
                                        <div class="row">
								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<input type="hidden" name="type" value="add_product_attr"/>
									<select name="product" class="form-control select2-single" data-placeholder="Select Product" required>
									<option value="" selected disabled>Select
Product</option>
									<?php 
									$product = $medi->query("select * from tbl_product where status=1 and store_id=".$sdata['id']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type" value="" class="form-control" required>
								</div>
								</div>
							
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="0" class="form-control" step="any" required>
								</div>
								</div>
								
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="" class="form-control" required step="any">
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Subscription Price</label>
									<input type="number" name="sprice" placeholder="Enter product Subscription Price" value="" class="form-control" required step="any">
								</div>
								</div>
								
								
							
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" >Yes</option>
									<option value="0">No</option>
									
									</select>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Subscription Required?</label>
									<select name="srequire" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" >Yes</option>
									<option value="0">No</option>
									
									</select>
								</div>
								</div>

				
								
							</div>
                                        
										
                                    
                                    
                                        <button name="addattr" class="btn btn-primary">Add product Attributes</button>
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