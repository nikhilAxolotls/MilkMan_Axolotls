<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $data['order_id'];
$store_id = $data['store_id'];
if ($id ==''  or $store_id == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
$check = $medi->query("select * from tbl_normal_order where id=".$id." and store_id=".$store_id." and o_type='Self Pickup'")->num_rows;
if($check != 0)
{	
$table = "tbl_normal_order";
                $field = [
                    "status" => 'Completed',
                    "order_status" => 7
                ];
                $where =
                    "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Completed Successfully!!!!!"); 
				
				$checks = $medi->query("select uid from tbl_normal_order where id=".$id."")->fetch_assoc(); 
				$uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your  Order #'.$id.' Has Been Completed.'
   );
$heading = array(
   "en" => "Order Completed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$id),
'filters' => array(array('field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$timestamp = date("Y-m-d H:i:s");

$title_main = "Order Completed!!";
$description = $name.', Your  Order #'.$id.' Has Been Completed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order Must Be Self Pickup!!");
}	
}
echo json_encode($returnArr);
?>