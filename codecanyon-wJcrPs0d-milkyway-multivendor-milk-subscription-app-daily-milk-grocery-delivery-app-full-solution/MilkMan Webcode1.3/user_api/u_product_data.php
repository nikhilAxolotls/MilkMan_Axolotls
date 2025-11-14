<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);


if ($data['uid'] == '' or $data['pid'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$uid = $data['uid'];
	$pid = $data['pid'];
	$product = array();
    $list = array();
	$prok = $medi->query("select * from tbl_product where id=".$pid."")->fetch_assoc();
	$l = array();
	$vr=array();
	        $l['id'] = $prok['id'];
			$l['title'] = $prok['title'];
			$l['product_description'] = $prok['description'];
			$vr[] = $prok['img'];
		$get_extra = $medi->query("select img from tbl_extra where mid=".$prok['id']."");
		while($rk = $get_extra->fetch_assoc())
		{
			array_push($vr,$rk['img']);
		}
			$l['img'] = $vr;
			$mattributes = $medi->query("select * from tbl_product_attribute where product_id=".$pid."");
      if($mattributes->num_rows != 0)
	  {
	
	$pattr = array();
	$k = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
		$pattr['product_id'] = $rattr['product_id'];
		$pattr['normal_price'] = $rattr['normal_price'];
		$pattr['subscribe_price'] = $rattr['subscribe_price'];
		$pattr['title'] = $rattr['title'];
		$pattr['product_discount'] = $rattr['discount'];
		$pattr['Product_Out_Stock'] = $rattr['out_of_stock'];
		$pattr['subscription_required'] = $rattr['subscription_required'];
		
		$k[] = $pattr;
		
	}
	$l['product_info'] = $k;
    
	}
			$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product Information Get Successfully!","ProductData"=>$l);
}
echo json_encode($returnArr);
?>