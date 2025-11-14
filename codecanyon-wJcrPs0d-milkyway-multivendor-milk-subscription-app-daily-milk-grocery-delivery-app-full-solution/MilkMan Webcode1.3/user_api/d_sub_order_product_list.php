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
 
  $row = $medi->query("select * from tbl_subscribe_order where uid=".$uid." and id=".$order_id."")->fetch_assoc();
  
  
  $result = array();
  $pp = array();
  
   
		
		$rdata = $medi->query("SELECT title, img, mobile, ccode FROM tbl_rider WHERE id=".$row['rid']."")->fetch_assoc();
		$pp['order_id'] = $row['id'];
		$pp['rider_title'] = $rdata['title'] ?? "";
        $pp['rider_image'] = $rdata['img'] ?? "";
        $pp['rider_mobile'] = $rdata['ccode'].$rdata['mobile'] ?? "";    
		$pname = $medi->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['customer_name'] = $row['name'];
		$pp['customer_mobile'] = $row['mobile'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['Coupon_Amount'] = $row['cou_amt'];
		$pp['Wallet_Amount'] = $row['wall_amt'];
		$pp['comment_reject'] = $row['comment_reject'];
		$pp['store_charge'] = $row['store_charge'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['is_rate'] = $row['is_rate'];
		$pp['Order_SubTotal'] = $row['subtotal'];
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Additional_Note'] = $row['a_note'];
		$pp['Order_Status'] = $row['status'];
	
		$fetchpro = $medi->query("select *  from tbl_subscribe_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Subscribe_Id'] = $jpro['id'];
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_discount'] = $jpro['pdiscount'];
			$kop['Product_image'] = $jpro['pimg'];
			$kop['Product_price'] = $jpro['pprice'];
			$kop['Product_variation'] = $jpro['ptype'];
			$kop['Delivery_Timeslot'] = $jpro['tslot'];
			
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']);
			$kop['totaldelivery'] = $jpro['totaldelivery'];
			$kop['startdate'] = $jpro['startdate'];
			
			$checks = explode(',',$jpro['totaldates']);
			$prem = array();
			
			$in = explode(',',$jpro['completedates']);
			
			for($i=0;$i<count($checks);$i++)
			{
				 if (in_array($checks[$i],$in))
				 {
					 $date=date_create($checks[$i]);
 $fdate = date_format($date,"D d");

					 $prem[] = array("date"=>$checks[$i],"is_complete"=>1,"format_date"=>$fdate);
				 }
else 
{
	$date=date_create($checks[$i]);
 $fdate = date_format($date,"D d");
	$prem[] = array("date"=>$checks[$i],"is_complete"=>0,"format_date"=>$fdate);
}	
			}
			
			$kop['totaldates'] = $prem;
			$pdata[] = $kop;
		}
		$pp['Order_Product_Data'] = $pdata;
		$result[] = $pp;
	
	
    $returnArr = array("OrderProductList"=>$pp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subscribe Order Product Get successfully!");
}
echo json_encode($returnArr);

?>