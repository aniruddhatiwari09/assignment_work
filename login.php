<?php
session_start();

include 'db.php';

$mobile = $_REQUEST['mobile'];
$otp = $_REQUEST['otp'];
$sql = "SELECT * FROM login_master where mobile_no = ".$mobile." AND otp = ".$otp." ";
$result = mysqli_query($conn, $sql);
$arr = array();
$row = mysqli_fetch_assoc($result);

if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '1') {
    header("Location:user.php");
}
if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '2') {
    header("Location:document.php");
}

if (mysqli_num_rows($result) == 0) {
    $arr = array("status"=>404,"count"=> mysqli_num_rows($result),"data"=>[],"msg"=>"Invalid OTP");
}
else{
	
	$token = md5(uniqid(rand(), true));
	
    preg_match_all('/(?<=\b)[a-z]/i',$row['name'],$matches);
    $word = strtoupper(implode('',$matches[0]));

    $_SESSION["sort_name"] = $word;
    $_SESSION["mobile_no"] = $row['mobile_no'];
    $_SESSION["name"] = $row['name'];
    $_SESSION["role"] = $row['role'];
    $_SESSION["id"] = $row['id'];
    $_SESSION["token"] = $token;

    $sql1 = "UPDATE login_master SET otp_verify ='1',otp = '',token = '".$token."'  where mobile_no = ".$mobile." AND otp = ".$otp." "; 
    $result1 = mysqli_query($conn, $sql1);
    $arr = array("status"=>200,"count"=> mysqli_num_rows($result),"data"=>['name'=>$row['name'],'mobile_no'=>$row['mobile_no'],'role'=>$row['role']],"msg"=>"Login Success");
}

echo json_encode($arr);
mysqli_close($conn);


?>