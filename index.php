<?php
session_start();
include 'db.php';
$sql = "SELECT login_master.*, document.title,document.file FROM login_master JOIN document ON login_master.id = document.user_id where role ='2' ";
$result = mysqli_query($conn, $sql);

if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '1') {
    header("Location:user.php");
}
if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '2') {
    header("Location:document.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
      html,body { 
	height: 100%; 
}

.global-container{
	height:100%;
	display: flex;
	align-items: center;
	justify-content: center;
	/* background-color: #f5f5f5; */
    background: url('http://www.vanseodesign.com/blog/wp-content/uploads/2011/10/background-3.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}


.login-form{ 
	width:330px;
	margin:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

.alert{
	margin-bottom:30px;
	font-size: 13px;
	
}
#success,#error{
    display:none;
}
  </style>
</head>
<body>
<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<h3 class="card-title text-center">Login</h3>
		<div class="card-text">
			<div class="alert alert-danger alert-dismissible"  role="alert" id="error"></div>
            <div class="alert alert-success alert-dismissible" role="alert" id="success"></div>
			    <div class="form-group">
					<label for="exampleInputEmail1">Mobile No</label>
					<input type="text" class="form-control form-control-sm" id="mobile" placeholder="Mobile No" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">OTP</label>
					<a href="#" style="float:right;font-size:12px;" id="getOtp">GET OTP</a>
					<input type="text" class="form-control form-control-sm" id="otp" placeholder="OTP" required>
				</div>
				<button type="submit" class="btn btn-primary btn-block" id="getLogin">Login</button>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#getOtp").click(function () {
            var mobile = $("#mobile").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;

            if(mobile == ''){
                alert('Mobile Number is required');
                return false;
            }

            if(filter.test(mobile)) {
               if(mobile.length !=10){
                alert('Please put 10  digit mobile number');
                return false;
               }
            }
            else{
              alert('Mobile number is not a valid ');
              return false;
            }

            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {mobile:mobile},
                success: function (result) {
                    const myArr = JSON.parse(result);
                    if(myArr.status === 200){
                        $("#success").show();
                        $("#error").hide();
                        $("#success").text(myArr.msg);
                    }
                    else{
                        $("#error").show();
                        $("#success").hide();
                        $("#error").text(myArr.msg);
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#getLogin").click(function () {
            var mobile = $("#mobile").val();
            var otp = $("#otp").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;

            if(mobile == ''){
                alert('Mobile Number is required');
                return false;
            }
            if(otp == ''){
                alert('OTP is required');
                return false;
            }

            if(filter.test(mobile)) {
               if(mobile.length !=10){
                alert('Please put 10  digit mobile number');
                return false;
               }
            }
            else{
              alert('Mobile number is not a valid ');
              return false;
            }

            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {mobile:mobile,otp:otp},
                success: function (result) {
                    const myArr = JSON.parse(result);
                    //console.log(myArr.data.role); return false;
                    if(myArr.status === 200){
                        alert(myArr.msg);
                        if(myArr.data.role == '1'){
                            location.href = "user.php";
                        }
                        else{
                            location.href = "document.php";
                        }
                        
                    }
                    else{
                        alert(myArr.msg);
                    }
                }
            });
        });
    });
</script>
</body>
</html>
