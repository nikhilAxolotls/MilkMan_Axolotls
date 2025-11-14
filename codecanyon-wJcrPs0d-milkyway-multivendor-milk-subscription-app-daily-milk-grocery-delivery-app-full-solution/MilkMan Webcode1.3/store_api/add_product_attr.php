<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
     
	        $product = $data['product_id'];
			$mprice = $data['mprice'];
			$sprice = $data['sprice'];
			$srequire = $data['srequire'];
			$mtype = stripslashes($medi->real_escape_string(trim($data['title'])));
			$mdiscount = $data['mdiscount'];
			$mstock = $data['mstock'];
			$store_id = $medi->real_escape_string($data["store_id"]);
			
if ($product == '' or $store_id == '' or $mprice == ''  or $sprice == '' or $srequire == '' or $mtype == '' or $mdiscount == '' or $mstock == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
			
  $table="tbl_product_attribute";
  $field_values=array("product_id","normal_price","title","discount","out_of_stock","subscribe_price","subscription_required","store_id");
  $data_values=array("$product","$mprice","$mtype","$mdiscount","$mstock","$sprice","$srequire","$store_id");
  
  $h = new Medico();
            $check = $h->mediinsertdata_Api($field_values, $data_values, $table);
			
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Product Attribute Add Successfully"
            );
	}
echo json_encode($returnArr);
?>