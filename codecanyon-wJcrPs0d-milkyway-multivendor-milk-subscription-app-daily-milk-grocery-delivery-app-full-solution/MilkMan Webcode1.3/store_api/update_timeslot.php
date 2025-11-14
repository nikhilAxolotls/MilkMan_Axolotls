<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $store_id = $medi->real_escape_string($data["store_id"]);
		$mintime = $medi->real_escape_string($data["mintime"]);
		$maxtime = $medi->real_escape_string($data["maxtime"]);
		$record_id = $data["record_id"];
		
if ($status == '' or $store_id == '' or $mintime == '' or $record_id == '' or $maxtime == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
$table = "tbl_time";
                $field = ["status" => $status, "mintime" => $mintime,"maxtime"=>$maxtime];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Timeslot Update Successfully"
            );
			
	}

echo json_encode($returnArr);
?>