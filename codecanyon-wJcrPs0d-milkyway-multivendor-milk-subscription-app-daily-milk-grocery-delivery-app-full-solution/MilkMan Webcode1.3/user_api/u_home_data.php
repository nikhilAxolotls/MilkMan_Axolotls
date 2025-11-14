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
	$f = array();
	$fp = array();
	$vop =array();
	$fpv = array();
	$fps = array();
	$cat  = array();
	$ban = array();
	$vops =array();
	
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

	$sql = $medi->query("select * from banner where status=1");
	while($rp = $sql->fetch_assoc())
	{
		$vop['id'] = $rp['id'];
		$vop['img'] = $rp['img'];
		$ban[] = $vop;
	}
	
	$sqls = $medi->query("select * from tbl_category where status=1");
	while($rps = $sqls->fetch_assoc())
	{
		$vops['id'] = $rps['id'];
		$vops['img'] = $rps['img'];
		$vops['title'] = $rps['title'];
		$vops['cover'] = $rps['cover'];
		$cat[] = $vops;
	}
	
	
	
	$sql_distance = $medi->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1");

$pop = array();
	$pol = array();

while($row = $sql_distance->fetch_assoc())
{
	
	$query = $medi->query("select service_details.*,(SELECT GROUP_CONCAT(`title`) from `tbl_category` WHERE find_in_set(tbl_category.id,service_details.catid)) as cat_select from service_details where  service_details.zone_id=".$row['id']." and service_details.status=1  order by service_details.id desc limit 5");
	
	while($lol = $query->fetch_assoc())
	{
   
    $pol['store_id'] = $lol['id'];
	$pol['store_title'] = $lol['title'];
	$pol['store_logo'] = $lol['rimg'];
	$pol['store_cover'] = $lol['cover_img'];
	$pol['store_slogan'] = $lol['slogan'];
	$pol['store_address'] = $lol['full_address'];
	$pol['rest_distance'] = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '').' Kms';
	$pol['store_tags'] = array_map('trim', explode(',', $lol['sdesc']));
	$pol['store_slogan_title'] = $lol['slogan_title'];
	$pol['store_category_name'] = $lol['cat_select'];
	$pop[] = $pol;
	
	
}
}

$sql_distancev = $medi->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1");

$popc = array();
	$polc = array();

while($rowc = $sql_distancev->fetch_assoc())
{
	
	$query = $medi->query("select * from tbl_fav where zone_id=".$rowc["id"]." and uid=".$uid."");
	
	while($lolc = $query->fetch_assoc())
	{
	$fod = $medi->query("select service_details.*,(SELECT GROUP_CONCAT(`title`) from `tbl_category` WHERE find_in_set(tbl_category.id,service_details.catid)) as cat_select from service_details where  service_details.id=".$lolc['store_id']." and service_details.status=1  order by service_details.id desc")->fetch_assoc();	
	$polc['store_id'] = $fod['id'];
	$polc['store_title'] = $fod['title'];
	$polc['store_logo'] = $fod['rimg'];
	$polc['store_cover'] = $fod['cover_img'];
	$polc['store_slogan'] = $fod['slogan'];
	$polc['store_tags'] = array_map('trim', explode(',', $fod['sdesc']));
	$polc['store_slogan_title'] = $fod['slogan_title'];
	$polc['store_category_name'] = $fod['cat_select'];
	$popc[] = $polc;	
	}
}

$sql_distances = $medi->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1");

$pops = array();
	$pols = array();

while($rows = $sql_distances->fetch_assoc())
{
	
	$querys = $medi->query("select * from service_details where  zone_id=".$rows['id']." and status=1  order by id  limit 5");
	
	while($lols = $querys->fetch_assoc())
	{
   
    $pols['store_id'] = $lols['id'];
	$pols['store_title'] = $lols['title'];
	$pols['store_logo'] = $lols['rimg'];
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
	$pols['store_tags'] = array_map('trim', explode(',', $lols['sdesc']));
	$pols['total_fav'] = $medi->query("select * from tbl_fav where store_id=".$lols['id']."")->num_rows;
	$check_coupon = $medi->query("select title,subtitle from tbl_coupon where store_id=".$lols['id']." and status=1")->fetch_assoc();
	$pols['coupon_title'] = (empty($check_coupon['title'])) ? '': $check_coupon['title'];
	$pols['coupon_subtitle'] = (empty($check_coupon['subtitle'])) ? '': $check_coupon['subtitle'];
	$pops[] = $pols;
	
	
}
}
	
	$tbwallet = $medi->query("select wallet from tbl_user where id=".$uid."")->fetch_assoc();
if($uid == 0)
{
	$wallet = "0";
}
else 
{
	$wallet = $tbwallet['wallet'];
}

	$kp = array('Banlist'=>$ban,'Catlist'=>$cat,"Favlist"=>$popc,"currency"=>$set['currency'],"wallet"=>$wallet,"spotlight_store"=>$pop,"top_store"=>$pops);
	
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","HomeData"=>$kp);

}
echo json_encode($returnArr);
?>