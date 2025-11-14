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
		
if ($status == '' or $store_id == ''  or $title == '' or $email == '' or $ccode == '' or $mobile == '' or $password == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	$check_details = $medi->query(
            "select email from tbl_rider where email='" . $email . "'"
        )->num_rows;
        if ($check_details != 0) {
			$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Rider Email Already Used!!"
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
$timestamp = date("Y-m-d");
            $field_values = ["img", "status","store_id","title","email","ccode","mobile","password","rdate"];
            $data_values = ["$path", "$status","$store_id","$title","$email","$ccode","$mobile","$password","$timestamp"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Rider  Add Successfully"
            );
			
	}
}

echo json_encode($returnArr);
?>