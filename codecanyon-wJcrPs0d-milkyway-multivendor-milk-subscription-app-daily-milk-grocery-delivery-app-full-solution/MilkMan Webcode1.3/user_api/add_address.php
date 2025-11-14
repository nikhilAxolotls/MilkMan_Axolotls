<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data['uid'] == '' or $data['lats'] == '' or $data['longs'] == '' or $data['address'] == '' or $data["a_type"] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$uid = $data['uid'];
	$longs = $data['longs'];
	$lats = $data['lats'];
	$address = $medi->real_escape_string($data["address"]);
	$landmark = $medi->real_escape_string($data["landmark"]);
	$r_instruction = $medi->real_escape_string($data["r_instruction"]);
	$a_type = $medi->real_escape_string($data["a_type"]);
	
	$table        = "tbl_address";
                $field_values = array(
                    "uid",
                    "a_lat",
                    "a_long",
                    "address",
                    "landmark",
                    "r_instruction",
                    "a_type"
                );
                $data_values  = array(
                    "$uid",
                    "$lats",
                    "$longs",
                    "$address",
                    "$landmark",
                    "$r_instruction",
                    "$a_type"
                );
                
                $h     = new Medico();
                $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
				$returnArr = array(
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "ResponseMsg" => "Address Saved Successfully!"
                );
}
echo json_encode($returnArr);
?>