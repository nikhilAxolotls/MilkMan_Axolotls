<?php
require "mediconfig.php";
require "medico.php";
require dirname(dirname(__FILE__)) . "/vendor/autoload.php";
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
if (isset($_POST["type"])) {
    if ($_POST["type"] == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stype = $_POST["stype"];
        if ($stype == "mowner") {
            $h = new Medico();

            $count = $h->medilogin($username, $password, "admin");
            if ($count != 0) {
                $_SESSION["mediname"] = $username;
                $_SESSION["stype"] = $stype;
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Login Successfully!",
                    "message" => "welcome admin!!",
                    "action" => "dashboard.php",
                ];
            } else {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Please Use Valid Data!!",
                    "message" => "Invalid Data!!",
                    "action" => "index.php",
                ];
            }
        } else {
            $h = new Medico();

            $count = $h->medilogin($username, $password, "service_details");
            if ($count != 0) {
                $_SESSION["mediname"] = $username;
                $_SESSION["stype"] = $stype;
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Login Successfully!",
                    "message" => "welcome Store Owner!!",
                    "action" => "dashboard.php",
                ];
            } else {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Please Use Valid Data!!",
                    "message" => "Invalid Data!!",
                    "action" => "index.php",
                ];
            }
        }
    } elseif ($_POST["type"] == "update_status") {
        $id = $_POST["id"];
        $status = $_POST["status"];
        $coll_type = $_POST["coll_type"];
        $page_name = $_POST["page_name"];
        if ($coll_type == "shopstatus") {
            $table = "service_details";
            $field = "rstatus=" . $status . "";
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData_single($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Shop Status Change Successfully!!",
                    "message" => "Shop section!",
                    "action" => "dashboard.php",
                ];
            } 
		elseif ($coll_type == "orderapprove") {
            
			$table = "tbl_normal_order";
                $field = [
                    "a_status" => $status,
                    "order_status" => 1,
					"status"=>'Processing'
                ];
                $where =
                    "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				
				$checks = $medi->query("select uid from tbl_normal_order where id=".$id."")->fetch_assoc(); 
		   $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Order #'.$id.' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
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

$title_main = "Order Confirmed!!";
$description = $name.', Your Order #'.$id.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
				
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Order Approved Successfully!!",
                    "message" => "Order section!",
                    "action" => "pending.php",
                ];
            } 
        }elseif ($coll_type == "ordercomplete") {
            
			$table = "tbl_normal_order";
                $field = [
                    "status" => 'Completed',
                    "order_status" => $status
                ];
                $where =
                    "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				
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
	   
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Order Completed Successfully!!",
                    "message" => "Order section!",
                    "action" => "pending.php",
                ];
            } 
        }
		elseif ($coll_type == "porderapprove") {
            
			$table = "tbl_subscribe_order";
                $field = [
                    "a_status" => $status,
                    "order_status" => 1,
					"status"=>'Processing'
                ];
                $where =
                    "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				
				$checks = $medi->query("select uid from tbl_subscribe_order where id=".$id."")->fetch_assoc(); 
		   $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Subscription Order #'.$id.' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Subscription Order Confirmed!!"
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

$title_main = "Subscription Order Confirmed!!";
$description = $name.', Your Subscription Order #'.$id.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
				
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Order Approved Successfully!!",
                    "message" => "Order section!",
                    "action" => "pporder.php",
                ];
            } 
        }elseif ($coll_type == "pordercomplete") {
            
			$table = "tbl_subscribe_order";
                $field = [
                    "status" => 'Completed',
                    "order_status" => $status
                ];
                $where =
                    "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
				
				$checks = $medi->query("select uid from tbl_subscribe_order where id=".$id."")->fetch_assoc(); 
				$uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Subscription Order #'.$id.' Has Been Completed.'
   );
$heading = array(
   "en" => "Subscription Order Completed!!"
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

$title_main = "Subscription Order Completed!!";
$description = $name.', Your Subscription Order #'.$id.' Has Been Completed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
				
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Order Completed Successfully!!",
                    "message" => "Order section!",
                    "action" => "pporder.php",
                ];
            } 
        }
		elseif ($coll_type == "userstatus") {
            $table = "tbl_user";
            $field = "status=" . $status . "";
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData_single($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "User Status Change Successfully!!",
                    "message" => "User section!",
                    "action" => "userlist.php",
                ];
            } 
        } elseif ($coll_type == "dark_mode") {
            $table = "tbl_setting";
            $field = "show_dark=" . $status . "";
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData_single($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Dark Mode Status Change Successfully!!",
                    "message" => "Dark Mode section!",
                    "action" => $page_name,
                ];
            } 
        }  else {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Option Not There!!",
                "message" => "Error!!",
                "action" => "dashboard.php",
            ];
        }
    } elseif ($_POST["type"] == "add_timeslot") {
        $cat_id = $_POST["category"];

        $day_type = $_POST["dthing"];
        $total_days = $_POST["day"];
        $timeslot = implode(",", $_POST["timsloat"]);
        $vendor_id = $sdata["id"];
        $table = "tbl_timeslot";
        $check_exist = $medi->query(
            "select * from tbl_timeslot where cat_id=" .
                $cat_id .
                " and vendor_id=" .
                $vendor_id .
                ""
        )->num_rows;
        if ($check_exist != 0) {
            $returnArr = [
                "ResponseCode" => "401",
                "Result" => "false",
                "title" => "Timeslot Already Added In Category!",
                "message" => "Timeslot section!",
                "action" => "list_Timeslot.php",
            ];
        } else {
            $field_values = [
                "cat_id",
                "vendor_id",
                "day_type",
                "total_days",
                "timeslot",
            ];
            $data_values = [
                "$cat_id",
                "$vendor_id",
                "$day_type",
                "$total_days",
                "$timeslot",
            ];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Timeslot Add Successfully!!",
                    "message" => "Timeslot section!",
                    "action" => "list_Timeslot.php",
                ];
            } 
        }
    }elseif($_POST["type"] =="assign_rider")
	{
		$rid = $_POST['srider'];
		$id = $_POST["id"];
		$check = $medi->query("select order_status from tbl_normal_order where id=".$id."")->fetch_assoc();
		if($check['order_status'] != 4)
						{
						$table="tbl_normal_order";
  $field = array('rid'=>$rid,'order_status'=>3);
  $where = "where id=".$id."";
$h = new Medico();
	  $check = $h->mediupdateData($field,$table,$where);
	  if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Rider  Assign Successfully!!",
                        "message" => "Rider section!",
                        "action" => "pending.php",
                    ];
                } 
						}
						else 
						{
							$returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "false",
                        "title" =>
                            "Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy!!",
                        "message" => "Rider Section!!",
                        "action" => "pending.php",
                    ];
						}
	}elseif($_POST["type"] =="passign_rider")
	{
		$rid = $_POST['srider'];
		$id = $_POST["id"];
		$check = $medi->query("select order_status from tbl_subscribe_order where id=".$id."")->fetch_assoc();
		if($check['order_status'] != 4)
						{
						$table="tbl_subscribe_order";
  $field = array('rid'=>$rid,'order_status'=>3);
  $where = "where id=".$id."";
$h = new Medico();
	  $check = $h->mediupdateData($field,$table,$where);
	  if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Rider  Assign Successfully!!",
                        "message" => "Rider section!",
                        "action" => "pporder.php",
                    ];
                } 
						}
						else 
						{
							$returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "false",
                        "title" =>
                            "Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy!!",
                        "message" => "Rider Section!!",
                        "action" => "pporder.php",
                    ];
						}
	}elseif($_POST["type"] =="cancle_order")
	{
		$c_reason = $medi->real_escape_string($_POST['c_reason']);
		$id = $_POST["id"];
		
						$table="tbl_normal_order";
  $field = array('comment_reject'=>$c_reason,'order_status'=>2,'a_status'=>2,'status'=>'Cancelled');
  $where = "where id=".$id."";
$h = new Medico();
	  $check = $h->mediupdateData($field,$table,$where);
	  
	  $checks = $medi->query("select uid from tbl_normal_order where id=".$id."")->fetch_assoc(); 
		 $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Order #'.$id.' Has Been Rejected.'
   );
