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
$oid = $data['oid'];
$status = $data['status'];
$comment_reject = $data['comment_reject'];
if ($oid =='' or $status =='' or $comment_reject == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
		
	$table="tbl_subscribe_order";
	if($status == 1)
	{
  $field = array('a_status'=>1,'order_status'=>1,'status'=>'Processing');
	}
	else 
	{
		 $field = array('a_status'=>2,'order_status'=>2,'status'=>'Cancelled','comment_reject'=>$comment_reject);
	} 
  $where = "where id=".$oid."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);
	  
	if($status == 1)
	  {
		   $checks = $medi->query("select uid from tbl_subscribe_order where id=".$oid."")->fetch_assoc(); 
		   $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Prescription Order #'.$oid.' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Prescription Order Confirmed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
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

$title_main = "Prescription Order Confirmed!!";
$description = $name.', Your Prescription Order #'.$oid.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
	   
	  }
	  else 
	  {
		 $checks = $medi->query("select uid from tbl_prescription where id=".$oid."")->fetch_assoc(); 
		 $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Prescription Order #'.$oid.' Has Been Rejected.'
   );
$heading = array(
   "en" => $comment_reject
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
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
$description = $name.', Your Prescription Order #'.$oid.' Has Been Rejected.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$comment_reject","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table); 
	  }
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
?>