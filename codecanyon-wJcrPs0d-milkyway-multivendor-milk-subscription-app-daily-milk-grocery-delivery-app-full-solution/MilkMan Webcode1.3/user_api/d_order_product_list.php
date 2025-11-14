<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');

if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $medi->real_escape_string($data['order_id']);
 $uid =  $medi->real_escape_string($data['uid']);
 
  $row = $medi->query("select * from tbl_normal_order where uid=".$uid." and id=".$order_id."")->fetch_assoc();
  
  
		
	$rdata = $medi->query("SELECT title, img, mobile, ccode FROM tbl_rider WHERE id=".$row['rid']."")->fetch_assoc();	
  
  $pp = array();
  
		$pp['order_id'] = $row['id'];
		$pp['rider_title'] = $rdata['title'] ?? "";
        $pp['rider_image'] = $rdata['img'] ?? "";
        $pp['rider_mobile'] = $rdata['ccode'].$rdata['mobile'] ?? "";    
		$pp['order_date'] = $row['odate'];
		$pname = $medi->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		$storedata = $medi->query("select title,rimg,rate,full_address from service_details where id=".$row['store_id']."")->fetch_assoc();
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['customer_name'] = $row['name'];
		$pp['store_title'] = $storedata['title'];
	    $pp['store_img'] = $storedata['rimg'];
	    $pp['store_rate'] = $storedata['rate'];
		$pp['wall_amt'] = $row['wall_amt'];
		$pp['Order_Type'] = $row['o_type'];
		$pp['store_address'] = $storedata['full_address'];
		$pp['customer_mobile'] = $row['mobile'];
		$pp['store_charge'] = $row['store_charge'];
		$pp['comment_reject'] = $row['comment_reject'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['Delivery_Timeslot'] = $row['tslot'];
		$pp['Coupon_Amount'] = $row['cou_amt'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['Order_SubTotal'] = $row['subtotal'];
		$pp['is_rate'] = $row['is_rate'];
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Additional_Note'] = $row['a_note'];
		$pp['Order_Status'] = $row['status'];
		
		
		$fetchpro = $medi->query("select *  from tbl_normal_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_discount'] = $jpro['pdiscount'];
			$kop['Product_image'] = $jpro['pimg'];
			$kop['Product_price'] = $jpro['pprice'];
			$kop['Product_variation'] = $jpro['ptype'];
			$discount = $jpro['pprice'] * $jpro['pdiscount']*$jpro['pquantity'] /100;
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']) - $discount;
			$pdata[] = $kop;
		}
		$pp['Order_Product_Data'] = $pdata;
		
	
	
    $returnArr = array("OrderProductList"=>$pp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Product Get successfully!");
}
echo json_encode($returnArr);

?>