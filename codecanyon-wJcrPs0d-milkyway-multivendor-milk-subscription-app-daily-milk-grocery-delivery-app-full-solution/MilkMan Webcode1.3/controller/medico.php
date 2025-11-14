<?php 
require 'mediconfig.php';
$GLOBALS['medi'] = $medi;
class Medico {
 

	function medilogin($username,$password,$tblname) {
		
		if($tblname == 'admin')
		{
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['medi']->query($q)->num_rows;
		}
		else 
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."'";
	return $GLOBALS['medi']->query($q)->num_rows;
		}
		
	}
	
	function mediinsertdata($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['medi']->query($sql);
  return $result;
  }
  
  
function str_replace_first($search, $replace, $subject)
{
    $search = '/'.preg_quote($search, '/').'/';
    return preg_replace($search, $replace, $subject, 1);
}

  function medizoneinsertdata($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);
$data_values=$this->str_replace_first("','",",'",$data_values)."'"; 
    $sql = "INSERT INTO $table($field_values)VALUES($data_values)";
    $result=$GLOBALS['medi']->query($sql);
  return $result;
  }
  
  function insmulti($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['medi']->multi_query($sql);
  return $result;
  }
  
  function mediinsertdata_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['medi']->query($sql);
  return $GLOBALS['medi']->insert_id;
  }
  
  function mediinsertdata_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['medi']->query($sql);
  return $result;
  }
  
  function mediinsertdata_Api_Id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['medi']->query($sql);
  return $GLOBALS['medi']->insert_id;
  }
  
  function mediupdateData($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
			
           $cols[] = "$key = '$val'"; 
			
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['medi']->query($sql);
    return $result;
  }
  
  
  function medizoneupdateData($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
			if($key == 'coordinates')
			{
				$cols[] = "$key = $val"; 
			}
			else 
			{
           $cols[] = "$key = '$val'"; 
			}
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['medi']->query($sql);
    return $result;
  }
  
   function mediupdateData_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['medi']->query($sql);
    return $result;
  }
  
  
  
  
  function mediupdateData_single($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['medi']->query($sql);
  return $result;
  }
  
  function mediDeleteData($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['medi']->query($sql);
  return $result;
  }
  
  function mediDeleteData_Api($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['medi']->query($sql);
  return $result;
  }
 
}
?>