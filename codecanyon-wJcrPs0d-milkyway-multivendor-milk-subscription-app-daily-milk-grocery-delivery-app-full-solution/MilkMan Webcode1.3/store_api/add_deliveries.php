<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	        $dname = mysqli_real_escape_string($medi,$data['title']);
			$ddigit = $data['day'];
			$okey = $data['status'];
			$store_id = $medi->real_escape_string($data["store_id"]);
			
if ($dname == '' or $store_id == '' or $ddigit == ''  or $okey == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
$table="tbl_delivery";
  $field_values=array("title","de_digit","status","store_id");
  $data_values=array("$dname","$ddigit","$okey","$store_id");
  
  $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);

			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Deliveries Add Successfully"
            );
	}
echo json_encode($returnArr);
?>