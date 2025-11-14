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
                  <h3>Store Management</h3>
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
						if(isset($_GET['cid']))
						{
							?>
							<div class="card-header">
                                <h4 class="card-title">Manage Cash</h4>
                            </div>
                            <div class="card-body">
							<form method="post" enctype="multipart/form-data">
                                       
									   <?php $sales  = $medi->query("select sum(subtotal-cou_amt+d_charge) as full_total from tbl_normal_order where status='completed'  and p_method_id=5 and  store_id=".$_GET['cid']."")->fetch_assoc();
             $payout =   $medi->query("select sum(amt) as full_payouts from tbl_cash where rid=".$_GET['cid']."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); } ?>
				 
									   <div class="form-group">
                                            <label><span class="text-danger">*</span> Remain  Cash</label>
                                            <input type="text" class="form-control" value="<?php echo $pb;?>"  name="remain" required="" readonly>
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Received Cash</label>
                                            <input type="number" step="0.01" class="form-control" placeholder="Enter Received Cash"  name="rcash" required="">
											<input type="hidden" name="type" value="add_cash"/>
											<input type="hidden" name="store_id" value="<?php echo $_GET['cid'];?>"/>
                                         </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Message</label>
                                            <input type="text" class="form-control" placeholder="Enter Message"  name="message" required="" >
                                        </div>
										
                                     
										
										
										<div class="col-12">
                                                <button type="submit"  class="btn btn-primary mb-2">Add Cash Collection</button>
                                            </div>
                                    </form>
									</div>
							<?php
						}
						else if(isset($_GET['hid']))
						{
							?>
							 <div class="card-header">
                                <h4 class="card-title">Delivery Boy Cash Collection Log</h4>
                            </div>
                            <div class="card-body">
							
                                <div class="table-responsive">
                                    <table class="display mytable" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Store Name</th>
                                                
												 
												 <th>Received Cash</th>
												 <th>Message</th>
                                                <th>Received Date</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmts = $medi->query("SELECT * FROM `service_details` where id =".$_GET['hid']."")->fetch_assoc();
											 $stmt = $medi->query("SELECT * FROM `tbl_cash` where rid =".$_GET['hid']."");
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
                                                   <?php echo $stmts['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                  <?php echo $row['amt'].' '.$set['currency']; ?>
                                                </td>
                                                
                                               
				 <td class="align-middle">
                                                  <?php echo $row['message']; ?>
                                                </td>
												
												 <td class="align-middle">
                                                  <?php echo date("d M Y, h:i a", strtotime($row['pdate'])); ?>
                                                </td>
												
                                                </tr>
<?php } ?> 
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
							<?php 
						}
						else {
						?>
				<div class="card-body">
				<div class="table-responsive">
                 <table class="display mytable" id="basic-1">
                        <thead>
                          <tr>
											 <tr>
                                                <th>Sr No.</th>
												<th>Store Name</th>
                                                <th>Store Image</th>
												<th>Store Cover Image</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $medi->query("select * from service_details");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['title']; ?>
                                                </td>
                                                
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['rimg']; ?>" width="100" height="100" />
                                                </td>
												<td class="align-middle">
                                                   <img src="<?php echo $row['cover_img']; ?>" width="100" height="100"/>
                                                </td>
                                                
                                               
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge badge-success">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge badge-danger">Unpublish</span></td>
												<?php } ?>
                                                <td style="white-space: nowrap; width: 15%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                           <div class="btn-group btn-group-sm" style="float: none;">
										   <a href="add_store.php?id=<?php echo $row['id'];?>" class="tabledit-edit-button " style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#79F9B4"/><path d="M22.5168 9.34109L20.6589 7.48324C20.0011 6.83703 18.951 6.837 18.2933 7.49476L16.7355 9.06416L20.9359 13.2645L22.5052 11.7067C23.163 11.0489 23.163 9.99885 22.5168 9.34109ZM15.5123 10.2873L8 17.8342V22H12.1658L19.7127 14.4877L15.5123 10.2873Z" fill="#25314C"/></svg>
<a href="?cid=<?php echo $row['id']; ?>"><button class="btn btn-primary">+ Received Cash</button></a>
<a href="?hid=<?php echo $row['id']; ?>"><button class="btn btn-danger">Cash Log</button></a>


</a>
										   
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