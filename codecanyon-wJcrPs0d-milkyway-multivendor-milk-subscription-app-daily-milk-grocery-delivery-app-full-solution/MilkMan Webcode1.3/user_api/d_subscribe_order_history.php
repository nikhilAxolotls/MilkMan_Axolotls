<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid =  $medi->real_escape_string($data['uid']);
	$status = $data['status'];
	if($status == 'Current')
	{
		
  $sel = $medi->query("select * from tbl_subscribe_order where uid=".$uid."  and status !='Completed' and status!='Cancelled' order by id desc "); 
	}
	else 
	{
		$sel = $medi->query("select * from tbl_subscribe_order where uid=".$uid."  and (status ='Completed' or status='Cancelled') order by id desc "); 
	}
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $g['id'] = $row['id'];
	  $g['total_product'] = $medi->query("select * from tbl_subscribe_order_product where oid=".$row['id']."")->num_rows;
	  $storedata = $medi->query("select title,rimg,rate,full_address from service_details where id=".$row['store_id']."")->fetch_assoc();
	  $grid = $medi->query("select * from tbl_rider where id=".$row['rid']."")->fetch_assoc();
	  if($row['rid'] == 0)
	  {
		  $ridername = 'Not Assigned';
	  }
  else 
  {
	  $ridername = 'Assigned';
  }
	  $g['Delivery_name'] = $ridername;
	  $g['store_title'] = $storedata['title'];
	  $g['store_img'] = $storedata['rimg'];
	  $g['store_address'] = $storedata['full_address'];
	  $g['store_rate'] = $storedata['rate'];
      $g['status'] = $row['status'];
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