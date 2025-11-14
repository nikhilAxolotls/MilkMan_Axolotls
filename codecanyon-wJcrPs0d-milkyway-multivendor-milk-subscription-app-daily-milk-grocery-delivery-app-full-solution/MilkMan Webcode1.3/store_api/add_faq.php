<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $store_id = $medi->real_escape_string($data["store_id"]);
		$question = $medi->real_escape_string($data["question"]);
		$answer = $medi->real_escape_string($data["answer"]);
		
if ($status == '' or $store_id == '' or $question == '' or $answer == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
$table = "tbl_faq";
            $field_values = ["question", "status","store_id","answer"];
            $data_values = ["$question", "$status","$store_id","$answer"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "FAQ Add Successfully"
            );
			
	}

echo json_encode($returnArr);
?>