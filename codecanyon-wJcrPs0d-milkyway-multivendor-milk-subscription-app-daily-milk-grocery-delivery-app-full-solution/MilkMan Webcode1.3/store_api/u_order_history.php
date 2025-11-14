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

		$sel = $medi->query("select * from tbl_normal_order where store_id=".$store_id." and status !='Completed' and status!='Cancelled' order by id desc "); 
	}
	else 
	{
  $sel = $medi->query("select * from tbl_normal_order where store_id=".$store_id." and (status ='Completed' or status='Cancelled') order by id desc "); 
	}
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
	  $storedata = $medi->query("select name,mobile,ccode from tbl_user where id=".$row['uid']."")->fetch_assoc();
	  $grid = $medi->query("select * from tbl_rider where id=".$row['rid']."")->fetch_assoc();
	  if($row['rid'] == 0)
	  {
		  $ridername = 'Not Assigned';
	  }
  else 
  {
	  $ridername = $grid['title'];
  }
  
      $g['id'] = $row['id'];
      $g['Delivery_name'] = $ridername;
	  $g['customer_name'] = $storedata['name'];
	  $g['customer_mobile'] = $storedata['ccode'].$storedata['mobile'];
	  $g['customer_address'] = $row['address'];
      $g['status'] = $row['status'];
	  $g['flow_id'] = $row['order_status'];
	  $g['Order_Type'] = $row['o_type'];
	  $g['date'] = $row['odate'];
	  $g['total'] = $row['o_total'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("OrderHistory"=>[],"ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>