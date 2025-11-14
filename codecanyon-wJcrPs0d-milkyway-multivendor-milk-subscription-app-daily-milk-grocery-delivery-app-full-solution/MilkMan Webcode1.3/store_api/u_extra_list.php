<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';

header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$store_id = $data['store_id'];
if ($store_id == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
$pol = array();
$c = array();
$sel = $medi->query("SELECT * FROM `tbl_extra` where store_id=".$store_id."");
while($row = $sel->fetch_assoc())
{
   
		$pol['id'] = $row['id'];
		$type = $medi->query("select * from tbl_product where id=".$row['mid']."")->fetch_assoc();
		$pol['medicine_title'] = $type['title'];
		$pol['medicine_id'] = $row['mid'];
		$pol['image'] = $row['img'];
		
		$pol['status'] = $row['status'];
		
		$c[] = $pol;
	
	
}
if(empty($c))
{
	$returnArr = array("extralist"=>[],"ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Extra Image List Not Founded!");
}
else 
{
$returnArr = array("extralist"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Extra Image  List Founded!");
}
}
echo json_encode($returnArr);
?>