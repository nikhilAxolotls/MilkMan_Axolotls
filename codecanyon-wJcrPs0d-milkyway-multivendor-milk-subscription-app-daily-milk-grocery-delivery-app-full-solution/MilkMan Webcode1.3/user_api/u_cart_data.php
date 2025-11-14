<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
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

if ($data['uid'] == '' or $data['lats'] == '' or $data['longs'] == '' or $data['store_id'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
$uid = $data['uid'];
	$longs = $data['longs'];
	$lats = $data['lats'];
	$store_id = $data['store_id'];
	
	$sql_distance = $medi->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1")->fetch_assoc();
	$querys = $medi->query("select * from service_details where id=".$store_id."")->fetch_assoc();
	$pols = array();
	$pols['store_id'] = $querys['id'];
	$pols['store_logo'] = $querys['rimg'];
	$pols['store_title'] = $querys['title'];
	$pols['store_tags'] = explode(',',$querys['sdesc']);
	$counter = $medi->query("select * from tbl_time where status =1 and store_id=".$store_id."")->num_rows;
	$pols['store_is_pickup'] = ($counter !=0) ? $querys['is_pickup'] : "0";
	$pols['store_full_address'] = $querys['full_address'];
	$pols['store_charge'] = $querys['store_charge'];
	$pols['store_morder'] = $querys['morder'];
		$pols['store_is_open'] = $querys['rstatus'];
	if($querys['charge_type'] == 0 or $querys['charge_type'] == 1)
		{
		$pols['rest_dcharge'] = $querys['dcharge'];
		}
		else 
		{
			$distance = number_format((float)distance($querys['lats'], $querys['longs'], $lats, $longs, "K"), 2, '.', '');
			if($distance <= $querys['ukm'])
			{
			$pols['rest_dcharge'] = $querys['uprice'];
			}
			else 
			{
				$remain_kms = $distance - $querys['ukm'];
				$calculated = $remain_kms * $querys['aprice'];
				$pols['rest_dcharge'] = round($querys['uprice'] + $calculated);
			}
		}
		
		if( $querys['zone_id'] >= $sql_distance['id'])
		{
			$pols['store_is_deliver'] = "1";
		}
		else 
		{
			$pols['store_is_deliver'] = "0";
		}
		
	$pol = array();
$c = array();

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

$sels = $medi->query("select * from tbl_payment_list where status =1 ");
$myarray = array();
while($rows = $sels->fetch_assoc())
{
	$myarray[] = $rows;
}

$time = $medi->query("select * from tbl_time where status =1 and store_id=".$store_id."");
$timearr = array();
while($ro = $time->fetch_assoc())
{
	$timearr[] = $ro;
}

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Cart Data Get Successfully!","StoreData"=>$pols,"CouponList"=>$c,"PaymentData"=>$myarray,"Timeslotlist"=>$timearr);

}
echo json_encode($returnArr);
?>