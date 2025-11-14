<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $store_id = $medi->real_escape_string($data["store_id"]);
		$cat_id = $medi->real_escape_string($data["cat_id"]);
		$user_id = $data['uid'];
		$record_id = $data['record_id'];
if ( $status == '' or $store_id == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$check_record = $medi->query("select * from tbl_photo where store_id=" . $store_id . "  and id=" . $record_id . "")->num_rows;
	if($check_record !=0)
{
	if($data['img'] == '0')
	{
		
 $table = "tbl_photo";
            $field = ["status" => $status];
                $where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Gallery Image Update Successfully"
            );
	}
	else 
	{
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/photo/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
                $table = "tbl_photo";
                $field = ["status" => $status, "img" => $path];
				$where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Gallery Image Update Successfully"
            );
	}
			}

else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Gallery Image Update On Your Own Store!"
    );
}

	}

echo json_encode($returnArr);
?>