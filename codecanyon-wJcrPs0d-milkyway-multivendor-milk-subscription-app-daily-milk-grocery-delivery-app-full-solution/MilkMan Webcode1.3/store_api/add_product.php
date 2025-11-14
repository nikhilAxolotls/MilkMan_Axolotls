<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	 $status = $data["status"];
     $store_id = $medi->real_escape_string($data["store_id"]);
	 $description = $medi->real_escape_string($data["description"]);
	 $title = $medi->real_escape_string($data["title"]);
	 $cat_id = $data["cat_id"];	
if ($status == '' or $store_id == '' or $description == ''  or $title == '' or $cat_id == '' ) {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	$img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$datavb = base64_decode($img);
$path = 'images/product/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;
file_put_contents($fname, $datavb);
$table = "tbl_product";
            $field_values = ["img", "status","store_id","description","title","cat_id"];
            $data_values = ["$path", "$status","$store_id","$description","$title","$cat_id"];

            $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Product  Add Successfully"
            );
			
	}
echo json_encode($returnArr);
?>