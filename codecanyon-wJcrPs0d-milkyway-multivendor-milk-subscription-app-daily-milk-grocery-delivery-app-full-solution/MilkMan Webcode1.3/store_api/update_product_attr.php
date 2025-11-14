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
			$record_id = $data['record_id'];
if ($product == '' or $store_id == '' or $mprice == ''  or $sprice == '' or $srequire == '' or $mtype == '' or $mdiscount == '' or $mstock == '' or $record_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
			
			$table="tbl_product_attribute";
						
    $field=array('product_id'=>$product,'normal_price'=>$mprice,'title'=>$mtype,'discount'=>$mdiscount,'out_of_stock'=>$mstock,'subscribe_price'=>$sprice,'subscription_required'=>$srequire);
  
  $where = "where id=".$record_id." and store_id=".$store_id."";
  
  
  $h = new Medico();
            $check = $h->mediupdateData_Api($field, $table, $where);
			
			$returnArr    = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Product Attribute Update Successfully"
            );
	}
echo json_encode($returnArr);
?>