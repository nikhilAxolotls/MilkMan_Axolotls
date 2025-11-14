<?php 
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
require dirname(dirname(__FILE__)) . '/controller/medico.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['password'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags(mysqli_real_escape_string($medi,$data['name']));
    
     $password = strip_tags(mysqli_real_escape_string($medi,$data['password']));
	 
$uid =  strip_tags(mysqli_real_escape_string($medi,$data['uid']));
$checkimei = $medi->query("select * from tbl_user where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_user";
  $field = array('name'=>$name,'password'=>$password);
  $where = "where id=".$uid."";
$h = new Medico();
	  $check = $h->mediupdateData_Api($field,$table,$where);
	  
            $c = $medi->query("select * from tbl_user where  `id`=".$uid."")->fetch_assoc();
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);