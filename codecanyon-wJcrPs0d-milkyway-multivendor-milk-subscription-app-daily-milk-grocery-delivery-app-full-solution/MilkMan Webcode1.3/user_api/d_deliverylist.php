<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$store_id = $data['store_id'];
if ($store_id =='' )
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
$sel = $medi->query("select * from tbl_delivery where status=1 and store_id=".$store_id."");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}
$returnArr = array("Deliverylist"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Deliveries List Founded!");

}
echo json_encode($returnArr);
?>