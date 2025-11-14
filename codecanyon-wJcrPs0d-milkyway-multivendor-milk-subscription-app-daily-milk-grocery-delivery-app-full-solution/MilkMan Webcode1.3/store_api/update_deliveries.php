<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	        $dname = mysqli_real_escape_string($medi,$data['title']);
			$ddigit = $data['day'];
			$okey = $data['status'];
			$store_id = $medi->real_escape_string($data["store_id"]);
			$record_id = $data['record_id'];
if ($dname == '' or $store_id == '' or $ddigit == ''  or $okey == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
$table="tbl_delivery";
  $field = array('title'=>$dname,'de_digit'=>$ddigit,'status'=>$okey);
  $where = "where id=".$record_id." and store_id=".$store_id."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);

			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Deliveries Update Successfully"
            );
	}
echo json_encode($returnArr);
?>