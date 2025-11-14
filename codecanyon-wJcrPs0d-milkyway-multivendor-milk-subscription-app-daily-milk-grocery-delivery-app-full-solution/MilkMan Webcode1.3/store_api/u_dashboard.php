<?php
require dirname(dirname(__FILE__)) . "/controller/mediconfig.php";
require dirname(dirname(__FILE__)) . "/controller/medico.php";
header("Content-type: text/json");
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents("php://input"), true);
$store_id = $data["store_id"];
if ($store_id == "") {
    $returnArr = [
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!",
    ];
} else {
    $total_medicine = $medi->query(
        "select * from tbl_product where store_id=" . $store_id . ""
    )->num_rows;
    $product_attribute = $medi->query(
        "select * from tbl_product_attribute where store_id=" . $store_id . ""
    )->num_rows;
    $product_deliveries = $medi->query(
        "select * from tbl_delivery where store_id=" . $store_id . ""
    )->num_rows;
    $total_category = $medi->query(
        "select * from tbl_mcat where store_id=" . $store_id . ""
    )->num_rows;
    $total_faq = $medi->query(
        "select * from tbl_faq where store_id=" . $store_id . ""
    )->num_rows;
    $total_timeslot = $medi->query(
        "select * from tbl_time where store_id=" . $store_id . ""
    )->num_rows;
    $total_coupon = $medi->query(
        "select * from tbl_coupon where store_id=" . $store_id . ""
    )->num_rows;
    $total_rider = $medi->query(
        "select * from tbl_rider where store_id=" . $store_id . ""
    )->num_rows;
    $total_extra_image = $medi->query(
        "select * from tbl_extra where store_id=" . $store_id . ""
    )->num_rows;
    $total_gallery_image = $medi->query(
        "select * from tbl_photo where store_id=" . $store_id . ""
    )->num_rows;
    $total_normal_order = $medi->query(
        "select * from tbl_normal_order where store_id=" . $store_id . ""
    )->num_rows;
    $total_prescription = $medi->query(
        "select * from tbl_subscribe_order where store_id=" . $store_id . ""
    )->num_rows;
	$sales  = $medi->query("select sum(subtotal-cou_amt+d_charge) as full_total from tbl_normal_order where status='completed'  and p_method_id=5 and  store_id=".$store_id."")->fetch_assoc();
             $payout =   $medi->query("select sum(amt) as full_payouts from tbl_cash where rid=".$store_id."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); }

    $total_earn = $medi
        ->query(
            "select sum((subtotal-cou_amt) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_normal_order where store_id=" .
                $store_id .
                " and status='Completed'"
        )
        ->fetch_assoc();
    $earn = empty($total_earn["total_amt"]) ? "0" : $total_earn["total_amt"];
    $total_earn_pre = $medi
        ->query(
            "select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as total_amt from tbl_subscribe_order where store_id=" .
                $store_id .
                " and status='Completed'"
        )
        ->fetch_assoc();
    $earn_pre = empty($total_earn_pre["total_amt"])
        ? "0"
        : $total_earn_pre["total_amt"];
    $total_payout = $medi
        ->query(
            "select sum(amt) as total_payout from payout_setting where owner_id=" .
                $store_id .
                ""
        )
        ->fetch_assoc();
    $payout = empty($total_payout["total_payout"])
        ? "0"
        : $total_payout["total_payout"];

    $finalearn = floatval($earn) + floatval($earn_pre) - floatval($payout);

    $papi = [
        [
            "title" => "Product",
            "report_data" => $total_medicine,
            "url" => "images/dashboard/medicine.png",
        ],
		[
            "title" => "Category",
            "report_data" => $total_category,
            "url" => "images/dashboard/category.png",
        ],
		[
            "title" => "FAQ",
            "report_data" => $total_faq,
            "url" => "images/dashboard/faqs.png",
        ],
		[
            "title" => "Timeslot",
            "report_data" => $total_timeslot,
            "url" => "images/dashboard/timeslot.png",
        ],
		[
            "title" => "Coupon",
            "report_data" => $total_coupon,
            "url" => "images/dashboard/coupons.png",
        ],
		[
            "title" => "Rider",
            "report_data" => $total_rider,
            "url" => "images/dashboard/deliveryboy.png",
        ],
        [
            "title" => "Extra Images",
            "report_data" => $total_extra_image,
            "url" => "images/dashboard/medicine_images.png",
        ],
        [
            "title" => "Gallery Images",
            "report_data" => $total_gallery_image,
            "url" => "images/dashboard/gallery.png",
        ],
		[
            "title" => "Normal Order",
            "report_data" => $total_normal_order,
            "url" => "images/dashboard/myorders.png",
        ],
        [
            "title" => "Earning",
            "report_data" => $finalearn,
            "url" => "images/dashboard/myearning.png",
        ],
        [
            "title" => "Payout",
            "report_data" => floatval($payout),
            "url" => "images/dashboard/mypayment.png",
        ],
        [
            "title" => "Subscription Order",
            "report_data" => intval($total_prescription),
            "url" => "images/dashboard/myprescription.png",
        ],
        [
            "title" => "Deliveries",
            "report_data" => $product_deliveries,
            "url" => "images/dashboard/medicine.png",
        ],
        [
            "title" => "Product Attribute",
            "report_data" => $product_attribute,
            "url" => "images/dashboard/medicine.png",
        ],
		[
            "title" => "Total On Hand Amount",
            "report_data" => floatval($pb),
            "url" => "images/dashboard/medicine.png",
        ]
    ];

    $returnArr = [
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Report List Get Successfully!!!",
        "report_data" => $papi,
        "withdraw_limit" => $set["pstore"],
    ];
}
echo json_encode($returnArr);
?>