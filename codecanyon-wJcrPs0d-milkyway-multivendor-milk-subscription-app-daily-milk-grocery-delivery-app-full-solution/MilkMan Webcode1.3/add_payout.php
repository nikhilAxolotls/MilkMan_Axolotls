<?php 
include 'controller/header.php';
if($_SESSION['stype'] == 'mowner')
	{
		header('HTTP/1.1 401 Unauthorized');
    
    
	?>
	<style>
	.loader-wrapper
	{
		display:none;
	}
	</style>
	<?php 
	exit('You are not authorized'); 
	}
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
                  <h3>Payout Management</h3>
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
				<div class="row">
						<div class="col-md-4">
			<div class="media-body text-center" style="background:#5c61f2;padding:10px;color:#fff;border-radius:5px;">
                <h6 style="color:#fff;"><?php
                $store_id = $sdata['id'];
                	$total_earn = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_normal_order where store_id=".$store_id." and status='Completed'")->fetch_assoc();
	$earn = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
	
	
	$total_earn_pre = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_subscribe_order where store_id=".$store_id." and status='Completed'")->fetch_assoc();
	$earn_pre = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	
	$total_payout = $medi->query("select sum(amt) as total_payout from payout_setting where owner_id=".$store_id."")->fetch_assoc();
	$payout = empty($total_payout['total_payout']) ? "0" : $total_payout['total_payout'];
	
	
