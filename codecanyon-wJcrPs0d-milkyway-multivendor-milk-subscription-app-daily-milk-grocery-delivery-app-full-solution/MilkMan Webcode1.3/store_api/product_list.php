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
			$gal = $medi->query("SELECT * FROM `tbl_product` where store_id=".$store_id."");
			while($tog = $gal->fetch_assoc())
			{
				$cdata = $medi->query("select title from tbl_mcat where id=".$tog['cat_id']."")->fetch_assoc(); 
				$vop['id'] = $tog['id'];
				$vop['store_id'] = $tog['store_id'];
				$vop['cat_id'] = $tog['cat_id'];
				$vop['cat_name'] =  $cdata['title'];
				$vop['title'] = $tog['title'];
				$vop['img'] = $tog['img'];
				$vop['description'] = $tog['description'];
				$vop['status'] = $tog['status'];
				$sop[] = $vop;
			}
			
		
		
		$returnArr = array(
		"productdata"=>empty($sop) ? [] : $sop,
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Product List Get Successfully!!!"
    );
}
echo json_encode($returnArr);
?>