<?php 

require 'controller/mediconfig.php';

$pid = $_POST['pid'];
$c = $medi->query("select * from tbl_normal_order where id=".$pid."")->fetch_assoc();
$udata = $medi->query("select * from tbl_user where id=".$c['uid']."")->fetch_assoc();
$pdata = $medi->query("select * from tbl_payment_list where id=".$c['p_method_id']."")->fetch_assoc();
?>
<div class="container invoice" id="divprint">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="">                            
                    <div>
                      <div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="d-flex">
                              <div class="flex-grow-1">
                                <h3>Shipping & Billing Details</h3>
                                <p class="mb-0">Mobile Number: <?php echo $c['mobile'];?><br><span class="digits">Customer Name: <?php echo $udata['name'];?></span>
<br><span class="digits">Address:<?php echo $c['address'];?><br><span class="digits">Addional Note: <?php echo $c['a_note'];?></span>
                                </p>
                              </div>
                            </div>
                            <!-- End Info-->
                          </div>
                          <div class="col-sm-6">
                            <div class="text-md-end text-xs-center">
                              <h3>Invoice #<span class="digits counter"><?php echo $pid;?></span></h3>
                                <?php 
$date=date_create($c['odate']);
$order_date =  date_format($date,"d-m-Y").'( '.$c['tslot'].' )';
?>
                              <p class="mb-0">Shipped date:<span class="digits"> <?php echo $order_date;?></span><br>Order Status: <span class="digits"> <?php echo $c['status'];?></span><br>Transaction Id: <span class="digits">  <?php echo $c['trans_id'];?></span></p>
                            </div>
                            <!-- End Title                                 -->
                          </div>
                        </div>
                      </div>
                      
                      <div>
                        <div class="table-responsive invoice-table" id="table">
                          <table class="table table-bordered table-striped">
                            <tbody>
                               <!-- Single Items -->
                 
                              <tr>
                                <td class="item">
                                  <h4 class="p-2 mb-0">Item Image</h4>
                                </td>
                                <td class="Hours">
                                  <h4 class="p-2 mb-0">Item Name</h4>
                                </td>
                                <td class="Rate">
                                  <h4 class="p-2 mb-0">Discount</h4>
                                </td>
                                <td class="subtotal">
                                  <h4 class="p-2 mb-0">Qty</h4>
                                </td>
                                <td class="subtotal">
                                  <h4 class="p-2 mb-0">Price</h4>
                                </td>
                              </tr>
                                 <?php 

$get_data = $medi->query("select * from tbl_normal_order_product where oid=".$pid."");
$op = 0;
while($row = $get_data->fetch_assoc())
{
  $op = $op + 1;
$discount = $row['pprice'] * $row['pdiscount']*$row['pquantity'] /100;
  ?>
                              <tr>
                                <td>
                                  <img class="d-flex-object img-60" src="<?php echo $row['pimg'];?>" alt="">
                                </td>
                                <td>
                                  <p class="itemtext digits"><?php echo $op;?>) <?php echo $row['ptitle'].' ( '.$row['ptype'].' )';?></p>
                                </td>
                                <td>
                                  <p class="itemtext digits"><?php echo $row['pdiscount'].' %';?></p>
                                </td>
                                <td>
                                  <p class="itemtext digits"><?php echo $row['pquantity'];?> x <?php echo $row['pprice'].' '.$set['currency'];?></p>
                                </td>
                                <td>
                                  <p class="itemtext digits"><?php echo ($row['pprice'] * $row['pquantity']) - $discount.' '.$set['currency'];?></p>
                                </td>
                                
                              </tr>
                               <?php       
} ?>
                              
                            </tbody>
                          </table>
                        </div>
                        <!-- End Table-->
                        <div class="row mt-3">
                          <div class="col-md-8">
                            <div class="">
                               <span>Subtotal:</span>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-end invo-pal">
                               <span class="ml-auto float-right"><?php echo $c['subtotal'].' '.$set['currency'];?></span>
                            </div>
                          </div>
                        </div>
                         <?php 
  if($c['cou_amt'] != 0)
  {
  ?>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="">
                               <span>Coupon Code:</span>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-end invo-pal">
                               <span class="ml-auto float-right"><?php echo $c['cou_amt'].' '.$set['currency'];?></span>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                         <div class="row">
                          <div class="col-md-8">
                            <div class="">
                               <span>Delivery Charge:</span>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-end invo-pal">
                               <span class="ml-auto float-right"><?php echo $c['d_charge'].' '.$set['currency'];?></span>
                            </div>
                          </div>
                        </div>

           <?php 
  if($c['wall_amt'] != 0)
  {
  ?>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="">
                               <span>Wallet:</span>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-end invo-pal">
                               <span class="ml-auto float-right"><?php echo $c['wall_amt'].' '.$set['currency'];?></span>
                            </div>
                          </div>
                        </div>
                         <?php } ?>
                         <div class="row">
                          <div class="col-md-8">
                            <div class="">
                               <span><strong>Net Amount:</strong></span>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-end invo-pal">
                               <span class="ml-auto float-right "><strong><?php echo $c['o_total'].' '.$set['currency'];?></strong></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- End InvoiceBot-->
                    </div>
                  </span>
                   
                    <!-- End Invoice-->
                    <!-- End Invoice Holder-->
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="col-sm-12 text-center mt-3">
                      <a class="btn btn btn-primary me-2" onclick='downloadimage();'>Take Picture</a>
                    </div>
  
            
            
              
