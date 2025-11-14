<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == ''   or $data['total_rate']==''  or $data['rate_text'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$order_id = $data['order_id'];
	$total_rate = $data['total_rate'];
	$rate_text = $medi->real_escape_string($data['rate_text']);
	$timestamp    = date("Y-m-d");
	$table="tbl_subscribe_order";
  $field = array('total_rate'=>$total_rate,'rate_text'=>$rate_text,'is_rate'=>"1",'review_date'=>$timestamp);
  $where = "where uid=".$uid." and id=".$order_id."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rate Updated Successfully!!!");
}
echo json_encode($returnArr);