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
 
$target_path = "upload/";
$filename = time().'_'.basename( $_FILES['file']['name']);  
$target_path = $target_path.$filename;   

$sql = "INSERT INTO document(`title`,`user_id`,`file`,`created_at`) VALUES ('".$_REQUEST['title']."','".$_REQUEST['user_id']."','".$filename."','".date('Y-m-d H:i:s')."')"; 
$result = mysqli_query($conn, $sql);
if($result){
    move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
    echo json_encode(["status"=>200,"msg"=>'Data has been inserted']);
}
else{
    echo json_encode(["status"=>404,"msg"=>'Data not inserted']);
}
 }
}
?>