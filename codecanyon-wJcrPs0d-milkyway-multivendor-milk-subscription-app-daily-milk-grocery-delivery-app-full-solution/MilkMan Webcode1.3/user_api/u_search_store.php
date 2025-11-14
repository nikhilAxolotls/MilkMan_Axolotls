<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data['uid'] == '' or $data['lats'] == '' or $data['longs'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$uid = $data['uid'];
	$longs = $data['longs'];
	$lats = $data['lats'];
	$keyword = $data['keyword'];
	$sql_distances = $medi->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")'))  and status=1");

$pops = array();
	$pols = array();

while($rows = $sql_distances->fetch_assoc())
{
	
	$querys = $medi->query("select * from service_details where  zone_id=".$rows['id']." and title COLLATE utf8mb4_general_ci like '%".$keyword."%' and status=1  order by id desc");
	
	while($lols = $querys->fetch_assoc())
	{
   
    $pols['store_id'] = $lols['id'];
	$pols['store_logo'] = $lols['rimg'];
	$pols['store_title'] = $lols['title'];
	$pols['store_cover'] = $lols['cover_img'];
	$pols['store_slogan'] = $lols['slogan'];
	$pols['store_slogan_title'] = $lols['slogan_title'];
	$pols['store_sdesc'] = $lols['cdesc'];
	$checkrate = $medi->query("SELECT *  FROM tbl_normal_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->num_rows;
	$checkprate = $medi->query("SELECT *  FROM tbl_subscribe_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->num_rows;
	if($checkrate != 0 and $checkprate == 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
	}
	else if($checkrate == 0 and $checkprate != 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)$rdata_rest['rate_rests'], 2, '.', '');
	}
	else if($checkrate != 0 and $checkprate != 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$rdata_rests = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$lols['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)(($rdata_rest['rate_rest'] + $rdata_rests['rate_rests'])/2) , 2, '.', '');
	}
	else 
	{
	$pols['store_rate'] = $lols['rate'];
	}
	$pols['store_tags'] = explode(',',$lols['sdesc']);
	$pols['total_fav'] = $medi->query("select * from tbl_fav where store_id=".$lols['id']."")->num_rows;
	$check_coupon = $medi->query("select title,subtitle from tbl_coupon where store_id=".$lols['id']." and status=1")->fetch_assoc();
	$pols['coupon_title'] = (empty($check_coupon['title'])) ? '': $check_coupon['title'];
	$pols['coupon_subtitle'] = (empty($check_coupon['subtitle'])) ? '': $check_coupon['subtitle'];
	$pops[] = $pols;
	
	
}
}

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Search Store List Get Successfully!","SearchStoreData"=>empty($pops) ? [] : $pops);

}
echo json_encode($returnArr);
?>