<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json'); 

$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$rid = $data['rid'];

if ($oid =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	
	$table="tbl_normal_order";
  $field = array('rid'=>$rid,'order_status'=>3);
  $where = "where id=".$oid."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);

	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rider Assigned Successfully!!!!!");

$content = array(
"en" => 'You have an order assigned to you.'//mesaj burasi
);
$fields = array(
'app_id' => $set['d_key'],
'included_segments' =>  array("Active Users"),
'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
'contents' => $content
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['d_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);



	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order #".$oid." Assigned!!";

$table="tbl_rnoti";
  $field_values=array("rid","date","msg");
  $data_values=array("$rid","$timestamp","$title_main");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
						
}
echo  json_encode($returnArr);
?>