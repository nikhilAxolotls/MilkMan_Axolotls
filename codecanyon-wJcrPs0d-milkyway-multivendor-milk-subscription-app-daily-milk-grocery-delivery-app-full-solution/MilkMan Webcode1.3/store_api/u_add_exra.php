<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
        $mid = $medi->real_escape_string($data["mid"]);
		$store_id = $data['store_id'];
		
if ($store_id == '' or $status == '' or $mid == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	$check_owner = $medi->query("select * from tbl_product where id=" . $mid . " and store_id=".$store_id."")->num_rows;
if($check_owner !=0)
{
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/gallery/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
$table = "tbl_extra";
            $field_values = ["img", "status","mid","store_id"];
            $data_values = ["$path", "$status","$mid","$store_id"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Extra Image Add Successfully"
            );
			}
else 
{
	$returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Extra Image Add On Your Own Property!"
    );
}
	}

echo json_encode($returnArr);
?>