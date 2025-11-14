<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $mid = $medi->real_escape_string($data["mid"]);
		$store_id = $data['store_id'];
		$record_id = $data['record_id'];
if ($store_id == '' or $status == '' or $mid == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	$check_owner = $medi->query("select * from tbl_product where id=" . $mid . " and store_id=".$store_id."")->num_rows;
if($check_owner !=0)
{
	$check_record = $medi->query("select * from tbl_extra where mid=" . $mid . " and store_id=".$store_id." and id=" . $record_id . "")->num_rows;
	if($check_record !=0)
{
	if($data['img'] == '0')
	{
		
 $table = "tbl_extra";
                $field = ["status" => $status,"mid"=>$mid];
                $where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Extra Image Update Successfully"
            );
	}
	else 
	{
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/gallery/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
 $table = "tbl_extra";
                $field = ["status" => $status, "img" => $path,"mid"=>$mid];
                $where = "where id=" . $record_id . "";
                $h = new Medico();
                $check = $h->mediupdateData_Api($field, $table, $where);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Extra Image Update Successfully"
            );
	}
			}

else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Extra Image Update On Your Own Store!"
    );
}
}
else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Extra Image Update On Your Own Store!"
    );
}
	}

echo json_encode($returnArr);
?>