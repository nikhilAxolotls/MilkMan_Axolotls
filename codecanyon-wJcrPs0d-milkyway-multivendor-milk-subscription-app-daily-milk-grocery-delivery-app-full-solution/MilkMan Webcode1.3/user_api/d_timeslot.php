<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$store_id = $data['store_id'];
if ($store_id =='' )
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
$sel = $medi->query("select * from tbl_time where store_id=".$store_id."");
$p = array();
while($row = $sel->fetch_assoc())
{
    $myarray['id'] = $row['id'];
	$myarray['mintime'] = date("g:i A", strtotime($row['mintime']));
	$myarray['maxtime'] = date("g:i A", strtotime($row['maxtime']));
	$p[] = $myarray;
}
$returnArr = array("data"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Timeslot Founded!");
}
echo json_encode($returnArr);
?>

