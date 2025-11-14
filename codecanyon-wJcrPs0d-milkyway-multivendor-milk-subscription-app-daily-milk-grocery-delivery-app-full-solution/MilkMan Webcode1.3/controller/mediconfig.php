<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $medi = new mysqli("localhost", "Usename", "Password", "Database");
  $medi->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  //Should be a message a typical user could understand
}
    
$set = $medi->query("SELECT * FROM `tbl_setting`")->fetch_assoc();

date_default_timezone_set($set['timezone']);
$data_set = $medi->query("SELECT * FROM `tbl_milk`")->fetch_assoc();	
	
	if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
			$sdata = $medi->query("SELECT * FROM `service_details` where email='".$_SESSION['mediname']."'")->fetch_assoc();
		}
	}
?>