$heading = array(
   "en" => $comment_reject
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$id),
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
$description = $name.', Your Order #'.$id.' Has Been Rejected.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$comment_reject","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table); 
	   
	   
	  if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Order Cancelled Successfully!!",
                        "message" => "Order section!",
                        "action" => "cancle.php",
                    ];
                } 
	}elseif($_POST["type"] =="pcancle_order")
	{
		$c_reason = $medi->real_escape_string($_POST['c_reason']);
		$id = $_POST["id"];
		
						$table="tbl_subscribe_order";
  $field = array('comment_reject'=>$c_reason,'order_status'=>2,'a_status'=>2,'status'=>'Cancelled');
  $where = "where id=".$id."";
$h = new Medico();
	  $check = $h->mediupdateData($field,$table,$where);
	  
	  $checks = $medi->query("select uid from tbl_subscribe_order where id=".$id."")->fetch_assoc(); 
		 $uid = $checks['uid'];
			$udata = $medi->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  
	   
$content = array(
       "en" => $name.', Your Prescription Order #'.$id.' Has Been Rejected.'
   );
$heading = array(
   "en" => $comment_reject
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$id),
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
$description = $name.', Your Prescription Order #'.$id.' Has Been Rejected.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$comment_reject","$description");
  
      $h = new Medico();
	   $h->mediinsertdata_Api($field_values,$data_values,$table);
	   
	   
	  if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Order Cancelled Successfully!!",
                        "message" => "Order section!",
                        "action" => "cporder.php",
                    ];
                } 
	}
	  elseif ($_POST["type"] == "add_banner") {
        $okey = $_POST["status"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "banner";
            $field_values = ["img", "status"];
            $data_values = ["$url", "$okey"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Banner Add Successfully!!",
                    "message" => "banner section!",
                    "action" => "list_banner.php",
                ];
            } 
        
    }elseif ($_POST["type"] == "add_rider") {
        $status = $_POST["status"];
		$title = $medi->real_escape_string($_POST['title']);
		$email = $_POST["email"];
		$ccode = $_POST["ccode"];
		$mobile = $_POST["mobile"];
		$store_id = $sdata["id"];
		$rdate  = date("Y-m-d");
		$password = $medi->real_escape_string($_POST['password']);
        $target_dir = dirname(dirname(__FILE__)) . "/images/rider/";
        $url = "images/rider/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
		$check_details = $medi->query(
            "select email from tbl_rider where email='" . $email . "'"
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Rider Email Already Used!!",
                "message" => "Rider section!",
                "action" => "add_rider.php",
            ];
        } else {
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_rider";
            $field_values = ["img", "status","title","email","ccode","mobile","store_id","rdate","password"];
            $data_values = ["$url", "$status","$title","$email","$ccode","$mobile","$store_id","$rdate","$password"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Rider Add Successfully!!",
                    "message" => "Rider section!",
                    "action" => "list_rider.php",
                ];
            } 
        
		}
    }elseif ($_POST["type"] == "edit_rider") {
        $status = $_POST["status"];
		$title = $medi->real_escape_string($_POST['title']);
		$email = $_POST["email"];
		$ccode = $_POST["ccode"];
		$mobile = $_POST["mobile"];
		$store_id = $sdata["id"];
		$id = $_POST["id"];
		$password = $medi->real_escape_string($_POST['password']);
        $target_dir = dirname(dirname(__FILE__)) . "/images/rider/";
        $url = "images/rider/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
		$check_details = $medi->query(
            "select email from tbl_rider where email='" .
                $email .
                "' and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Rider Email Already Used!!",
                "message" => "Rider section!",
                "action" => "add_rider.php?id=" . $id . "",
            ];
        } else {
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_rider";
                $field = ["status" => $status, "img" => $url,"title"=>$title,"email"=>$email,"ccode"=>$ccode,"mobile"=>$mobile,"password"=>$password];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Rider Update Successfully!!",
                        "message" => "Rider section!",
                        "action" => "list_rider.php",
                    ];
                } 
            
    } else {
            $table = "tbl_rider";
                $field = ["status" => $status,"title"=>$title,"email"=>$email,"ccode"=>$ccode,"mobile"=>$mobile,"password"=>$password];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Rider Update Successfully!!",
                    "message" => "Rider section!",
                    "action" => "list_rider.php",
                ];
            } 
        }
		}
	}elseif ($_POST["type"] == "add_gallery") {
        $okey = $_POST["status"];
		$store_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/gallery/";
        $url = "images/gallery/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_photo";
            $field_values = ["img", "status","store_id"];
            $data_values = ["$url", "$okey","$store_id"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Photo Add Successfully!!",
                    "message" => "Photo section!",
                    "action" => "list_photo.php",
                ];
            } 
        
    }elseif ($_POST["type"] == "add_extra") {
        $okey = $_POST["status"];
		$store_id = $sdata["id"];
		$mid = $_POST["mid"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/product/";
        $url = "images/product/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = uniqid().round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_extra";
            $field_values = ["img", "status","store_id","mid"];
            $data_values = ["$url", "$okey","$store_id","$mid"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Extra Image Add Successfully!!",
                    "message" => "Extra Image section!",
                    "action" => "list_extra.php",
                ];
            } 
        
    }elseif ($_POST["type"] == "add_product") {
        $status = $_POST["status"];
	
		
		$cat_id = $_POST["cat_id"];
		$title = $medi->real_escape_string($_POST["title"]);
		$description = $medi->real_escape_string($_POST["description"]);
		$store_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/product/";
        $url = "images/product/";
        $temp = explode(".", $_FILES["product_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file);
            $table = "tbl_product";
            $field_values = ["img", "status","store_id","title","description","cat_id"];
            $data_values = ["$url", "$status","$store_id","$title","$description","$cat_id"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Product Add Successfully!!",
                    "message" => "Product section!",
                    "action" => "list_product.php",
                ];
            } 
        
    }
	elseif ($_POST["type"] == "edit_product") {
        $status = $_POST["status"];
		$id = $_POST["id"];
		
		
		$cat_id = $_POST["cat_id"];
		
		$title = $medi->real_escape_string($_POST["title"]);
		$description = $medi->real_escape_string($_POST["description"]);
		
		$store_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/product/";
        $url = "images/product/";
        $temp = explode(".", $_FILES["product_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
         if ($_FILES["product_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["product_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_product";
                $field = ["status" => $status, "img" => $url,"cat_id"=>$cat_id,"title"=>$title,"description"=>$description];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Product Update Successfully!!",
                        "message" => "Product section!",
                        "action" => "list_product.php",
                    ];
                } 
            
        } else {
            $table = "tbl_product";
                $field = ["status" => $status,"cat_id"=>$cat_id,"title"=>$title,"description"=>$description];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Product Update Successfully!!",
                    "message" => "Product section!",
                    "action" => "list_product.php",
                ];
            } 
        }
    } 
	elseif($_POST["type"] == "add_product_attr")
	{
		
		   $product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$sprice = $_POST['sprice'];
			$srequire = $_POST['srequire'];
			$mtype = stripslashes($medi->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$mstock = $_POST['mstock'];
			$store_id = $sdata["id"];
  $table="tbl_product_attribute";
  $field_values=array("product_id","normal_price","title","discount","out_of_stock","subscribe_price","subscription_required","store_id");
  $data_values=array("$product","$mprice","$mtype","$mdiscount","$mstock","$sprice","$srequire","$store_id");
  
  $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Product attributes Add Successfully!!",
                    "message" => "attributes section!",
                    "action" => "list_product_attr.php",
                ];
            } 
			
	}
	elseif($_POST["type"] == "edit_product_attr")
	{
		
		   $product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$sprice = $_POST['sprice'];
			$srequire = $_POST['srequire'];
			$mtype = stripslashes($medi->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$store_id = $sdata["id"];
			$mstock = $_POST['mstock'];
			$id = $_POST["id"];
  $table="tbl_product_attribute";
						
    $field=array('product_id'=>$product,'normal_price'=>$mprice,'title'=>$mtype,'discount'=>$mdiscount,'out_of_stock'=>$mstock,'subscribe_price'=>$sprice,'subscription_required'=>$srequire);
  
  $where = "where id=".$id." and store_id=".$store_id."";
  
  $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Product attributes Update Successfully!!",
                    "message" => "attributes section!",
                    "action" => "list_product_attr.php",
                ];
            } 
			
	}
	elseif($_POST["type"] == "add_delivery")
	{
		$dname = mysqli_real_escape_string($medi,$_POST['cname']);
			$ddigit = $_POST['ddigit'];
			$okey = $_POST['status'];
			$store_id = $sdata["id"];
		


  $table="tbl_delivery";
  $field_values=array("title","de_digit","status","store_id");
  $data_values=array("$dname","$ddigit","$okey","$store_id");
  
  $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Deliveries Add Successfully!!",
                    "message" => "Deliveries section!",
                    "action" => "list_delivery.php",
                ];
            } 
			
	}
	elseif($_POST["type"] == "edit_delivery")
	{
		$dname = mysqli_real_escape_string($medi,$_POST['cname']);
			$ddigit = $_POST['ddigit'];
			$okey = $_POST['status'];
			$store_id = $sdata["id"];
		$id = $_POST["id"];


  $table="tbl_delivery";
  $field = array('title'=>$dname,'de_digit'=>$ddigit,'status'=>$okey);
  $where = "where id=".$id." and store_id=".$store_id."";
$h = new Medico();
	  $check = $h->mediupdateData($field,$table,$where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Deliveries Add Successfully!!",
                    "message" => "Deliveries section!",
                    "action" => "list_delivery.php",
                ];
            } 
			
	}
	elseif ($_POST["type"] == "add_category") {
        $okey = $_POST["status"];
        $title = $medi->real_escape_string($_POST["title"]);
		
		
        $target_dir = dirname(dirname(__FILE__)) . "/images/category/";
        $url = "images/category/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
		
		$target_dirs = dirname(dirname(__FILE__)) . "/images/category/";
        $urls = "images/category/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid().round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs. basename($newfilenames);
        $urls = $urls . basename($newfilenames);
		
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["cover_img"]["tmp_name"], $target_files);
            $table = "tbl_category";
            $field_values = ["img", "status", "title","cover"];
            $data_values = ["$url", "$okey", "$title","$urls"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Category Add Successfully!!",
                    "message" => "Category section!",
                    "action" => "list_category.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "add_mcat") {
        $okey = $_POST["status"];
        $title = $medi->real_escape_string($_POST["title"]);
		$store_id = $sdata["id"];
		
        $target_dir = dirname(dirname(__FILE__)) . "/images/subcategory/";
        $url = "images/subcategory/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
           
		   
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
			
            $table = "tbl_mcat";
            $field_values = [ "status", "title","store_id","img"];
            $data_values = ["$okey", "$title","$store_id","$url"];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Category Add Successfully!!",
                    "message" => "Category section!",
                    "action" => "list_mcat.php",
                ];
            } 
        
    }elseif ($_POST["type"] == "com_payout") {
        $payout_id = $_POST["payout_id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payout/";
        $url = "images/payout/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
       
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "payout_setting";
            $field = ["proof" => $url, "status" => "completed"];
            $where = "where id=" . $payout_id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);

            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Payout Update Successfully!!",
                    "message" => "Payout section!",
                    "action" => "list_payout.php",
                ];
            } 
        
    }
