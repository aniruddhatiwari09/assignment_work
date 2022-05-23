<?php

include 'db.php';

$mobile = $_REQUEST['mobile'];
$sql = "SELECT * FROM login_master where mobile_no = ".$mobile."";
$result = mysqli_query($conn, $sql);
$arr = array();
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 0) {
    $arr = array("status"=>404,"msg"=>"Invalid mobile number or Not Register number");
}
else{
    
    $otp = mt_rand(100000,999999);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://mysmsshop.in/V2/http-api.php?apikey=xa1szVetgLtUgggf&senderid=ONEESM&format=json&template=1207161795723936542&route=1&number=91'.$mobile.'&message='.$otp.'%20is%20your%20One%20Time%20Password%20for%20login%20and%20only%20valid%20for%205%20minutes.%20Please%20DO%20NOT%20share%20this%20OTP%20with%20anyone.',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=ee1dogpven9qionbauf35slbg3'
  ),
));

 $response = curl_exec($curl);

curl_close($curl);

    $sql1 = "UPDATE login_master SET otp =".$otp.", otp_verify ='0' where mobile_no = ".$mobile."";
    $result1 = mysqli_query($conn, $sql1);
    $arr = array("status"=>200,"msg"=>"Enter the One Time Password (OTP) sent to your mobile number ".$mobile);
}

echo json_encode($arr);
mysqli_close($conn);


?>