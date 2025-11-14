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
			$sop = array();
			$gal = $medi->query("SELECT * FROM `tbl_product_attribute` where store_id=".$store_id."");
			while($tog = $gal->fetch_assoc())
			{
				$cdata = $medi->query("select title from tbl_product where id=".$tog['product_id']."")->fetch_assoc(); 
				$vop['id'] = $tog['id'];
				$vop['store_id'] = $tog['store_id'];
				$vop['product_id'] = $tog['product_id'];
				$vop['product_name'] =  $cdata['title'];
				$vop['title'] = $tog['title'];
				$vop['subscribe_price'] = $tog['subscribe_price'];
				$vop['normal_price'] = $tog['normal_price'];
				$vop['out_of_stock'] = $tog['out_of_stock'];
				$vop['discount'] = $tog['discount'];
				$vop['subscription_required'] = $tog['subscription_required'];
				$sop[] = $vop;
			}
			
		
		
		$returnArr = array(
		"ProductAttrdata"=>empty($sop) ? [] : $sop,
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Product Attribute List Get Successfully!!!"
    );
}
echo json_encode($returnArr);
?>