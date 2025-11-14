<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($data['store_id'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$store_id = $data['store_id'];
	
		
			$vop = array();
			$gal = $medi->query("SELECT * FROM `tbl_mcat` where store_id=".$store_id."");
			while($tog = $gal->fetch_assoc())
			{
				 
				$vop[] = $tog;
			}
			
		
		
		$returnArr = array(
		"categorydata"=>empty($vop) ? [] : $vop,
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Product Category List Get Successfully!!!"
    );
}
echo json_encode($returnArr);
?>