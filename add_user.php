<?php
include 'db.php';

$token = $_REQUEST['token'];

if(isset($token) AND $token != '')
{
  $sqlt = "SELECT * FROM login_master where token = '".$_REQUEST['token']."' ";
 $resultt = mysqli_query($conn, $sqlt);
	
 if (mysqli_num_rows($resultt) == 0) {
	echo json_encode(["status"=>404,"msg"=>'Token mismatch']);
	exit;
 }
 else
 {
 

$sql = "INSERT INTO login_master(`name`,`mobile_no`,`created_at`) VALUES ('".$_REQUEST['name']."','".$_REQUEST['mobile']."','".date('Y-m-d H:i:s')."')"; 
$result = mysqli_query($conn, $sql); 
if($result){
    echo json_encode(["status"=>200,"msg"=>'Data has been inserted']);
}
else{
    echo json_encode(["status"=>404,"msg"=>'Data not inserted']);
}
}
}

?>