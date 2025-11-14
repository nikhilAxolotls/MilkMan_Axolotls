<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$store_id = $data['store_id'];
header('Content-type: text/json');
if($store_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$count = $medi->query("select * from  tbl_rider where store_id=".$store_id."")->num_rows;
	if($count != 0)
	{
	$cy = $medi->query("select * from  tbl_rider where store_id=".$store_id."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['rider_id'] = $adata['id'];
		$p['rider_name'] = $adata['title'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rider List Get Successfully!!!","Partnerlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Rider List Not Found!!","Partnerlist"=>[]);
	}
}
echo  json_encode($returnArr);


?>