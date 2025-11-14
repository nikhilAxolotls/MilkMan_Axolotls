<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $store_id = $medi->real_escape_string($data["store_id"]);
		$title = $medi->real_escape_string($data["title"]);
		$record_id = $data["record_id"];
		
if ($status == '' or $store_id == '' or $title == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	if($data['img'] == '0')
	{
$table = "tbl_mcat";
                $field = ["status" => $status, "title" => $title];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Medicine Category Update Successfully"
            );
	
	}
else 
{
	$img = $data['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/category/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);

$table = "tbl_mcat";
                $field = ["status" => $status, "title" => $title,"img" => $path];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Medicine Category Update Successfully"
            );
			
}	
	}

echo json_encode($returnArr);
?>