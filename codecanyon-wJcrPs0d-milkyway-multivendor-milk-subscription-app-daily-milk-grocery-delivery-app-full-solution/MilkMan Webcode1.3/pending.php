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
                  <h3>Pending Order Management</h3>
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
				if(isset($_GET['oid']))
				{
					$count = $medi->query("select * from tbl_normal_order where id=".$_GET['oid']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 { 
					?>
					 <form class="form" method="post">
							<div class="form-body">
								

							

								<div class="form-group">
									<label for="cname">Select Delivery Boy</label>
									<select name="srider" class="form-control">
									<option value="">select a Delivery Boy</option>
									<?php 
									$rid = $medi->query("select * from tbl_rider where  status=1 and store_id=".$sdata["id"]."");
									while($ro = $rid->fetch_assoc())
									{
									?>
									<option value="<?php echo $ro['id'];?>"><?php echo $ro['title'];?></option>
									<?php } ?>
									</select>
									<input type="hidden" name="type" value="assign_rider"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['oid'];?>"/>
								</div>
                                
								
								
								<div class="card-footer text-left">
                                        <button  class="btn btn-primary">Assign Rider</button>
                                    </div>
								</div>
								</form>
					<?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Assign Rider Own Orders
						 </h6>
						 <a href="pending.php" class="btn btn-primary">Back To Orders</a>
						 
						 </div>
						 <?php
					 }
				}else if(isset($_GET['d_id']))
				{
					$count = $medi->query("select * from tbl_normal_order where id=".$_GET['d_id']." and store_id=".$sdata['id']."")->num_rows;
					 if($count !=0)
					 { 
					?>
					 <form class="form" method="post">
							<div class="form-body">
								

							

								<div class="form-group">
									<label for="cname">Cancle Reason</label>
									<textarea name="c_reason" class="form-control" style="resize:none;"></textarea>
									<input type="hidden" name="type" value="cancle_order"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['d_id'];?>"/>
								</div>
                                
								
								
								<div class=" text-left">
                                        <button  class="btn btn-primary">Reject Order</button>
                                    </div>
								</div>
								</form>
					<?php 
					 }
					 else 
					 {
						 ?>
						 <div class="card-body text-center">
						 <h6>
						 Cancelled Own Orders
						 </h6>
						 <a href="pending.php" class="btn btn-primary">Back To Orders</a>
						 
						 </div>
						 <?php
					 }
				}
				else 
				{
					?>
				<div class="table-responsive">
                <table class="display" id="basic-1">
                        <thead>
                                                <tr>
                                               
												 <th>Order Id</th>
                                                 <th>Order <br> Date </th>
												 <th>Delivery Boy<br> Name</th>
                                                 <th>Current <br>Status</th>
												 <th>Order <br>Flow</th>
												  <th>Order<br> Type</th>
												  <th>Order <br>Timeslot</th>
                                                 <th>Preview<br> Data</th>
												<th>Order Assign?</th>
												 <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $medi->query("SELECT * FROM `tbl_normal_order` where status!='Cancelled' and status!='Completed' and store_id=".$sdata["id"]." order by id desc limit 10");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
												
												
												
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
                                                <td>
												<?php 
												if($row['o_type'] == 'Self Pickup')
												{
													?>
													<span>Pick up Self Order</span>
													<?php 
												}
												else 
												{
												?>
												<a href="?oid=<?php echo $row['id']; ?>"   class="btn btn-sm btn-info <?php if($row['order_status'] == 0 or $row['o_status'] == 'Cancelled' or $row['order_status'] == 2 or $row['order_status'] == 3 or $row['order_status'] == 4 or $row['order_status'] == 6 or $row['order_status'] == 7 ){ echo 'disabled'; } ?>"><?php if($row['order_status'] == 5){?>Reassign Delivery Boy<?php } else { ?>Assign Delivery Boy<?php } ?></a>
												<?php } ?>
												</td>
												<td>
												<?php if($row['a_status'] == 0){?>
												<span  data-id="<?php echo $row['id'];?>" data-status="1" data-type="update_status" coll-type="orderapprove"  class=" drop btn btn-sm btn-success">Approve</span>
												<a href="?d_id=<?php echo $row['id']; ?>"  class="btn btn-sm btn-danger">Reject</a>
												<?php }else if($row['a_status'] == 1) {
													if($row['o_type'] == 'Self Pickup')
												{
													?>
													<span data-id="<?php echo $row['id'];?>" data-status="7" data-type="update_status" coll-type="ordercomplete"  class=" drop btn btn-sm btn-success">Complete Order</span>
													<?php 
												}
												else 
												{
													?>
												
												<span class="text text-success">Accepted</span>
												<?php } } else { ?>
												<span class="text text-danger"> Rejected </span>
												<?php } ?>
												
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                      </table>
					  </div>
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
	<div div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    
    <div class="modal-content">
      <div class="modal-header">
        <h4>Order Preivew</h4>
        <button type="button" class="close" data-bs-dismiss="modal" style="position: absolute;
    right: 5px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 30px;
    padding: 0;
    background: #ffffff;
    color: #000;
    opacity: 1;
    font-size: 20px;
    line-height: 10px;
    border: 0px;
    box-shadow: 3px 6px 37px #d3d3d3;">&times;</button>
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