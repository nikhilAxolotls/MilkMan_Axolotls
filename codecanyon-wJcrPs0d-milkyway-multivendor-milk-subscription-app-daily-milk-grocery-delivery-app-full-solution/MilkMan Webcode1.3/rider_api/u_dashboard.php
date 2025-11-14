<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$rider_id = $data['rider_id'];
if ($rider_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {

	
	$total_normal_order = $medi->query("select * from tbl_normal_order where rid=".$rider_id."")->num_rows;
	$total_normal_completed = $medi->query("select * from tbl_normal_order where rid=".$rider_id." and status='Completed'")->num_rows;
	$total_prescription = $medi->query("select * from tbl_subscribe_order where rid=".$rider_id."")->num_rows;
	$total_prescription_completed = $medi->query("select * from tbl_subscribe_order where rid=".$rider_id." and status='Completed'")->num_rows;
	
	$papi = array(array("title"=>"Normal Order","report_data"=>$total_normal_order,"url"=>'images/dashboard/myorders.png'),array("title"=>"Completed Order","report_data"=>$total_normal_completed,"url"=>'images/dashboard/myorders.png'),array("title"=>"Subscription Order","report_data"=>intval($total_prescription),"url"=>'images/dashboard/myprescription.png'),array("title"=>"Completed Order","report_data"=>intval($total_prescription_completed),"url"=>'images/dashboard/myprescription.png'));
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Report List Get Successfully!!!","report_data"=>$papi,"withdraw_limit"=>$set['pstore']);
	
}
echo json_encode($returnArr);
?>