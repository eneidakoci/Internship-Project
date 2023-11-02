<?php

include 'config.php';

session_start();
$fname = $lname = $username="";
if(isset($_POST['submit'])){
   $fname = @mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = @mysqli_real_escape_string($conn, $_POST['lname']);
   $username = @mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password']);//md5() in order to keep the password safe
   $cpass = @md5($_POST['cpassword']);

   if(empty($username) || empty($pass)){
      echo 'Please make sure to complete each field!';
    }

   $select = " SELECT * FROM user_form WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      header('location:admin_page.php');
   }else{
      ?>
      <script>
         alert('Wrong username or password. Try again');
      </script>
      <?php
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <!-- the css file link  -->
   <link rel="stylesheet" href="style1.css?">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post" id="login-form">
      <h2 id="h2-login">Login</h2>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <label><b>Username:</b></label><br>
      <input type="text" name="username" required><br><br>
      <label><b>Password:</b></label><br>
      <input type="password" name="password" required><br><br>
      <input type="submit" name="submit" value="Login" class="form-btn"><br><br>
      <p>Do not have an account?  <a href="index.php">Sign up here.</a></p><br>
   </form>
</div>

</body>
</html>