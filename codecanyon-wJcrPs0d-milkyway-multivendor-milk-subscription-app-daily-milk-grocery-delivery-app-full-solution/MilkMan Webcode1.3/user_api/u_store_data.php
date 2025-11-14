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

if ($data['uid'] == '' or $data['store_id'] == '' or $data['lats'] == '' or $data['longs'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
	
	$uid = $data['uid'];
	$store_id = $data['store_id'];
	$lats = $data['lats'];
	$longs = $data['longs'];
	
	
	$querys = $medi->query("select * from service_details where  id=".$store_id."")->fetch_assoc();
	
	$pols = array();
   
    $pols['store_id'] = $querys['id'];
	$pols['store_logo'] = $querys['rimg'];
	$pols['store_title'] = $querys['title'];
	$pols['store_cover'] = $querys['cover_img'];
	$pols['store_slogan'] = $querys['slogan'];
	$pols['store_slogan_title'] = $querys['slogan_title'];
	$pols['store_short_desc'] = $querys['cdesc'];
	$checkrate = $medi->query("SELECT *  FROM tbl_normal_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->num_rows;
	$checkprate = $medi->query("SELECT *  FROM tbl_subscribe_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->num_rows;
	if($checkrate != 0 and $checkprate == 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
	}
	else if($checkrate == 0 and $checkprate != 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)$rdata_rest['rate_rests'], 2, '.', '');
	}
	else if($checkrate != 0 and $checkprate != 0)
	{
		$rdata_rest = $medi->query("SELECT sum(total_rate)/count(*) as rate_rest FROM tbl_normal_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$rdata_rests = $medi->query("SELECT sum(total_rate)/count(*) as rate_rests FROM tbl_subscribe_order where store_id=".$querys['id']." and status='Completed' and total_rate !=0")->fetch_assoc();
		$pols['store_rate'] = number_format((float)(($rdata_rest['rate_rest'] + $rdata_rests['rate_rests'])/2) , 2, '.', '');
	}
	else 
	{
	$pols['store_rate'] = $querys['rate'];
	}
	$pols['store_lat'] = $querys['lats'];
	$pols['store_longs'] = $querys['longs'];
	$pols['store_address'] = $querys['full_address'];
	$pols['store_mobile'] = $querys['mobile'];
	$pols['store_email'] = $querys['email'];
	$pols['store_opentime'] = $querys['opentime'];
	$pols['store_closetime'] = $querys['closetime'];
	$pols['store_cancle_policy'] = $querys['cancle_policy'];
	$pols['store_is_pickup'] = $querys['is_pickup'];
	$pols['store_tags'] = explode(',',$querys['sdesc']);
	$pols['store_landmark'] = $querys['landmark'];
	$pols['store_is_pickup'] = $querys['is_pickup'];
	$pols['total_fav'] = $medi->query("select * from tbl_fav where store_id=".$querys['id']."")->num_rows;
	$pols['IS_FAVOURITE'] = $medi->query("select * from tbl_fav where uid=".$uid." and store_id=".$querys['id']."")->num_rows;
	$pols['rest_distance'] = number_format((float)distance($querys['lats'], $querys['longs'], $lats, $longs, "K"), 2, '.', '').' Kms';
	
	
	
	$cat = array();
	$pro = array();
	$query = $medi->query("select id,title,img from tbl_mcat where status=1 and store_id=".$store_id."");
    while($row = $query->fetch_assoc())
	{
		$cat['cat_id'] = $row['id'];
		$cat['cat_title'] = $row['title'];
		$cat['img'] = $row['img'];
		$products = array();
	$lp = array();
        $list = array();
        $prok = $medi->query("select * from tbl_product where  store_id=".$store_id." and cat_id=".$row['id']."");
		
        while($plist = $prok->fetch_assoc())
		{
			
		 $mattributes = $medi->query("select * from tbl_product_attribute where product_id=".$plist['id']."");
      if($mattributes->num_rows != 0)
	  {
	$products['product_id'] = $plist['id'];
	$products['product_title'] = $plist['title'];
	$products['product_img'] = $plist['img'];
	$products['product_description'] = $plist['description'];
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
	$products['product_info'] = $k;
    $lp[] = $products;
	}
		}
        $cat['productdata'] = $lp;
     $pro[] = $cat;		
	}
	
	
		
		$ban = array();
		$vop = array();
		$sql = $medi->query("select * from tbl_photo where status=1 and store_id=".$store_id."");
	while($rp = $sql->fetch_assoc())
	{
		$vop['id'] = $rp['id'];
		$vop['img'] = $rp['img'];
		$ban[] = $vop;
	}
	
	$check = $medi->query("select * from tbl_faq where status=1 and store_id=".$store_id."");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}


	$bov = array();
	$kol = array();
	$rev = $medi->query("select * from tbl_normal_order where store_id=".$store_id." and status='Completed' and is_rate=1 order by id desc");
	while($k = $rev->fetch_assoc())
	{
		$udata = $medi->query("select * from tbl_user where id=".$k['uid']."")->fetch_assoc();
		$bov['user_img'] = $udata['pro_pic'];
		$bov['user_title'] = $udata['name'];
		$bov['user_rate'] = $k['total_rate'];
		$bov['review_date'] = $k['review_date'];
		$bov['user_desc'] = $k['rate_text'];
		$kol[] = $bov;
		
	}
	
	
	$bovs = array();
	$kols = array();
	$rev = $medi->query("select * from tbl_subscribe_order where store_id=".$store_id." and status='Completed' and is_rate=1 order by id desc");
	while($ks = $rev->fetch_assoc())
	{
		$udata = $medi->query("select * from tbl_user where id=".$ks['uid']."")->fetch_assoc();
		$bovs['user_img'] = $udata['pro_pic'];
		$bovs['user_title'] = $udata['name'];
		$bovs['user_rate'] = $ks['total_rate'];
		$bovs['review_date'] = $ks['review_date'];
		$bovs['user_desc'] = $ks['rate_text'];
		$kols[] = $bovs;
		
	}
	
	function cmp($a, $b){
    $ad = strtotime($a['review_date']);
    $bd = strtotime($b['review_date']);
    return ($ad-$bd);
}
$arrreview = array_merge($kol, $kols);
usort($arrreview, 'cmp');

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Store Data Get Successfully!","StoreInfo"=>$pols,"catwiseproduct"=>$pro,"photos"=>$ban,"FAQdata"=>$op,"reviewdata"=>$arrreview);

}
echo json_encode($returnArr);
?>