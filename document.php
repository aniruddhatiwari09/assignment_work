<?php
session_start();
include 'db.php';
$sql = "SELECT login_master.*, document.title,document.file FROM login_master JOIN document ON login_master.id = document.user_id where role ='2' ";
$result = mysqli_query($conn, $sql);

if(!isset($_SESSION["mobile_no"])) {
  header("Location:index.php");
}
if(isset($_SESSION["mobile_no"]) && $_SESSION["role"] == '1') {
  header("Location:user.php");
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
      <a class="nav-link btn btn-warning"   data-toggle="modal" data-target="#myModal" ><b>+Document</b></a>
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
            <h4 class="modal-title" id="title">Add Document</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <form   id="form_data" method="post" enctype="multipart/form-data">  
         <div class="modal-body">
            <div class="container mt-3">
               <div class="mb-3 mt-3">
                     <label for="name">Title:</label>
					 <input type="hidden" id="token" name="token" class="form-control" value="<?php echo $_SESSION["token"]; ?>">
                     <input type="text" id="title" name='title' class="form-control"  placeholder="Enter title" required>
                     <input type="hidden" id="user_id" name='user_id' value="<?php echo $_SESSION["id"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="pwd">Document:</label>
                    <input type="file" id="file" name='file' class="form-control"  placeholder="Enter document" required>
                </div>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="submit" class="btn btn-info" id="savedata">Upload Document</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
        </form>
      </div>
   </div>
</div>

<table class="mt-2" style="width:100%">
<table class="mt-2" style="width:100%">
<thead>
  <tr>
    <th>#</th>
    <th>Title</th>
    <th>Status</th>
    <th>Document</th>
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
        <td> <?php echo $row['title']; ?> </td>
    
        <td> <?php echo $status; ?> </td>
        <td><a href='upload/<?php echo $row['file']; ?>' target="_blank"><?php echo $row['file']; ?></a></td>
        <td> <?php echo $row['created_at']; ?> </td>
    </tr>

    <?php }?>
</tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type = "text/javascript" >
    $(document).ready(function(e) {
        $('#form_data').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'add_document.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (result) => {
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
					
                    alert("Unauthorized Access");
					 location.href = "logout.php";
                }
            });
        });
    }); 
</script>

</div>
</body>
</html>
