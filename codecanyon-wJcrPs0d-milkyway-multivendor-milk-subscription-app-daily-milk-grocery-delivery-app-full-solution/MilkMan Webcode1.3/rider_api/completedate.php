<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');



function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

$order_id = $data['order_id'];
$select_date = $data['select_date'];
$product_id = $data['product_id'];
$timestamp = date("Y-m-d");
if ($order_id =='' or $select_date =='' or $product_id == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$jpro = $medi->query("select * from tbl_subscribe_order_product where oid=".$order_id." and id=".$product_id."")->fetch_assoc();
		$in = explode(',',$jpro['completedates']);
		$checkdate = explode(',',$jpro['totaldates']);
		
		if (in_array($select_date,$in))
				 {
				$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Already Completed Selected Date!!!!!");	 
				 }
				 else if(!in_array($select_date,$checkdate))
				 {
					$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Date Not Present On Subscription Date!!!!!"); 
				 }
				 else if($timestamp >= $select_date)
				 {
					$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Please Select Only date which is equal or below of today date!!!!!");  
				 }
				 else 
				 {
					 if($jpro['completedates'] == '')
					 {
						 $completedate = $select_date;
					 }
					 else 
					 {
					 $completedate = $jpro['completedates'].','.$select_date;
					 }
					 
					  $table="tbl_subscribe_order_product";
  $field = array('completedates'=>$completedate,'oid'=>$order_id);
  $where = "where id=".$product_id."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);			
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Date Completed Successfully!!!!!"); 	  
				 }
}
echo json_encode($returnArr);
?>