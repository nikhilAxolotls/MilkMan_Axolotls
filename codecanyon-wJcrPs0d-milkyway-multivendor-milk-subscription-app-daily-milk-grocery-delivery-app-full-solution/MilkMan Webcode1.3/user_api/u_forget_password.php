<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$mobile = $data['mobile'];
$password = $data['password'];
$ccode = $data['ccode'];
if ($mobile =='' or $password =='' or $ccode == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $mobile = strip_tags(mysqli_real_escape_string($medi,$mobile));
	$ccode     = strip_tags(mysqli_real_escape_string($medi, $ccode));
    $password = strip_tags(mysqli_real_escape_string($medi,$password));
    
    $counter = $medi->query("select * from tbl_user where mobile='".$mobile."'");
    
   
    
    if($counter->num_rows != 0)
    {
  $table="tbl_user";
  $field = array('password'=>$password);
  $where = "where mobile=".$mobile."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Password Changed Successfully!!!!!");    
    }
    else
    {
     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"mobile Not Matched!!!!");  
    }
}

echo json_encode($returnArr);
