<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $store_id = $medi->real_escape_string($data["store_id"]);
		$mintime = $medi->real_escape_string($data["mintime"]);
		$maxtime = $medi->real_escape_string($data["maxtime"]);
		
if ($status == '' or $store_id == '' or $mintime == '' or $maxtime == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
$table = "tbl_time";
            $field_values = ["mintime", "status","store_id","maxtime"];
            $data_values = ["$mintime", "$status","$store_id","$maxtime"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Timeslot Add Successfully"
            );
			
	}

echo json_encode($returnArr);
?>