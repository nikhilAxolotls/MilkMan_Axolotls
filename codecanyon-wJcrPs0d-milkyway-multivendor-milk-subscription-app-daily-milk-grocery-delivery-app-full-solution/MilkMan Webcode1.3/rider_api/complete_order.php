<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
$oid = $data['order_id'];
$rider_id = $data['rider_id'];
if ($oid ==''  or $rider_id == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
$check = $medi->query("select * from tbl_normal_order where id=".$oid." and rid=".$rider_id." and o_type='Delivery'")->num_rows;
if($check != 0)
{	
$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$path = 'images/sign/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;

file_put_contents($fname, $data);

$table = "tbl_normal_order";
                $field = [
                    "status" => 'Completed',
                    "order_status" => 7,
					"sign"=>$path
                ];
                $where =
                    "where id=" . $oid . " and rid=".$rider_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Completed Successfully!!!!!"); 
				
				$checks = $medi->query("select uid,store_id from tbl_normal_order where id=".$oid."")->fetch_assoc(); 
				$uid = $checks['uid'];
				$store_id = $checks['store_id'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your  Order #'.$oid.' Has Been Completed.'
   );
$heading = array(
   "en" => "Order Completed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/eatggy/order_process_img/confirmed.png'
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
$description = $name.', Your  Order #'.$oid.' Has Been Completed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
	   
	   $content = array(
       "en" => 'Order #'.$oid.' Has Been Completed.'
   );
$heading = array(
   "en" => 'Order Completed!!'
);

$fields = array(
'app_id' => $set['s_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'store_id', 'relation' => '=', 'value' => $checks['store_id'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['s_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

	   $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Completed!!";
$description = 'Order #'.$oid.' Has Been Completed.';

$table="tbl_snoti";
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order Must Be Delivery!!");
}	
}
echo json_encode($returnArr);
?>