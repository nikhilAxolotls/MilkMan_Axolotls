<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
$uid = $data['uid'];
$store_id = $data['store_id'];
if($uid == '' or $store_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
 $check = $medi->query("select * from tbl_fav where uid=".$uid." and store_id=".$store_id."")->num_rows;
 if($check != 0)
 {
      
	  
	  $table="tbl_fav";
$where = "where uid=".$uid." and store_id=".$store_id."";
$h = new Medico();
	$check = $h->mediDeleteData_Api($where,$table);
	
      $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Store Successfully Removed In Favourite List !!");
	  
 }
 else 
 {
     $getzone = $medi->query("select zone_id from service_details where id=".$store_id."")->fetch_assoc();
	 $zone_id = $getzone['zone_id'];
	 $table="tbl_fav";
  $field_values=array("uid","store_id","zone_id");
  $data_values=array("$uid","$store_id","$zone_id");
  $h = new Medico();
  $check = $h->mediinsertdata_Api($field_values,$data_values,$table);
   $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Store Successfully Saved In Favourite List!!!");
   
    
 }
}
echo json_encode($returnArr);
?>