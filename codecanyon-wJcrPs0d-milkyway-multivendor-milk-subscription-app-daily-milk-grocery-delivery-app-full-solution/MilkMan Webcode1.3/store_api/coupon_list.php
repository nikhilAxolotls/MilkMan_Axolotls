<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if ($data['store_id'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$store_id = $data['store_id'];
	
		
			$vop = array();
			$gal = $medi->query("SELECT * FROM `tbl_coupon` where store_id=".$store_id."");
			while($tog = $gal->fetch_assoc())
			{
				 
				$vop[] = $tog;
			}
			
		
		
		$returnArr = array(
		"coupondata"=>empty($vop) ? [] : $vop,
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Coupon List Get Successfully!!!"
    );
}
echo json_encode($returnArr);
?>