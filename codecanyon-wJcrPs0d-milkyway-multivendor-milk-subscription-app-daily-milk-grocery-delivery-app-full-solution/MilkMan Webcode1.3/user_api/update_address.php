<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data['uid'] == '' or $data['lats'] == '' or $data['longs'] == '' or $data['address'] == '' or $data["a_type"] == '' or $data["address_id"] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$uid = $data['uid'];
	$longs = $data['longs'];
	$lats = $data['lats'];
	$address_id = $data['address_id'];
	$address = $medi->real_escape_string($data["address"]);
	$landmark = $medi->real_escape_string($data["landmark"]);
	$r_instruction = $medi->real_escape_string($data["r_instruction"]);
	$a_type = $medi->real_escape_string($data["a_type"]);
	
	$table="tbl_address";
  $field = array('a_lat'=>$lats,'a_long'=>$longs,'address'=>$address,'landmark'=>$landmark,'r_instruction'=>$r_instruction,'a_type'=>$a_type);
  $where = "where uid=".$uid." and id=".$address_id."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);
	  
	  $adata = $medi->query("select * from tbl_address where id=".$address_id."")->fetch_assoc();
		$p = array();
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['address'] = $adata['address'];
		$p['landmark'] = $adata['landmark'];
		$p['r_instruction'] = $adata['r_instruction'];
		$p['a_type'] = $adata['a_type'];
		$p['a_lat'] = $adata['a_lat'];
		$p['a_long'] = $adata['a_long'];
		$returnArr = array("AddressData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Updated Successfully!!!");
}
echo json_encode($returnArr);
?>