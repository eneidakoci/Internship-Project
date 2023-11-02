
<?php

@include 'config.php';//including the file that connects with the database

if(isset($_POST['submit'])){
   $uname = mysqli_real_escape_string($conn, $_POST['uname']);
   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = mysqli_real_escape_string($conn, $_POST['lname']);

   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE username = '$uname' && password = '$pass' LIMIT 1";//regjistron vetem 1 me ate username


   $result = mysqli_query($conn, $select);
   

   if(mysqli_num_rows($result) > 0){//checking for errors

      $error[] = 'This user already exists!';

   }else{

      if($pass != $cpass){
         $error[] = 'Passwords do not match!';
      }else{
         $insert = "INSERT INTO user_form(fname, lname, username, password) VALUES('$fname', '$lname','$uname','$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

} else if(isset($_POST['reset'])){//the reset button deleting the data the user has already entered
   header('location:register_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Register Form</title>

   <!-- css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h2>Sign Up</h2>
      <label>Please fill the form to create an account.</label><br><br>
      <label><b>First Name</b></label><br>
      <input type="text" name="fname" required><br><br>
      <label><b>Last Name</b></label><br>
      <input type="text" name="lname" required><br><br>
      <label><b>Username</b></label><br>
      <input type="text" name="uname" required><br><br>
      <label><b>Password</b></label><br>
      <input type="password" name="password" required><br><br>
      <label><b>Confirm Password</b></label><br>
      <input type="password" name="cpassword" required><br><br>
      <input type="submit" name="submit" value="Submit" class="form-btn">
      <input type="submit" name="reset" value="Reset" class="form-btn" id="form-btn-reset">
      <p><br>Already have an account?  <a href="login_form.php">Login here.</a></p>
      <p>Are you the admin?  <a href="admin_login.php">Login here.</a></p>
   </form>
</div>

</body>
</html>