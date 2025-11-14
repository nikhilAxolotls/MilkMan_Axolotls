<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
     $store_id = $medi->real_escape_string($data["store_id"]);
	 $description = $medi->real_escape_string($data["description"]);
	 $title = $medi->real_escape_string($data["title"]);
	 $subtitle = $medi->real_escape_string($data["subtitle"]);
	 
	 $coupon_code = $data["coupon_code"];
	 $expire_date = $data["expire_date"];
	 $min_amt = $data["min_amt"];
	 
	 $coupon_val = $data["coupon_val"];
		
if ($status == '' or $store_id == '' or $description == '' or $subtitle == '' or $title == '' or $coupon_code == '' or $expire_date == '' or $min_amt == ''  or $coupon_val == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/coupon/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
$table = "tbl_coupon";
            $field_values = ["coupon_img", "status","store_id","description","subtitle","title","coupon_code","expire_date","min_amt","coupon_val"];
            $data_values = ["$path", "$status","$store_id","$description","$subtitle","$title","$coupon_code","$expire_date","$min_amt","$coupon_val"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Coupon  Add Successfully"
            );
			
	}

echo json_encode($returnArr);
?>