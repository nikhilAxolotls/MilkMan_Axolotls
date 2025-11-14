<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$uid = $data['uid'];
$keyword = $data['keyword'];
$store_id = $data['store_id'];
if($uid == ''  or $keyword == '' or $store_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$counter = $medi->query("select * from tbl_product where  title like '%".$keyword."%' and store_id=".$store_id." and status = 1");
    if($counter->num_rows != 0)
    {

	$plist = $medi->query("select * from tbl_product where title like '%".$keyword."%' and store_id=".$store_id." and status = 1");
	$products = array();
	$lp = array();
	while($rows = $plist->fetch_assoc())
	{
	$mattributes = $medi->query("select * from tbl_product_attribute where product_id=".$rows['id']."");
	if($mattributes->num_rows != 0)
	{
	$products['product_id'] = $rows['id'];
	$products['catid'] = $rows['cat_id'];
	$products['product_title'] = $rows['title'];
	$products['product_description'] = $rows['description'];
	$products['product_img'] = $rows['img'];
	$pattr = array();
	$k = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
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
$returnArr = array("SearchData"=>$lp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
}
 else
    {
        $returnArr = array("SearchData"=>[],"ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Product List Not Found!");
    }
}
echo json_encode($returnArr);
mysqli_close($medi);	


