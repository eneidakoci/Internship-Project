<?php

$conn = @mysqli_connect('localhost','root','','task1_db', 3307);//including the file that connects with the database
$id = $_POST['id'];
$query = "SELECT * FROM user_form WHERE id='$id'";
$query_run = mysqli_query($conn, $query);

if($query_run){
    while($row = mysqli_fetch_array($query_run)){
        $id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $uname = $row['username'];
    ?>  
 <div class="form-container">
   <form action="" method="post">
   <h2>Modify</h2>
      <br>
      <label><b>User List</b></label><br>
      <input type="hidden" name="id" value="<?php echo $row['id'];?>">
      <select style="width:50%">
      <option value=<?php echo $fname." ".$lname;?> ><?php echo $fname." ".$lname;?></option>
      </select><br><br>

      <label><b>New First Name</b></label><br>
      <input type="text" name="fname" value="<?php echo $row['fname'];?>" placeholder="Enter new name" required style="width:50%"> <br><br>
      <label><b>New Last Name</b></label><br>
      <input type="text" name="lname" value="<?php echo $row['lname'];?>" placeholder="Enter new last name" required style="width:50%"><br><br>
     
      <label><b>New Password</b></label><br>
      <input type="password" name="password" required placeholder="Enter new password" style="width:50%"><br><br>
      <label><b>Confirm New Password</b></label><br>
      <input type="password" name="cpassword" placeholder="Confirm new password" required style="width:50%"><br><br>
      <label><b>Username</b></label><br>
      <input type="text" name="uname" value="<?php echo $row['username'];?>" readonly style="width:50%"><br><br>
      <input type="submit" name="modify" value="Modify Account" class="form-btn" style = "color:white; text-align:center; display:block; width:100%"><br>
      <p>Finished editing? <a href="admin_page.php">Go back.</a></p><br>
    </form>
</div>

<?php
    }
}else{
    echo '<script> alert("NO RECORD FOUND");</script>';
}
?>

<?php
if(isset($_POST['modify'])){
    $fname =  $_POST['fname'];
    $lname =$_POST['lname'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $query="UPDATE user_form SET fname='$_POST[fname]', lname='$_POST[lname]', password='$pass', updated=now() WHERE username='$uname'";
    $query_run = mysqli_query($conn, $query);
    if($query_run){
        ?>
          <script> alert("Data has been modified!");</script>
          <?php
          header("location:admin_page.php");
          }
          else{
          ?>
          <script> alert("Data was unable to be modified!");</script>
       <?php
       }
 } 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Register Form</title>

   <!-- css file link  -->
   <link rel="stylesheet" href="style1.css?">

</head>
<body>
  
</body>
</html>