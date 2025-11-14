<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');

if(empty($data['uid'])) {
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
} else {

    $uid =  $medi->real_escape_string($data['uid']);
    $status = $data['status'];

    if($status == 'Current') {
        $query = "SELECT tbl_normal_order.id, tbl_normal_order.o_type, tbl_normal_order.status, tbl_normal_order.odate, tbl_normal_order.o_total, service_details.title as store_title, service_details.rimg as store_img, service_details.rate as store_rate, service_details.full_address as store_address, IF(tbl_rider.id <> 0, tbl_rider.title, 'Not Assigned') as Delivery_name 
                  FROM tbl_normal_order 
                  INNER JOIN service_details ON tbl_normal_order.store_id = service_details.id 
                  LEFT JOIN tbl_rider ON tbl_normal_order.rid = tbl_rider.id 
                  WHERE tbl_normal_order.uid = $uid AND tbl_normal_order.status != 'Completed' AND tbl_normal_order.status != 'Cancelled' 
                  ORDER BY tbl_normal_order.id DESC";
    } else {
        $query = "SELECT tbl_normal_order.id, tbl_normal_order.o_type, tbl_normal_order.status, tbl_normal_order.odate, tbl_normal_order.o_total, service_details.title as store_title, service_details.rimg as store_img, service_details.rate as store_rate, service_details.full_address as store_address, IF(tbl_rider.id <> 0, tbl_rider.title, 'Not Assigned') as Delivery_name 
                  FROM tbl_normal_order 
                  INNER JOIN service_details ON tbl_normal_order.store_id = service_details.id 
                  LEFT JOIN tbl_rider ON tbl_normal_order.rid = tbl_rider.id 
                  WHERE tbl_normal_order.uid = $uid AND (tbl_normal_order.status ='Completed' OR tbl_normal_order.status='Cancelled') 
                  ORDER BY tbl_normal_order.id DESC";
    }

    $result = $medi->query($query);

    if($result && $result->num_rows > 0) {

        $orders = array();

        while($row = $result->fetch_assoc()) {
            $order = array();
            $order['id'] = $row['id'];
            $order['o_type'] = $row['o_type'];
            $order['status'] = $row['status'];
            $order['odate'] = $row['odate'];
            $order['o_total'] = $row['o_total'];
            $order['store_title'] = $row['store_title'];
            $order['store_img'] = $row['store_img'];
            $order['store_rate'] = $row['store_rate'];
            $order['store_address'] = $row['store_address'];
            $order['Delivery_name'] = $row['Delivery_name'];

            $orders[] = $order;
        }

        $returnArr = array("OrderHistory"=>$orders,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");

    } else {
        $returnArr = array("OrderHistory"=>[],"ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
    }

    echo json_encode($returnArr);
}

?>