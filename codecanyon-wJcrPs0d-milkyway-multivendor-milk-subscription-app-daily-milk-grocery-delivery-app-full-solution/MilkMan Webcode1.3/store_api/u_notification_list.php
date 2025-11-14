<?php 
require dirname( dirname(__FILE__) ).'/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['store_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $store_id = strip_tags(mysqli_real_escape_string($medi,$data['store_id']));
    
    
$check = $medi->query("select * from tbl_snoti where sid=".$store_id."");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}

if(empty($op))
{
	$returnArr = array("NotificationData"=>[],"ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Notification Not Found!!","NotificationData"=>[]);
}
else 
{
$returnArr = array("NotificationData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Get Successfully!!");
}

}
echo json_encode($returnArr);