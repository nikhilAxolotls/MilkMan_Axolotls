<?php
require dirname(dirname(__FILE__)) . '/controller/mediconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if ($data['mobile'] == '' or $data['password'] == '' or $data['ccode'] == '') {
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!"
    );
} else {
    $mobile   = strip_tags(mysqli_real_escape_string($medi, $data['mobile']));
    $ccode    = strip_tags(mysqli_real_escape_string($medi, $data['ccode']));
    $password = strip_tags(mysqli_real_escape_string($medi, $data['password']));
    
    $chek   = $medi->query("select * from tbl_user where  (mobile='" . $mobile . "' or email='" . $mobile . "') and ccode='" . $ccode . "' and status = 1 and password='" . $password . "'");
    $status = $medi->query("select * from tbl_user where status = 1");
    if ($status->num_rows != 0) {
        if ($chek->num_rows != 0) {
            $c = $medi->query("select * from tbl_user where  (mobile='" . $mobile . "' or email='" . $mobile . "')  and ccode='" . $ccode . "' and status = 1 and password='" . $password . "'")->fetch_assoc();
            
            $returnArr = array(
                "UserLogin" => $c,
                "currency" => $set['currency'],
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Login successfully!"
            );
        } else {
            $returnArr = array(
                "ResponseCode" => "401",
                "Result" => "false",
                "ResponseMsg" => "Invalid Mobile Number Or Email Address or Password!!!"
            );
        }
    } else {
        $returnArr = array(
            "ResponseCode" => "401",
            "Result" => "false",
            "ResponseMsg" => "Your Status Deactivate!!!"
        );
    }
}

echo json_encode($returnArr);