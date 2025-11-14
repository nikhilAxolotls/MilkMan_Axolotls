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
	 $record_id = $data['record_id'];
if ( $status == '' or $store_id == '' or $description == '' or $subtitle == '' or $title == '' or $coupon_code == '' or $expire_date == '' or $min_amt == ''  or $coupon_val == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$check_record = $medi->query("select * from tbl_coupon where store_id=" . $store_id . "  and id=" . $record_id . "")->num_rows;
	if($check_record !=0)
{
	if($data['img'] == '0')
	{
		
 $table = "tbl_coupon";
            $field = ["status" => $status,"description"=>$description,"subtitle"=>$subtitle,"title"=>$title,"coupon_code"=>$coupon_code,"expire_date"=>$expire_date,"min_amt"=>$min_amt,"coupon_val"=>$coupon_val];
                $where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Coupon Update Successfully"
            );
	}
	else 
	{
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/coupon/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
                $table = "tbl_coupon";
                $field = ["status" => $status, "coupon_img" => $path,"description"=>$description,"subtitle"=>$subtitle,"title"=>$title,"coupon_code"=>$coupon_code,"expire_date"=>$expire_date,"min_amt"=>$min_amt,"coupon_val"=>$coupon_val];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Coupon Update Successfully"
            );
	}
			}

else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Coupon Update On Your Own Store!"
    );
}

	}

echo json_encode($returnArr);
?>