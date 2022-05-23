<?php
session_start();
include 'db.php';
error_reporting(0);
unset($_SESSION["mobile_no"]);
unset($_SESSION["name"]);
unset($_SESSION["role"]);
unset($_SESSION["sort_name"]);
unset($_SESSION["id"]);

    $sql1 = "UPDATE login_master SET token = ''  where id = '".$_SESSION["id"]."' "; 
    $result1 = mysqli_query($conn, $sql1);

header("Location:index.php");
?>