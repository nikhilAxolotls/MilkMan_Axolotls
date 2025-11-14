<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['owner_id'] == '' or $data['amt'] == '' or $data['r_type'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$owner_id = $data['owner_id'];
	$amt = $data['amt'];
	$r_type = $data['r_type'];
	$acc_number = $data['acc_number'];
	$bank_name = $data['bank_name'];
	$acc_name = $data['acc_name'];
	$ifsc_code = $data['ifsc_code'];
	$upi_id = $data['upi_id'];
	$paypal_id = $data['paypal_id'];
	
	$sales  = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as full_total from tbl_normal_order where status='Completed'  and  store_id=".$owner_id."")->fetch_assoc();
	
	$without_cod = empty($sales['full_total']) ? 0 : $sales['full_total'];

	$final_normal = floatval($without_cod);
	
	
	$psales  = $medi->query("select sum((subtotal-cou_amt+d_charge) - ((subtotal-cou_amt+d_charge) * commission/100)) as full_total from tbl_subscribe_order where status='Completed'  and  store_id=".$owner_id."")->fetch_assoc();
	
	$pwithout_cod = empty($psales['full_total']) ? 0 : $psales['full_total'];
	
	$final_prescription = floatval($pwithout_cod);
	
	
            $payout =   $medi->query("select sum(amt) as full_payout from payout_setting where owner_id=".$owner_id."")->fetch_assoc();
			$finalpayout = empty($payout['full_payout']) ? 0 : $payout['full_payout'];
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){}else {$bs = number_format((float)($final_normal + $final_prescription)- $finalpayout, 2, '.', ''); }
				 
				 
				 if(floatval($amt) > floatval($set['pstore']))
				 {
					$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Withdraw Limit!"); 
				 }
				 else if(floatval($amt) > floatval($bs))
				 {
					 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Earning!"); 
				 }
				 else 
				 {
					 $timestamp = date("Y-m-d H:i:s");
					 $table="payout_setting";
  $field_values=array("owner_id","amt","status","r_date","r_type","acc_number","bank_name","acc_name","ifsc_code","upi_id","paypal_id");
  $data_values=array("$owner_id","$amt","pending","$timestamp","$r_type","$acc_number","$bank_name","$acc_name","$ifsc_code","$upi_id","$paypal_id");
  
      $h = new Medico();
	  $check = $h->mediinsertdata_Api($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Request Submit Successfully!!");
				 }
}
echo json_encode($returnArr);
?>