<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$pol = array();
$c = array();
$uid  = $data['uid'];
$store_id = $data['store_id'];
if($uid == '' or $store_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else 
{
$timestamp = date("Y-m-d");
$sel = $medi->query("select * from tbl_coupon where status=1 and store_id=".$store_id."");
while($row = $sel->fetch_assoc())
{
    if($row['expire_date'] < $timestamp)
	{
		$medi->query("update tbl_coupon set status=0 where id=".$row['id']."");
	}
	else 
	{
		$pol['id'] = $row['id'];
		$pol['coupon_img'] = $row['coupon_img'];
		
		$pol['expire_date'] = $row['expire_date'];
		
		$pol['c_desc'] = $row['description'];
		
		$pol['coupon_val'] = $row['coupon_val'];
		$pol['coupon_code'] = $row['coupon_code'];
		$pol['coupon_title'] = $row['title'];
		$pol['coupon_subtitle'] = $row['subtitle'];
		$pol['min_amt'] = $row['min_amt'];
		$c[] = $pol;
	}	
	
}
if(empty($c))
{
	$returnArr = array("couponlist"=>$c,"ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Coupon Not Founded!");
}
else 
{
$returnArr = array("couponlist"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Coupon List Founded!");
}
}
echo json_encode($returnArr);
?>