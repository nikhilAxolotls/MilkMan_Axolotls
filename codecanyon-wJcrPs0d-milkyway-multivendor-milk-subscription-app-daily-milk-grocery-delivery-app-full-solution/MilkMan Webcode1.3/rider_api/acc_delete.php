<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['rider_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $rider_id = $data['rider_id'];  
   $table = "tbl_rider";
            $field = "status=0";
            $where = "where id=" . $rider_id . "";
            $h = new Medico();
            $check = $h->mediupdateData_single($field, $table, $where);
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Account Delete Successfully!!");
}
echo  json_encode($returnArr);
?>