elseif($_POST["type"] == "add_cash")
{
	$rcash = $_POST['rcash'];
		$message = $_POST['message'];
		$store_id = $_POST['store_id'];
		
		$timestamp = date("Y-m-d H:i:s");
	   
	   $table="tbl_cash";
  $field_values=array("rid","message","amt","pdate");
  $data_values=array("$store_id","$message","$rcash","$timestamp");
   
      $h = new Medico();
	  $checks = $h->mediinsertdata($field_values,$data_values,$table);
	  
	  if ($checks == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Add Cash Successfully!!",
                    "message" => "Cash section!",
                    "action" => "list_store.php",
                ];
            } 
}
	elseif ($_POST["type"] == "add_coupon") {
        $expire_date = $_POST["expire_date"];
        $store_id = $sdata["id"];
        $status = $_POST["status"];
        $coupon_code = $_POST["coupon_code"];
        $min_amt = $_POST["min_amt"];
        $coupon_val = $_POST["coupon_val"];
        $description = $medi->real_escape_string($_POST["description"]);
        $title = $medi->real_escape_string($_POST["title"]);
        $subtitle = $medi->real_escape_string($_POST["subtitle"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/coupon/";
        $url = "images/coupon/";
        $temp = explode(".", $_FILES["coupon_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["coupon_img"]["tmp_name"], $target_file);
            $table = "tbl_coupon";
            $field_values = [
                "expire_date",
                "status",
                "title",
                "store_id",
                "coupon_code",
                "min_amt",
                "coupon_val",
                "description",
                "subtitle",
                "coupon_img",
            ];
            $data_values = [
                "$expire_date",
                "$status",
                "$title",
                "$store_id",
                "$coupon_code",
                "$min_amt",
                "$coupon_val",
                "$description",
                "$subtitle",
                "$url",
            ];

            $h = new Medico();
            $check = $h->mediinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Coupon Add Successfully!!",
                    "message" => "Coupon section!",
                    "action" => "list_coupon.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "edit_coupon") {
        $expire_date = $_POST["expire_date"];
        $vendor_id = $sdata["id"];
        $id = $_POST["id"];
        $status = $_POST["status"];
        $coupon_code = $_POST["coupon_code"];
        $min_amt = $_POST["min_amt"];
        $coupon_val = $_POST["coupon_val"];
        $description = $medi->real_escape_string($_POST["description"]);
        $title = $medi->real_escape_string($_POST["title"]);
        $subtitle = $medi->real_escape_string($_POST["subtitle"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/coupon/";
        $url = "images/coupon/";
        $temp = explode(".", $_FILES["coupon_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["coupon_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["coupon_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_coupon";
                $field = [
                    "status" => $status,
                    "coupon_img" => $url,
                    "title" => $title,
                    "coupon_code" => $coupon_code,
                    "min_amt" => $min_amt,
                    "coupon_val" => $coupon_val,
                    "description" => $description,
                    "subtitle" => $subtitle,
                    "expire_date" => $expire_date,
                ];
                $where =
                    "where id=" . $id . " and store_id=" . $vendor_id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Coupon Update Successfully!!",
                        "message" => "Coupon section!",
                        "action" => "list_coupon.php",
                    ];
                } 
            
        } else {
            $table = "tbl_coupon";
            $field = [
                "status" => $status,
                "title" => $title,
                "coupon_code" => $coupon_code,
                "min_amt" => $min_amt,
                "coupon_val" => $coupon_val,
                "description" => $description,
                "subtitle" => $subtitle,
                "expire_date" => $expire_date,
            ];
            $where = "where id=" . $id . " and store_id=" . $vendor_id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Coupon Update Successfully!!",
                    "message" => "Coupon section!",
                    "action" => "list_coupon.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_category") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $medi->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/category/";
        $url = "images/category/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
		
		$target_dirs = dirname(dirname(__FILE__)) . "/images/category/";
        $urls = "images/category/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid().round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);
		
        if ($_FILES["cat_img"]["name"] != "" and $_FILES["cover_img"]["name"] == "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_category";
                $field = ["status" => $okey, "img" => $url, "title" => $title];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Category Update Successfully!!",
                        "message" => "Category section!",
                        "action" => "list_category.php",
                    ];
                } 
            
        } else if ($_FILES["cat_img"]["name"] == "" and $_FILES["cover_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cover_img"]["tmp_name"],
                    $target_files
                );
                $table = "tbl_category";
                $field = ["status" => $okey, "cover" => $urls, "title" => $title];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Category Update Successfully!!",
                        "message" => "Category section!",
                        "action" => "list_category.php",
                    ];
                } 
            
        }else if ($_FILES["cat_img"]["name"] != "" and $_FILES["cover_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
				
				 move_uploaded_file(
                    $_FILES["cover_img"]["tmp_name"],
                    $target_files
                );
                $table = "tbl_category";
                $field = ["status" => $okey, "cover" => $urls,"img" => $url, "title" => $title];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Category Update Successfully!!",
                        "message" => "Category section!",
                        "action" => "list_category.php",
                    ];
                } 
            
        }else {
            $table = "tbl_category";
            $field = ["status" => $okey, "title" => $title];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Category Update Successfully!!",
                    "message" => "Category section!",
                    "action" => "list_category.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_mcat") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $medi->real_escape_string($_POST["title"]);
        
		$target_dir = dirname(dirname(__FILE__)) . "/images/subcategory/";
        $url = "images/subcategory/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
		
		if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_mcat";
            $field = ["status" => $okey, "title" => $title,"img"=>$url];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Menu Category Update Successfully!!",
                    "message" => "Menu Category section!",
                    "action" => "list_mcat.php",
                ];
            } 
            
        }
		else 
		{
            $table = "tbl_mcat";
            $field = ["status" => $okey, "title" => $title];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Menu Category Update Successfully!!",
                    "message" => "Menu Category section!",
                    "action" => "list_mcat.php",
                ];
            } 
		}   
    } elseif ($_POST["type"] == "edit_banner") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "banner";
                $field = ["status" => $okey, "img" => $url];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Banner Update Successfully!!",
                        "message" => "banner section!",
                        "action" => "list_banner.php",
                    ];
                } 
            
        } else {
            $table = "banner";
            $field = ["status" => $okey];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Banner Update Successfully!!",
                    "message" => "banner section!",
                    "action" => "list_banner.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_gallery") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
		$store_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/gallery/";
        $url = "images/gallery/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_photo";
                $field = ["status" => $okey, "img" => $url];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Photo Update Successfully!!",
                        "message" => "Photo section!",
                        "action" => "list_photo.php",
                    ];
                } 
            
        } else {
            $table = "tbl_photo";
            $field = ["status" => $okey];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Photo Update Successfully!!",
                    "message" => "Photo section!",
                    "action" => "list_photo.php",
                ];
            } 
        }
    }elseif ($_POST["type"] == "edit_extra") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
		$mid = $_POST["mid"];
		$store_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/product/";
        $url = "images/product/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = uniqid().round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_extra";
                $field = ["status" => $okey, "img" => $url,"mid"=>$mid];
                $where = "where id=" . $id . " and store_id=".$store_id."";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Extra Image Update Successfully!!",
                        "message" => "Extra Image section!",
                        "action" => "list_extra.php",
                    ];
                } 
            
        } else {
            $table = "tbl_extra";
            $field = ["status" => $okey,"mid"=>$mid];
            $where = "where id=" . $id ." and store_id=".$store_id."";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Extra Image Update Successfully!!",
                    "message" => "Extra Image section!",
                    "action" => "list_extra.php",
                ];
            } 
        }
    }elseif ($_POST["type"] == "add_zone") {
        $zname = $_POST["zname"];
        $okey = $_POST["status"];
        $coordinates = $_POST["coordinates"];
        foreach (
            explode("),(", trim($coordinates, "()"))
            as $index => $single_array
        ) {
            if ($index == 0) {
                $lastcord = explode(",", $single_array);
            }
            $coords = explode(",", $single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }

        $polygon[] = new Point($lastcord[0], $lastcord[1]);
        $pv = new Polygon([new LineString($polygon)]);

        $table = "zones";
        $field_values = ["coordinates", "title", "status", "alias"];
        $data_values = [
            "ST_GeomFromText('POLYGON($pv)')",
            "$zname",
            "$okey",
            "$coordinates",
        ];

        $h = new Medico();
        $check = $h->medizoneinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Zone Add Successfully!!",
                "message" => "Zone section!",
                "action" => "list_Zone.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_zone") {
        $zname = $_POST["zname"];
        $id = $_POST["id"];
        $okey = $_POST["status"];
        $coordinates = $_POST["coordinates"];

        foreach (
            explode("),(", trim($coordinates, "()"))
            as $index => $single_array
        ) {
            if ($index == 0) {
                $lastcord = explode(",", $single_array);
            }
            $coords = explode(",", $single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }

        $polygon[] = new Point($lastcord[0], $lastcord[1]);
        $pv = new Polygon([new LineString($polygon)]);

        $table = "zones";
        $field = [
            "coordinates" => "ST_GeomFromText('POLYGON($pv)')",
            "title" => $zname,
            "status" => $okey,
            "alias" => $coordinates,
        ];
        $where = "where id=" . $id . "";
        $h = new Medico();
        $check = $h->medizoneupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Zone Update Successfully!!",
                "message" => "Zone section!",
                "action" => "list_Zone.php",
            ];
        } 
    } elseif ($_POST["type"] == "add_Store") {
        $cname = mysqli_real_escape_string($medi, $_POST["cname"]);
        $status = $_POST["status"];
		$is_pickup = $_POST["is_pickup"];
        $arate = $_POST["arate"];
        $slogan = mysqli_real_escape_string($medi,$_POST["slogan"]);
		$opentime = $_POST["opentime"];
		$closetime = $_POST["closetime"];
		$cancle_policy = mysqli_real_escape_string($medi,$_POST["cancle_policy"]);
		$slogan_title = mysqli_real_escape_string($medi,$_POST["slogan_title"]);
		$cdesc = mysqli_real_escape_string($medi,$_POST["cdesc"]);
        $lcode = $_POST["lcode"];
        $mobile = $_POST["mobile"];
        $sdesc = $_POST["sdesc"];
        $catsearch = implode(",", $_POST["catsearch"]);
        $FullAddress = mysqli_real_escape_string(
            $medi,
            $_POST["FullAddress"]
        );
        $pincode = $_POST["pincode"];
        $landmark = mysqli_real_escape_string($medi, $_POST["landmark"]);
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $scharge = $_POST["scharge"];

        $charge_type = $_POST["charge_type"];
        $dcharge = empty($_POST["dcharge"]) ? 0 : $_POST["dcharge"];
        $ukms = empty($_POST["ukms"]) ? 0 : $_POST["ukms"];
        $uprice = empty($_POST["uprice"]) ? 0 : $_POST["uprice"];
        $aprice = empty($_POST["aprice"]) ? 0 : $_POST["aprice"];
        $morder = $_POST["morder"];
        $commission = $_POST["commission"];
        $bname = mysqli_real_escape_string($medi, $_POST["bname"]);
        $ifsc = $_POST["ifsc"];
        $rname = mysqli_real_escape_string($medi, $_POST["rname"]);
        $ano = $_POST["ano"];
        $paypal = $_POST["paypal"];
        $upi = $_POST["upi"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $zone_id = $_POST["zone_id"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/store/";
        $url = "images/store/";
        $temp = explode(".", $_FILES["kit_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        $target_dirs = dirname(dirname(__FILE__)) . "/images/store/";
        $urls = "images/store/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid() . round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);

        $check_details = $medi->query(
            "select email from service_details where email='" . $email . "'"
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Store Email Already Used!!",
                "message" => "Store section!",
                "action" => "add_store.php",
            ];
        } else {
            
                move_uploaded_file(
                    $_FILES["kit_img"]["tmp_name"],
                    $target_file
                );
                move_uploaded_file(
                    $_FILES["cover_img"]["tmp_name"],
                    $target_files
                );
                $table = "service_details";
                $field_values = [
                    "sdesc",
                    "rimg",
                    "status",
                    "title",
                    "rate",
                    "slogan",
                    "lcode",
                    "catid",
                    "full_address",
					"slogan_title",
                    "pincode",
                    "landmark",
                    "lats",
                    "longs",
                    "store_charge",
                    "dcharge",
                    "morder",
                    "commission",
                    "bank_name",
                    "ifsc",
                    "receipt_name",
                    "acc_number",
                    "paypal_id",
                    "upi_id",
                    "email",
                    "password",
                    "mobile",
                    "charge_type",
                    "ukm",
                    "uprice",
                    "aprice",
                    "zone_id",
                    "cover_img",
					"cdesc",
					"cancle_policy",
					"opentime",
					"closetime",
					"is_pickup"
                ];
                $data_values = [
                    "$sdesc",
                    "$url",
                    "$status",
                    "$cname",
                    "$arate",
                    "$slogan",
                    "$lcode",
                    "$catsearch",
                    "$FullAddress",
					"$slogan_title",
                    "$pincode",
                    "$landmark",
                    "$latitude",
                    "$longitude",
                    "$scharge",
                    "$dcharge",
                    "$morder",
                    "$commission",
                    "$bname",
                    "$ifsc",
                    "$rname",
                    "$ano",
                    "$paypal",
                    "$upi",
                    "$email",
                    "$password",
                    "$mobile",
                    "$charge_type",
                    "$ukms",
                    "$uprice",
                    "$aprice",
                    "$zone_id",
                    "$urls",
					"$cdesc",
					"$cancle_policy",
					"$opentime",
					"$closetime",
					"$is_pickup"
                ];
                $h = new Medico();
                $check = $h->mediinsertdata(
                    $field_values,
                    $data_values,
                    $table
                );
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Store Add Successfully!!",
                        "message" => "Store section!",
                        "action" => "list_store.php",
                    ];
                } 
            
        }
    }else if($_POST['type'] == 'add_payout')
{
	$owner_id = $sdata["id"];
	$amt = $_POST['amt'];
	$r_type = $_POST['r_type'];
	$acc_number = $_POST['acc_number'];
	$bank_name = $_POST['bank_name'];
	$acc_name = $_POST['acc_name'];
	$ifsc_code = $_POST['ifsc_code'];
	$upi_id = $_POST['upi_id'];
	$paypal_id = $_POST['paypal_id'];
	
	$store_id = $sdata['id'];
                	$total_earn = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_normal_order where store_id=".$store_id." and status='Completed'")->fetch_assoc();
	$earn = empty($total_earn['total_amt']) ? "0" : $total_earn['total_amt'];
	
	
	$total_earn_pre = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_subscribe_order where store_id=".$store_id." and status='Completed'")->fetch_assoc();
	$earn_pre = empty($total_earn_pre['total_amt']) ? "0" : $total_earn_pre['total_amt'];
	
	
	
	$total_payout = $medi->query("select sum(amt) as total_payout from payout_setting where owner_id=".$store_id."")->fetch_assoc();
	$payout = empty($total_payout['total_payout']) ? "0" : $total_payout['total_payout'];
	$bs = (floatval($earn)+floatval($earn_pre)) - floatval($payout);
				 
				 if(floatval($amt) > floatval($set['pstore']))
				 {
					$returnArr = array("ResponseCode"=>"401","Result"=>"false","title"=>"You can't Payout Above Your Payout Limit!","message"=>"Payout Problem!!","action"=>"add_payout.php"); 
					
				 }
				 else if(floatval($amt) > floatval($bs))
				 {
					  
					 $returnArr = array("ResponseCode"=>"401","Result"=>"false","title"=>"You can't Payout Above Your Earning!","message"=>"Payout Problem!!","action"=>"add_payout.php"); 
				 }
				 else 
				 {
					 $timestamp = date("Y-m-d H:i:s");
					 $table="payout_setting";
  $field_values=array("owner_id","amt","status","r_date","r_type","acc_number","bank_name","acc_name","ifsc_code","upi_id","paypal_id");
  $data_values=array("$owner_id","$amt","pending","$timestamp","$r_type","$acc_number","$bank_name","$acc_name","$ifsc_code","$upi_id","$paypal_id");
  
      $h = new Medico();
	  $check = $h->mediinsertdata($field_values,$data_values,$table);
	 
	  if($check == 1)
{
	 $returnArr = array("ResponseCode"=>"200","Result"=>"true","title"=>"Payout Request Submit Successfully!!","message"=>"Payout Submitted!!","action"=>"add_payout.php");
}

				 }
											   
} elseif ($_POST["type"] == "edit_Store") {
        $id = $_POST["id"];
        $cname = mysqli_real_escape_string($medi, $_POST["cname"]);
        $status = $_POST["status"];
        $arate = $_POST["arate"];
		$is_pickup = $_POST["is_pickup"];
        $slogan = mysqli_real_escape_string($medi,$_POST["slogan"]);
		$slogan_title = mysqli_real_escape_string($medi,$_POST["slogan_title"]);
		$cdesc = mysqli_real_escape_string($medi,$_POST["cdesc"]);
        $lcode = $_POST["lcode"];
        $mobile = $_POST["mobile"];
        $sdesc = $_POST["sdesc"];
$opentime = $_POST["opentime"];
		$closetime = $_POST["closetime"];
		$cancle_policy = mysqli_real_escape_string($medi,$_POST["cancle_policy"]);
        $catsearch = implode(",", $_POST["catsearch"]);
        $FullAddress = mysqli_real_escape_string(
            $medi,
            $_POST["FullAddress"]
        );
        $pincode = $_POST["pincode"];
        $landmark = mysqli_real_escape_string($medi, $_POST["landmark"]);
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $scharge = $_POST["scharge"];

        $charge_type = $_POST["charge_type"];
        $dcharge = empty($_POST["dcharge"]) ? 0 : $_POST["dcharge"];
        $ukms = empty($_POST["ukms"]) ? 0 : $_POST["ukms"];
        $uprice = empty($_POST["uprice"]) ? 0 : $_POST["uprice"];
        $aprice = empty($_POST["aprice"]) ? 0 : $_POST["aprice"];
        $morder = $_POST["morder"];
        $commission = $_POST["commission"];
        $bname = mysqli_real_escape_string($medi, $_POST["bname"]);
        $ifsc = $_POST["ifsc"];
        $rname = mysqli_real_escape_string($medi, $_POST["rname"]);
        $ano = $_POST["ano"];
        $paypal = $_POST["paypal"];
        $upi = $_POST["upi"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $zone_id = $_POST["zone_id"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/store/";
        $url = "images/store/";
        $temp = explode(".", $_FILES["kit_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        $target_dirs = dirname(dirname(__FILE__)) . "/images/store/";
        $urls = "images/store/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid() . round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);

        $check_details = $medi->query(
            "select email from service_details where email='" .
                $email .
                "' and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Store Email Already Used!!",
                "message" => "Store section!",
                "action" => "add_store.php?id=" . $id . "",
            ];
        } else {
            if (
                $_FILES["kit_img"]["name"] != "" and
                $_FILES["cover_img"]["name"] == ""
            ) {
                
                    move_uploaded_file(
                        $_FILES["kit_img"]["tmp_name"],
                        $target_file
                    );
                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "rimg" => $url,
                        "title" => $cname,
                        "rate" => $arate,
                        "slogan" => $slogan,
						"slogan_title"=>$slogan_title,
						"cdesc"=>$cdesc,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
						"opentime"=>$opentime,
						"closetime"=>$closetime,
						"cancle_policy"=>$cancle_policy,
						"is_pickup"=>$is_pickup
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Medico();
                    $check = $h->mediupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Store Update Successfully!!",
                            "message" => "Store section!",
                            "action" => "list_store.php",
                        ];
                    }
                
            } elseif (
                $_FILES["kit_img"]["name"] == "" and
                $_FILES["cover_img"]["name"] != ""
            ) {
                
                    move_uploaded_file(
                        $_FILES["cover_img"]["tmp_name"],
                        $target_files
                    );
                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "cover_img" => $urls,
                        "title" => $cname,
                        "rate" => $arate,
                        "slogan" => $slogan,
						"slogan_title"=>$slogan_title,
						"cdesc"=>$cdesc,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
						"opentime"=>$opentime,
						"closetime"=>$closetime,
						"cancle_policy"=>$cancle_policy,
						"is_pickup"=>$is_pickup
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Medico();
                    $check = $h->mediupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Store Update Successfully!!",
                            "message" => "Store section!",
                            "action" => "list_store.php",
                        ];
                    } 
                
            } elseif (
                $_FILES["kit_img"]["name"] != "" and
                $_FILES["cover_img"]["name"] != ""
            ) {
               
                    move_uploaded_file(
                        $_FILES["cover_img"]["tmp_name"],
                        $target_files
                    );
                    move_uploaded_file(
                        $_FILES["kit_img"]["tmp_name"],
                        $target_file
                    );

                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "cover_img" => $urls,
                        "rimg" => $url,
                        "title" => $cname,
                        "rate" => $arate,
                        "slogan" => $slogan,
						"slogan_title"=>$slogan_title,
						"cdesc"=>$cdesc,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
						"opentime"=>$opentime,
						"closetime"=>$closetime,
						"cancle_policy"=>$cancle_policy,
						"is_pickup"=>$is_pickup
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Medico();
                    $check = $h->mediupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Store Update Successfully!!",
                            "message" => "Store section!",
                            "action" => "list_store.php",
                        ];
                    } 
                
            } else {
                $table = "service_details";
                $field = [
                    "zone_id" => $zone_id,
                    "charge_type" => $charge_type,
                    "ukm" => $ukms,
                    "aprice" => $aprice,
                    "uprice" => $uprice,
                    "sdesc" => $sdesc,
                    "status" => $status,
                    "title" => $cname,
                    "rate" => $arate,
                    "slogan" => $slogan,
					"slogan_title"=>$slogan_title,
					"cdesc"=>$cdesc,
                    "lcode" => $lcode,
                    "catid" => $catsearch,
                    "full_address" => $FullAddress,
                    "pincode" => $pincode,
                    "landmark" => $landmark,
                    "lats" => $latitude,
                    "longs" => $longitude,
                    "store_charge" => $scharge,
                    "dcharge" => $dcharge,
                    "morder" => $morder,
                    "commission" => $commission,
                    "bank_name" => $bname,
                    "ifsc" => $ifsc,
                    "receipt_name" => $rname,
                    "acc_number" => $ano,
                    "paypal_id" => $paypal,
                    "upi_id" => $upi,
                    "email" => $email,
                    "password" => $password,
                    "mobile" => $mobile,
						"opentime"=>$opentime,
						"closetime"=>$closetime,
						"cancle_policy"=>$cancle_policy,
						"is_pickup"=>$is_pickup
                ];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Store Update Successfully!!",
                        "message" => "Store section!",
                        "action" => "list_store.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_payment") {
        $dname = mysqli_real_escape_string($medi, $_POST["cname"]);
        $attributes = mysqli_real_escape_string($medi, $_POST["p_attr"]);
        $ptitle = mysqli_real_escape_string($medi, $_POST["ptitle"]);
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $p_show = $_POST["p_show"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payment/";
        $url = "images/payment/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
           
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_payment_list";
                $field = [
                    "title" => $dname,
                    "status" => $okey,
                    "img" => $url,
                    "attributes" => $attributes,
                    "subtitle" => $ptitle,
                    "p_show" => $p_show,
                ];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Payment Gateway Update Successfully!!",
                        "message" => "Payment Gateway section!",
                        "action" => "payment_method.php",
                    ];
                } 
            
        } else {
            $table = "tbl_payment_list";
            $field = [
                "title" => $dname,
                "status" => $okey,
                "attributes" => $attributes,
                "subtitle" => $ptitle,
                "p_show" => $p_show,
            ];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Payment Gateway Update Successfully!!",
                    "message" => "Payment Gateway section!",
                    "action" => "payment_method.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_faq") {
        $okey = $_POST["status"];
        $question = $medi->real_escape_string($_POST["question"]);
        $answer = $medi->real_escape_string($_POST["answer"]);
        $store_id = $sdata["id"];
        $table = "tbl_faq";
        $field_values = ["question", "answer", "status","store_id"];
        $data_values = ["$question", "$answer", "$okey","$store_id"];

        $h = new Medico();
        $check = $h->mediinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "FAQ Add Successfully!!",
                "message" => "FAQ section!",
                "action" => "list_faq.php",
            ];
        } 
    }elseif ($_POST["type"] == "add_time") {
        $okey = $_POST["status"];
        $mintime = $medi->real_escape_string($_POST["mintime"]);
        $maxtime = $medi->real_escape_string($_POST["maxtime"]);
        $store_id = $sdata["id"];
        $table = "tbl_time";
        $field_values = ["mintime", "maxtime", "status","store_id"];
        $data_values = ["$mintime", "$maxtime", "$okey","$store_id"];

        $h = new Medico();
        $check = $h->mediinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Timeslot Add Successfully!!",
                "message" => "Timeslot section!",
                "action" => "list_time.php",
            ];
        } 
    }  elseif ($_POST["type"] == "edit_faq") {
        $okey = $_POST["status"];
        $question = $medi->real_escape_string($_POST["question"]);
        $answer = $medi->real_escape_string($_POST["answer"]);
        $id = $_POST["id"];
        $table = "tbl_faq";
        $field = [
            "status" => $okey,
            "answer" => $answer,
            "question" => $question,
        ];
        $where = "where id=" . $id . "";
        $h = new Medico();
        $check = $h->mediupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "FAQ Update Successfully!!",
                "message" => "FAQ Code section!",
                "action" => "list_faq.php",
            ];
        } 
    } 
	elseif ($_POST["type"] == "edit_time") {
        $okey = $_POST["status"];
        $mintime = $medi->real_escape_string($_POST["mintime"]);
        $maxtime = $medi->real_escape_string($_POST["maxtime"]);
        $id = $_POST["id"];
        $table = "tbl_time";
        $field = [
            "status" => $okey,
            "maxtime" => $maxtime,
            "mintime" => $mintime,
        ];
        $where = "where id=" . $id . "";
        $h = new Medico();
        $check = $h->mediupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Timeslot Update Successfully!!",
                "message" => "Timeslot Code section!",
                "action" => "list_time.php",
            ];
        } 
    } elseif ($_POST["type"] == "add_page") {
        $ctitle = $medi->real_escape_string($_POST["ctitle"]);
        $cstatus = $_POST["cstatus"];
        $cdesc = $medi->real_escape_string($_POST["cdesc"]);
        $table = "tbl_page";

        $field_values = ["description", "status", "title"];
        $data_values = ["$cdesc", "$cstatus", "$ctitle"];

        $h = new Medico();
        $check = $h->mediinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Page Add Successfully!!",
                "message" => "Page section!",
                "action" => "list_Page.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_page") {
        $id = $_POST["id"];
        $ctitle = $medi->real_escape_string($_POST["ctitle"]);
        $cstatus = $_POST["cstatus"];
        $cdesc = $medi->real_escape_string($_POST["cdesc"]);

        $table = "tbl_page";
        $field = [
            "description" => $cdesc,
            "status" => $cstatus,
            "title" => $ctitle,
        ];
        $where = "where id=" . $id . "";
        $h = new Medico();
        $check = $h->mediupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Page Update Successfully!!",
                "message" => "Page section!",
                "action" => "list_Page.php",
            ];
        } 
    }  elseif ($_POST["type"] == "edit_profile") {
        $dname = $_POST["email"];
        $dsname = $_POST["password"];
        $id = $_POST["id"];
        $table = "admin";
        $field = ["username" => $dname, "password" => $dsname];
        $where = "where id=" . $id . "";
        $h = new Medico();
        $check = $h->mediupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Profile Update Successfully!!",
                "message" => "Profile  section!",
                "action" => "profile.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_setting") {
        $webname = mysqli_real_escape_string($medi, $_POST["webname"]);
        $timezone = $_POST["timezone"];
        $currency = $_POST["currency"];
        $pstore = $_POST["pstore"];
         $sms_type = $_POST['sms_type'];
			$auth_key = $_POST['auth_key'];
			$otp_id = $_POST['otp_id'];
			$acc_id = $_POST['acc_id'];
			$auth_token = $_POST['auth_token'];
			$twilio_number = $_POST['twilio_number'];
			$otp_auth = $_POST['otp_auth'];
        $id = $_POST["id"];

        $one_key = $_POST["one_key"];

        $one_hash = $_POST["one_hash"];
        $s_key = $_POST["s_key"];

        $s_hash = $_POST["s_hash"];

        
        $d_key = $_POST["d_key"];
        $d_hash = $_POST["d_hash"];
        $scredit = $_POST["scredit"];
        $rcredit = $_POST["rcredit"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/website/";
        $url = "images/website/";
        $temp = explode(".", $_FILES["weblogo"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["weblogo"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["weblogo"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_setting";
                $field = [
                   
                    "timezone" => $timezone,
                    "weblogo" => $url,
                    "webname" => $webname,
                    "currency" => $currency,
                    "pstore" => $pstore,
                    "one_key" => $one_key,
                    "one_hash" => $one_hash,
                    "d_key" => $d_key,
                    "d_hash" => $d_hash,
                    "s_key" => $s_key,
                    "s_hash" => $s_hash,
                    "scredit" => $scredit,
                    "rcredit" => $rcredit,
					'otp_auth'=>$otp_auth,
					'twilio_number'=>$twilio_number,
					'auth_token'=>$auth_token,
					'acc_id'=>$acc_id,
					'otp_id'=>$otp_id,
					'auth_key'=>$auth_key,
					'sms_type'=>$sms_type
                ];
                $where = "where id=" . $id . "";
                $h = new Medico();
                $check = $h->mediupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Setting Update Successfully!!",
                        "message" => "Setting section!",
                        "action" => "setting.php",
                    ];
                }             
        } else {
            $table = "tbl_setting";
            $field = [
                
                "timezone" => $timezone,
                "webname" => $webname,
                "currency" => $currency,
                "pstore" => $pstore,
                "one_key" => $one_key,
                "one_hash" => $one_hash,
                "d_key" => $d_key,
                "d_hash" => $d_hash,
                "s_key" => $s_key,
                "s_hash" => $s_hash,
                "scredit" => $scredit,
                "rcredit" => $rcredit,
				'otp_auth'=>$otp_auth,
				'twilio_number'=>$twilio_number,
				'auth_token'=>$auth_token,
				'acc_id'=>$acc_id,
				'otp_id'=>$otp_id,
				'auth_key'=>$auth_key,
				'sms_type'=>$sms_type
            ];
            $where = "where id=" . $id . "";
            $h = new Medico();
            $check = $h->mediupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Setting Update Successfully!!",
                    "message" => "Offer section!",
                    "action" => "setting.php",
                ];
            } 
        }
    }  
}
echo json_encode($returnArr);
