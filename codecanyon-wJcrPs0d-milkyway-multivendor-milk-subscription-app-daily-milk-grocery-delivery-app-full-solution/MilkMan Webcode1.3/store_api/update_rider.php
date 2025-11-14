<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
     $store_id = $medi->real_escape_string($data["store_id"]);
	 $title = $medi->real_escape_string($data["title"]);
	 $email = $data["email"];
	 $ccode = $data["ccode"];
	 $mobile = $data["mobile"];
	 $password = $data["password"];
	 $record_id = $data['record_id'];
if ( $status == '' or $store_id == ''  or $title == '' or $email == '' or $ccode == '' or $mobile == '' or $password == '' or  $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$check_record = $medi->query("select * from tbl_rider where store_id=" . $store_id . "  and id=" . $record_id . "")->num_rows;
	if($check_record !=0)
{
	$check_details = $medi->query(
            "select email from service_details where email='" .
                $email .
                "' and id!=" .
                $record_id .
                ""
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Rider Email Already Used!!"
    );
        } else {
			
	if($data['img'] == '0')
	{
		
 $table = "tbl_rider";
            $field = ["status" => $status,"title"=>$title,"email"=>$email,"ccode"=>$ccode,"mobile"=>$mobile,"password"=>$password];
                $where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Rider Update Successfully"
            );
	}
	else 
	{
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/rider/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
                $table = "tbl_rider";
                $field = ["status" => $status, "img" => $path,"title"=>$title,"email"=>$email,"ccode"=>$ccode,"mobile"=>$mobile,"password"=>$password];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Rider Update Successfully"
            );
	}
			}
}

else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Rider Update On Your Own Store!"
    );
}

	}

echo json_encode($returnArr);
?>