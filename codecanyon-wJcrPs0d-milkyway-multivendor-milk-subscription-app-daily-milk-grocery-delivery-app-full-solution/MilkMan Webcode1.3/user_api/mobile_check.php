<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['mobile'] == '' or  $data['ccode'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $mobile = strip_tags(mysqli_real_escape_string($medi,$data['mobile']));
    $ccode    = strip_tags(mysqli_real_escape_string($medi, $data['ccode']));
    
$chek = $medi->query("select * from tbl_user where mobile='".$mobile."' and ccode='" . $ccode . "'")->num_rows;

if($chek != 0)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Already Exist Mobile Number!");
}
else 
{
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"New Number!");
}
}
echo json_encode($returnArr);