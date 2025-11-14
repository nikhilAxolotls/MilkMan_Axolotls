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
                  <h3>Cancelled Order Management</h3>
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
                                               <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order <br> Date </th>
												 <th>Delivery Boy<br> Name</th>
                                                 <th>Current <br>Status</th>
												 <th>Order <br>Flow</th>
												  <th>Order<br> Type</th>
												  <th>Order <br>Timeslot</th>
                                                 <th>Preview<br> Data</th>
												
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $medi->query("SELECT * FROM `tbl_normal_order` where status='Cancelled' and store_id=".$sdata["id"]." order by id desc limit 10");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
												
												<?php 
												if($row['status'] == 'Pending')
												{
													?>
												<td class="beep">  </td>
                                                <?php } else if($row['status'] == 'Processing') {?>
												<td class="beeps">  </td>
                                                <?php } else {?>
												<td class="beepss">  </td>
												<?php }?>
												
												<td> <?php echo $row['id']; ?> </td>
                                               
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td><?php 
											   if($row['o_type'] == 'Self Pickup')
											   {
												 ?> <span class="badge badge-primary">Self Pickup</span><?php 
											   }
											   else 
											   {
											   $rdata = $medi->query("select title from tbl_rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['title'] == '') {echo '';}else {echo $rdata['title'];} }?></td>
											   
											   <td> <?php echo $row['status']; ?></td>
											    <td><?php 
											   if($row['order_status'] == 0)
											   {
												   ?>
												   <span class="badge badge-primary">Waiting For Decision</span>
												   <?php 
											   }
											   else if($row['order_status'] == 1)
											   {
												  ?>
												   <span class="badge badge-primary">Accepted Waiting For Assign</span>
												   <?php  
											   }
											   else if($row['order_status'] == 2)
											   {
												  ?>
												   <span class="badge badge-danger">Cancelled By You</span>
												   <?php  
											   }
											   else if($row['order_status'] == 3)
											   {
												  ?>
												   <span class="badge badge-primary">Waiting For Delivery Boy Decision</span>
												   <?php  
											   }
											   else if($row['order_status'] == 4)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Pick up Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 5)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Reject Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 6)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Completed Order</span>
												   <?php  
											   }
											   
											   else if($row['order_status'] == 7)
											   {
												  ?>
												   <span class="badge badge-primary">Order Completed Pickup</span>
												   <?php  
											   }
											   else 
											   {
											   }
											   ?></td>
											   <td><span class="badge badge-primary"><?php echo $row['o_type'].' Order'; ?> </span></td>
											   <td><span class="badge badge-primary"><?php echo $row['tslot']; ?> </span></td>
												 <td> <button class="preview_d btn btn-sm btn-primary" data-id="<?php echo $row['id'];?>" data-bs-toggle="modal" data-bs-target="#myModal">Preview</button></td>
                                               
                                                </tr>
<?php } ?>                                           
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
	<div div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    
    <div class="modal-content">
      <div class="modal-header">
        <h4>Order Preivew</h4>
        <button type="button" class="close" data-bs-dismiss="modal" style="position: absolute;
    right: 0;
    top: 0;
    width: 50px;
    height: 50px;
    border-radius: 29px;
    padding: 10px;
    background: #D9534F;
    color: #fff;
    opacity: 1;">&times;</button>
      </div>
      <div class="modal-body p_data">
      
      </div>
     
    </div>

  </div>
</div>
    <!-- latest jquery-->
     <?php 
		include 'controller/pharma.php';
		?>
    
  </body>


</html>