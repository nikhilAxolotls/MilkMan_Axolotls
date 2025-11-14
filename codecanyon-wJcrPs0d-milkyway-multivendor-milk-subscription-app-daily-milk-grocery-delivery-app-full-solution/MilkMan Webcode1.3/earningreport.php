<?php 
include 'controller/header.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
                  <h3>Earning Report Management</h3>
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
                                                <th>Sr No.</th>
												
                                                <th>Store<br> Name</th>
                                               
                                                
                                                <th>Sale <br> Count</th>
                                                <th>Total <br>Amount</th>
												<th>CashAmt <br>Hand </th>
												<th>Delivery <br>Charge</th>
												
												<th>Your <br>Earning</th>
												<th>Your <br>Payout</th>
                                                <th>Store <br>Remain<br> Amount</th>
												<th>Store <br>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
										   $restro = $medi->query("select * from service_details");
										   $i=0;
										   
										   while($row = $restro->fetch_assoc())
										   {					
$i = $i + 1;									   
										   ?>
										   <tr>
										   <td><?php echo $i; ?> </td>
										   <td class="align-middle" style="max-width:80px;">
                                                   <?php echo $row['title']; ?>
                                                </td>
												
												<td class="align-middle" style="max-width:80px;">
                                                   <?php echo $medi->query("SELECT *  FROM tbl_normal_order where store_id=".$row['id']." and status='Completed'")->num_rows + $medi->query("SELECT *  FROM tbl_subscribe_order where store_id=".$row['id']." and status='Completed'")->num_rows; ?>
                                                </td>
												
                                               
												<td><?php $total_earn = $medi->query("select sum(subtotal-cou_amt+d_charge) as total_amt from tbl_normal_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
						$earns = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
						
	
	$total_earn_pre = $medi->query("select sum(subtotal-cou_amt+d_charge) as total_amt from tbl_subscribe_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
	$earn_pres = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	echo $finalearns = (floatval($earns)+floatval($earn_pres)).' '.$set['currency'];
															?>
															</td>
															<td>
															<?php $sales  = $medi->query("select sum(subtotal-cou_amt+d_charge) as full_total from tbl_normal_order where status='completed'  and p_method_id=5 and  store_id=".$row['id']."")->fetch_assoc();
             $payout =   $medi->query("select sum(amt) as full_payouts from tbl_cash where rid=".$row['id']."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); }
echo $pb.$set['currency'];
				 ?>
															</td>
												<td><?php $total_earn = $medi->query("select sum(d_charge) as total_amt from tbl_normal_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
						$earns = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
						
	
	$total_earn_pre = $medi->query("select sum(d_charge) as total_amt from tbl_subscribe_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
	$earn_pres = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	echo $finalearns = (floatval($earns)+floatval($earn_pres)).' '.$set['currency'];
												?></td>
												
												<td><?php $total_earn = $medi->query("select sum((subtotal-cou_amt+d_charge) * commission/100) as total_amt from tbl_normal_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
						$earns = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
						
	
	$total_earn_pre = $medi->query("select sum((subtotal-cou_amt+d_charge) * commission/100) as total_amt from tbl_subscribe_order where  status='Completed' and store_id=".$row['id']."")->fetch_assoc();
	$earn_pres = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	echo $finalearns = (floatval($earns)+floatval($earn_pres)).' '.$set['currency'];
	
	?></td>
												<td><?php $sales  = $medi->query("select sum(amt) as full_payout from payout_setting where owner_id=".$row['id']."")->fetch_assoc(); if($sales['full_payout'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_payout']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php
$total_earn = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_normal_order where store_id=".$row['id']." and status='Completed'")->fetch_assoc();												
												$earn = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
	
	
	$total_earn_pre = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_subscribe_order where store_id=".$row['id']." and status='Completed'")->fetch_assoc();
	$earn_pre = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	
	$total_payout = $medi->query("select sum(amt) as total_payout from payout_setting where owner_id=".$row['id']."")->fetch_assoc();
	$payout = empty($total_payout['total_payout']) ? "0" : $total_payout['total_payout'];
	
	
	echo $finalearn = (floatval($earn)+floatval($earn_pre)) - floatval($payout).' '.$set['currency'];
	?></td>
				 <td>
				 <?php 
										$checkrate = $medi->query("SELECT *  FROM tbl_normal_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->num_rows;
	$checkprate = $medi->query("SELECT *  FROM tbl_subscribe_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->num_rows;
	if($checkrate != 0 and $checkprate == 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		echo '<i class="fa fa-star"></i> '.number_format((float)$rdata_rest['rate_rest'], 2, '.', '').'( '.$checkrate.' rating )';
	}
	else if($checkrate == 0 and $checkprate != 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		echo '<i class="fa fa-star"></i> '.number_format((float)$rdata_rest['rate_rests'], 2, '.', '').'( '.$checkprate.' rating )';
	}
	else if($checkrate != 0 and $checkprate != 0)
	{
		
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$rdata_rests = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$row['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		echo '<i class="fa fa-star"></i> '.number_format((float)(($rdata_rest['rate_rest'] + $rdata_rests['rate_rests'])/2) , 2, '.', '').'( '.$checkrate + $checkprate.' rating )';
	}
	else 
	{
	echo '<i class="fa fa-star"></i> '.$row['rate'].'( 0 rating )';
	}
		?>
				 </td>
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