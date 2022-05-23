<?php
session_start();
include 'db.php';
$sql = "SELECT * FROM login_master where role ='2' ";
$result = mysqli_query($conn, $sql);

if(!isset($_SESSION["mobile_no"])) {
  header("Location:index.php");
}

if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '2') {
  header("Location:document.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>

<div class="container mt-2">
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav" style="float:right;">
    <li class="nav-item active">
      <a class="nav-link" style="border: 1px solid aliceblue;border-radius: 138%;"><?php echo $_SESSION["sort_name"]; ?></a>
    </li>
    <li class="nav-item active" style='margin-left:5%;'>
     <a class="nav-link" href="#"><b><?php echo $_SESSION["name"]; ?></b></a>
    </li>
    <li class="nav-item active" style='margin-left:5%;'>
      <a class="nav-link btn btn-warning"   data-toggle="modal" data-target="#myModal" ><b>+User</b></a>
    </li>
    <li class="nav-item active" style='margin-left:5%;'>
      <a class="nav-link" href="logout.php"><b>Logout</b></a>
    </li>
    
  </ul>
</nav>
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background: lightgreen;">
            <h4 class="modal-title" id="title">Add User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <div class="container mt-3">
               <div class="mb-3 mt-3">
                     <label for="name">Name:</label>
					  <input type="hidden" id="token" name="token" class="form-control" value="<?php echo $_SESSION["token"]; ?>">
                     <input type="text" id="name" class="form-control"  placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="pwd">Mobile:</label>
                    <input type="text" id="mobile" class="form-control"  placeholder="Enter mobile">
                </div>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-info" id="savedata">Save Data</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<table class="mt-2" style="width:100%">
<thead>
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Created Date</th>
  </tr>
</thead>
<tbody>
    <?php
    $i = 1;
      while($row = mysqli_fetch_assoc($result)) {
      $status = ($row['status'] == 1 ? 'Active':'Deactive');
    ?>
      <tr>
        <td> <?php echo $i++; ?> </td>
        <td> <?php echo $row['name']; ?> </td>
        <td> <?php echo $row['mobile_no']; ?> </td>
        <td> <?php echo $status; ?> </td>
        <td> <?php echo $row['created_at']; ?> </td>
    </tr>

    <?php }?>
</tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
      $("#savedata").click(function () { 
            var name = $("#name").val();
            var mobile = $("#mobile").val();
			var token = $("#token").val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if(name =='' || mobile ==''){
                alert('All field is required');  return false;
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
                url: 'add_user.php',
                type: 'POST',
                data: {name:name,mobile:mobile,token:token},
                success: function (result) {
                    const myArr = JSON.parse(result);
                    alert(myArr.msg);
                 if(myArr.msg == 'Token mismatch')
					{
                         location.href = "logout.php";
					}
					else
					{
						 location.reload(true);
					}
                },
                error: function (err){
                    alert("Something Error");
                }
            });
        });
    });
</script>

</div>
</body>
</html>
