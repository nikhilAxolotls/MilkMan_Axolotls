<?php

require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

// Read input data
$data = json_decode(file_get_contents('php://input'), true);

// Set response type to JSON
header('Content-type: application/json');

if (empty($data['store_id']) || empty($data['order_id'])) {
    // Invalid input, return 400 Bad Request
   
    $returnArr = array("ResponseCode" => "400", "Result" => "false", "ResponseMsg" => "Invalid input");
} else {
    $order_id = $medi->real_escape_string($data['order_id']);
    $store_id = $medi->real_escape_string($data['store_id']);

    try {
        // Fetch order details from database
        $orderResult = $medi->query("SELECT * FROM tbl_subscribe_order WHERE store_id={$store_id} AND id={$order_id}");
        

        $orderData = $orderResult->fetch_assoc();
        if (empty($orderData)) {
            // Order not found, return 404 Not Found
           
            $returnArr = array("ResponseCode" => "404", "Result" => "false", "ResponseMsg" => "Order not found");
        } else {
            $customerName = $orderData['name'];
            $customerMobile = $orderData['mobile'];
            $customerAddress = $orderData['address'];
            $deliveryCharge = $orderData['d_charge'];
            $couponAmount = $orderData['cou_amt'];
            $walletAmount = $orderData['wall_amt'];
			$flow_id = $orderData['order_status'];
            $storeCharge = $orderData['store_charge'];
            $orderTotal = $orderData['o_total'];
            $orderSubtotal = $orderData['subtotal'];
            $orderTransactionId = $orderData['trans_id'];
            $additionalNote = $orderData['a_note'];
            $orderStatus = $orderData['status'];
			$comment_reject = $orderData['comment_reject'];

            $paymentMethodResult = $medi->query("SELECT title FROM tbl_payment_list WHERE id={$orderData['p_method_id']}");
            

            $paymentMethodData = $paymentMethodResult->fetch_assoc();
            $paymentMethodName = $paymentMethodData['title'];

            $riderResult = $medi->query("SELECT title, img, mobile, ccode FROM tbl_rider WHERE id={$orderData['rid']}");
            

            $riderData = $riderResult->fetch_assoc();
            $riderTitle = empty($riderData['title']) ? "" : $riderData['title'];
            $riderImage = empty($riderData['img']) ? "" : $riderData['img'];
            $riderMobile = empty($riderData['mobile']) ? "" : $riderData['ccode'] . $riderData['mobile'];

            $orderProductResult = $medi->query("SELECT * FROM tbl_subscribe_order_product WHERE oid={$orderData['id']}");
            

            $orderProducts = array();
            while ($orderProductData = $orderProductResult->fetch_assoc()) {
                $orderProductId = $orderProductData['id'];
                $productQuantity = $orderProductData['pquantity'];
                $productName = $orderProductData['ptitle'];
                $productDiscount = $orderProductData['pdiscount'];
                $productImage = $orderProductData['pimg'];
                $productPrice = $orderProductData['pprice'];
                $productVariation = $orderProductData['ptype'];
                $deliveryTimeSlot = $orderProductData['tslot'];

                $productTotal = ($productPrice * $productQuantity);
                $totalDelivery = $orderProductData['totaldelivery'];
                $startDate = $orderProductData['startdate'];

                $checks = explode(',', $orderProductData['totaldates']);
                $prem = array();
                $in = explode(',', $orderProductData['completedates']);

                for ($i = 0; $i < count($checks); $i++) {
                    $isComplete = in_array($checks[$i], $in);
                    $date = date_create($checks[$i]);
                    $formatDate = date_format($date, "D d");
                    $prem[] = array("date" => $checks[$i], "is_complete" => $isComplete, "format_date"=> $formatDate);
                }

                $orderProduct = array(
                    "Product_id" => $orderProductId,
                    "Product_name" => $productName,
                    "Product_quantity" => $productQuantity,
                    "Product_discount" => $productDiscount,
                    "Product_image" => $productImage,
                    "Product_price" => $productPrice,
                    "Product_variation" => $productVariation,
                    "Delivery_Timeslot" => $deliveryTimeSlot,
                    "Product_total" => $productTotal,
                    "totaldelivery" => $totalDelivery,
                    "startdate" => $startDate,
                    "totaldates" => $prem
                );

                $orderProducts[] = $orderProduct;
            }

            $orderDataFormatted = array(
                'order_id' => $orderData['id'],
                'rider_title' => $riderTitle,
                'rider_image' => $riderImage,
                'rider_mobile' => $riderMobile,
                'p_method_name' => $paymentMethodName,
                'customer_address' => $customerAddress,
                'customer_name' => $customerName,
                'customer_mobile' => $customerMobile,
                'Delivery_charge' => $deliveryCharge,
                'Coupon_Amount' => $couponAmount,
                'Wallet_Amount' => $walletAmount,
				'flow_id'=>$flow_id,
                'store_charge' => $storeCharge,
                'Order_Total' => $orderTotal,
                'Order_SubTotal' => $orderSubtotal,
                'Order_Transaction_id' => $orderTransactionId,
                'Additional_Note' => $additionalNote,
                'Order_Status' => $orderStatus,
				'comment_reject' =>$comment_reject,
                'Order_Product_Data' => $orderProducts
            );

            // Return successful response
           
            $returnArr = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Subscribe Order Product Get successfully!",
                "OrderProductList" => $orderDataFormatted
            );
        }
    } catch (Exception $ex) {
        // Return error response
        
        $returnArr = array(
            "ResponseCode" => "500",
            "Result" => "false",
            "ResponseMsg" => $ex->getMessage()
        );
    }

    echo json_encode($returnArr);
}