echo	(floatval($earn)+floatval($earn_pre)) - floatval($payout).' '.$set['currency'];
	
                ?></h6>
                <span>Wallet Balance</span>
              </div>
			  </div>
			  <div class="col-md-4">
			  </div>
			  <div class="col-md-4">
			<div class="media-body text-center" style="background:#5c61f2;padding:10px;color:#fff;border-radius:5px;">
                <h6 class="mb-1" style="color:#fff;"><?php echo $set['pstore'].' '.$set['currency'];?></h6>
                <span>Wallet Min Balance For Withdraw</span>
              </div>
			  </div>
			  </div>
				<br>		 
		<form method="post" enctype="multipart/form-data">
				
                                       <div class="form-group mb-3">
                                            <label>Amount</label>
                                            <input type="number" min="1" step="0.01"  class="form-control" placeholder="Enter Amount" name="amt" required="">
											<input type="hidden" name="type" value="add_payout"/>
										
                                        </div>
										 
                                        
										<div class="form-group mb-3">
                                            <label>Select Payout Type</label>
                                            <select name="r_type" id="r_type" class="form-control" required>
											<option value="" >Select Option</option>
											<option value="UPI" >UPI</option>
											<option value="BANK Transfer"  >BANK Transfer</option>
											<option value="Paypal"  >Paypal</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 div1">
                                            <label>Upi Address</label>
                                            <input type="text" class="form-control" id="upi_id" name="upi_id" placeholder="Enter Upi Address">
											
										
                                        </div>
										
										
										
										<div class="form-group mb-3 div2">
                                            <label>Paypal Id</label>
                                            <input type="text"   class="form-control" id="paypal_id" name="paypal_id" placeholder="Enter Paypal Id">
											
										
                                        </div>
										
										<div class="form-group mb-3 div3">
                                            <label>Account Number</label>
                                            <input type="text"   class="form-control" id="acc_number" name="acc_number" placeholder="Enter Account Number">
											
										
                                        </div>
										
										<div class="form-group mb-3 div4">
                                            <label>Bank Name</label>
                                            <input type="text"   class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
											
										
                                        </div>
										
										<div class="form-group mb-3 div5">
                                            <label>Account Holder Name</label>
                                            <input type="text"   class="form-control" id="acc_name" name="acc_name" placeholder="Enter Account Holder Name">
											
										
                                        </div>
										
										<div class="form-group mb-3 div6">
                                            <label>IFSC Code</label>
                                            <input type="text"   class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code">
											
										
                                        </div>
										
										
										
										
	
										
										<div class="form-group mb-3">
                                                <button type="submit" class="btn btn-primary mb-2">Request Payout</button>
                                            </div>
											</div>
                                    </form> 
								
				</div>
                </div>
            
           
            
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
                                               
                                    <th>Amount</th>
                                   
									
									<th>Transfer Details</th>
                                    <th>Transfer Type</th>
									
									<th>Transfer Photo</th>
									
									 <th>Status</th>

                                                </tr>
                                            </thead>
                                        <tbody>
                                            <?php 
											 $stmt = $medi->query("SELECT * FROM `payout_setting` where owner_id=".$sdata["id"]."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                               
                                    <td><?php echo $row['amt'].' '.$set['currency'];?></td>
									
									<?php 
									if($row['r_type'] == 'UPI')
									{
									  ?>
									  <td>TEST</td>
									  <?php 
									}
									else if($row['r_type'] == 'BANK Transfer')
									{
									 ?>
									 <td>TEST</td>
									 <?php 
									}
									else 
									{
									   ?>
									   <td><?php echo $row['paypal_id'];?></td>
									   <?php 
									}
									?>
									
									<td><?php echo $row['r_type'];?></td>
									 
									 <?php
									 if($row['proof'] == '')
									 {
										 ?>
										 <td></td>
										 <?php
									 }else {
									     ?>
									 
									  <td><img src="<?php echo $row['proof']; ?>" width="70" height="80"/></td>
									  <?php } ?>
									 <td><span class="badge badge-success"><?php echo ucfirst($row['status']);?></span></td>
                                     
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
    <!-- latest jquery-->
     <?php 
		include 'controller/pharma.php';
		?>
    <script>
	$("#upi_id").hide();
	$("#paypal_id").hide();
	$("#acc_number").hide();
	$("#bank_name").hide();
	$("#acc_name").hide();
	$("#ifsc_code").hide();
	$(".div1").hide();
	$(".div2").hide();
	$(".div3").hide();
	$(".div4").hide();
	$(".div5").hide();
	$(".div6").hide();
	
	$(document).on('change','#r_type',function(e) {
	var val = $(this).val();
	if(val == '')
	{
	$("#upi_id").hide();
	$("#paypal_id").hide();
	$("#acc_number").hide();
	$("#bank_name").hide();
	$("#acc_name").hide();
	$("#ifsc_code").hide();
	$(".div1").hide();
	$(".div2").hide();
	$(".div3").hide();
	$(".div4").hide();
	$(".div5").hide();
	$(".div6").hide();
	}
	else if(val == 'UPI')
	{
	$("#upi_id").show();
	$("#paypal_id").hide();
	$("#acc_number").hide();
	$("#bank_name").hide();
	$("#acc_name").hide();
	$("#ifsc_code").hide();
	$(".div1").show();
	$(".div2").hide();
	$(".div3").hide();
	$(".div4").hide();
	$(".div5").hide();
	$(".div6").hide();
	
	$('#upi_id').attr('required', 'required');
	$("#paypal_id").removeAttr("required");
	$("#acc_number").removeAttr("required");
	$("#bank_name").removeAttr("required");
	$("#acc_name").removeAttr("required");
	$("#ifsc_code").removeAttr("required");
	}
	else if(val == 'Paypal')
	{
	$("#upi_id").hide();
	$("#paypal_id").show();
	$("#acc_number").hide();
	$("#bank_name").hide();
	$("#acc_name").hide();
	$("#ifsc_code").hide();
	$(".div1").hide();
	$(".div2").show();
	$(".div3").hide();
	$(".div4").hide();
	$(".div5").hide();
	$(".div6").hide();
	
	$('#paypal_id').attr('required', 'required');
	$("#upi_id").removeAttr("required");
	$("#acc_number").removeAttr("required");
	$("#bank_name").removeAttr("required");
	$("#acc_name").removeAttr("required");
	$("#ifsc_code").removeAttr("required");
	}
	else 
	{
	$("#upi_id").hide();
	$("#paypal_id").hide();
	$("#acc_number").show();
	$("#bank_name").show();
	$("#acc_name").show();
	$("#ifsc_code").show();
	$(".div1").hide();
	$(".div2").hide();
	$(".div3").show();
	$(".div4").show();
	$(".div5").show();
	$(".div6").show();	
	$('#acc_number').attr('required', 'required');
	$('#bank_name').attr('required', 'required');
	$('#acc_name').attr('required', 'required');
	$('#ifsc_code').attr('required', 'required');
	$("#upi_id").removeAttr("required");
	$("#paypal_id").removeAttr("required");
	}
	});
	</script>
  </body>


</html>