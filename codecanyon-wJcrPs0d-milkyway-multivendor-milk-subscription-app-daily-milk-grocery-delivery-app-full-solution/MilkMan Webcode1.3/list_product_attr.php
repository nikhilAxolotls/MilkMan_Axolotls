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
                  <h3>Product Attributes List Management</h3>
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
				<div class="table-responsive">
                <table class="display" id="basic-1">
                        <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
												 
                                                
                                                <th>Product Title</th>
                                                
                                                <th>Product Type</th>
												<th>Product Price</th>
												<th>Product Sprice</th>
												<th>Product Discount</th>
												<th>Subscription <br>Required?</th>
												
                                                <th>Stock Status</th>
												
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $medi->query("SELECT * FROM `tbl_product_attribute` where store_id=".$sdata['id']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
                                                
                                                <td class="align-middle">
                                                   <?php 
												   $jp = $medi->query("select * from tbl_product where id=".$row['product_id']."")->fetch_assoc();
												   echo $jp['title'];
												   ?>
                                                </td>
                                                
                                               <td><?php echo $row['title'];?></td>
											   <td><?php echo $row['normal_price'].$set['currency'];?></td>
											   <td><?php echo $row['subscribe_price'].$set['currency'];?></td>
											   <td><?php echo $row['discount'].'%';?></td>
												
											 <?php if($row['subscription_required'] == 1) { ?>
                                                <td><div class="badge badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">No</div></td>
												<?php } ?>
											  
												<?php if($row['out_of_stock'] == 0) { ?>
                                                <td><div class="badge badge-success">In Stock</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Out Of Stock</div></td>
												<?php } ?>
                                                <td style="white-space: nowrap; width: 15%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                           <div class="btn-group btn-group-sm" style="float: none;">
										   <a href="add_product_attr.php?id=<?php echo $row['id'];?>" class="tabledit-edit-button" style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#79F9B4"/><path d="M22.5168 9.34109L20.6589 7.48324C20.0011 6.83703 18.951 6.837 18.2933 7.49476L16.7355 9.06416L20.9359 13.2645L22.5052 11.7067C23.163 11.0489 23.163 9.99885 22.5168 9.34109ZM15.5123 10.2873L8 17.8342V22H12.1658L19.7127 14.4877L15.5123 10.2873Z" fill="#25314C"/></svg></a>
										   </div>
                                           
                                       </div></td>
                                                </tr>
											<?php 
										}
										?>
                          
                        </tbody>
                      </table>
					  </div>
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