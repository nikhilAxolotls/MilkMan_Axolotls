<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

$data = json_decode(file_get_contents('php://input'), true);

header('Content-type: application/json');

if(empty($data['store_id']) || empty($data['order_id'])) {
    
    echo json_encode(array("ResponseCode"=>"400","Result"=>"false","ResponseMsg"=>"Invalid input parameters."));
} else {

    $order_id = $medi->real_escape_string($data['order_id']);
    $store_id =  $medi->real_escape_string($data['store_id']);

    try {
       


         $row = $medi->query("SELECT * FROM tbl_normal_order WHERE store_id=".$store_id." AND id=".$order_id."")->fetch_assoc();
        // Fetch rider details
        $rdata = $medi->query("SELECT title, img, mobile, ccode FROM tbl_rider WHERE id=".$row['rid']."")->fetch_assoc();

        $pp = array();
        $pp['rider_title'] = $rdata['title'] ?? "";
        $pp['rider_image'] = $rdata['img'] ?? "";
        $pp['rider_mobile'] = $rdata['ccode'].$rdata['mobile'] ?? "";    
        $pp['order_id'] = $row['id'];
        $pp['order_date'] = $row['odate'];
        $pname = $medi->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
        $pp['p_method_name'] = $pname['title'];
        $pp['customer_address'] = $row['address'];
        $pp['customer_name'] = $row['name'];
        $pp['Order_Type'] = $row['o_type'];
		$pp['wall_amt'] = $row['wall_amt'];
        $pp['customer_mobile'] = $row['mobile'];
		$pp['comment_reject'] = $row['comment_reject'];
        $pp['store_charge'] = $row['store_charge'];
        $pp['Delivery_charge'] = $row['d_charge'];
        $pp['Delivery_Timeslot'] = $row['tslot'];
        $pp['Coupon_Amount'] = $row['cou_amt'];
        $pp['Order_Total'] = $row['o_total'];
        $pp['Order_SubTotal'] = $row['subtotal'];
        $pp['flow_id'] = $row['order_status'];
            $pp['Order_Transaction_id'] = $row['trans_id'];
        
        $pp['Additional_Note'] = $row['a_note'];
        $pp['Order_Status'] = $row['status'];

       
        $fetchpro_result = $medi->query("SELECT pquantity, ptitle, pdiscount, pimg, pprice, ptype FROM tbl_normal_order_product WHERE oid=".$row['id']."");
        
        $pdata = array();
        while($jpro = $fetchpro_result->fetch_assoc())
        {
            $kop = array();
            $kop['Product_quantity'] = $jpro['pquantity'];
            $kop['Product_name'] = $jpro['ptitle'];
            $kop['Product_discount'] = $jpro['pdiscount'];
            $kop['Product_image'] = $jpro['pimg'];
            $kop['Product_price'] = $jpro['pprice'];
            $kop['Product_type'] = $jpro['ptype'];
            array_push($pdata, $kop);
        }

        $pp['order_products'] = $pdata;

        
        echo json_encode(array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order details fetched successfully.","orderdata"=>$pp));

    } catch (Exception $e) {
        
        echo json_encode(array("ResponseCode"=>"500","Result"=>"false","ResponseMsg"=>"Error occurred while fetching order details.","orderdata"=>[]));
    }
}