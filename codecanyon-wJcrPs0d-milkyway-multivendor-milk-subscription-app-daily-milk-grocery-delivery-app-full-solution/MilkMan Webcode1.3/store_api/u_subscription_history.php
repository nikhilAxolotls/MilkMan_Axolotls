<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['store_id'] == '' or $data['status'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$store_id =  $medi->real_escape_string($data['store_id']);
	$status = $data['status'];
	if($status == 'Current')
	{
		
  $sel = $medi->query("select * from tbl_subscribe_order where store_id=".$store_id."  and status !='Completed' and status!='Cancelled' order by id desc "); 
	}
	else 
	{
		$sel = $medi->query("select * from tbl_subscribe_order where store_id=".$store_id."  and (status ='Completed' or status='Cancelled') order by id desc "); 
	}
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $g['id'] = $row['id'];
	  $g['total_product'] = $medi->query("select * from tbl_subscribe_order_product where oid=".$row['id']."")->num_rows;
	  $grid = $medi->query("select * from tbl_rider where id=".$row['rid']."")->fetch_assoc();
	  if($row['rid'] == 0)
	  {
		  $ridername = 'Not Assigned';
	  }
  else 
  {
	  $ridername = $grid['title'];
  }
	  $g['Delivery_name'] = $ridername;
	  $g['customer_name'] = $row['name'];
	  $g['customer_mobile'] = $row['mobile'];
      $g['customer_address'] = $row['address'];
      $g['status'] = $row['status'];
	  $g['flow_id'] = $row['order_status'];
	  $g['date'] = $row['odate'];
	  $g['total'] = $row['o_total'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subscribe Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("OrderHistory"=>[],"ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>