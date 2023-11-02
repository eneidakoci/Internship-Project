<?php

include 'config.php';//perfshirja e file qe ben lidhjen me DB

   if(isset($_POST['submit'])){

      $fname = mysqli_real_escape_string($conn, $_POST['fname']);
      $lname = mysqli_real_escape_string($conn, $_POST['lname']);
      $uname = mysqli_real_escape_string($conn, $_POST['uname']);
      $pass = md5($_POST['password']);
      $cpass = md5($_POST['cpassword']);

      //validimet
      if(empty($fname) || empty($lname) || empty($uname) || empty($pass) ||empty($cpass)){
        echo 'Please make sure to complete each field!';
      }

      $select = " SELECT * FROM user_form WHERE username = '$uname' LIMIT 1";//REGJISTRON VETEM NJE PERSON ME ATE USERNAME

      $result = mysqli_query($conn, $select);//running the mysql code

      if(mysqli_num_rows($result) > 0){//checking for errors

         $error[]= 'This user already exists!';
         ?>
         <script> alert("This username is taken. Please choose another one!");</script>
   <?php
      }else{
         if($pass != $cpass){
            $error[] = 'Passwords do not match!';
         }else{
            $insert = "INSERT INTO user_form(fname, lname, username, password) VALUES('$fname', '$lname','$uname','$pass')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');//ta coje te login_form
         }
      }
   }if(isset($_POST['reset'])){//the reset button deleting the data the user has already entered
      header('location:index.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Register Form</title>

   <!-- css file link  -->
   <link rel="stylesheet" href="style1.css">

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
   </form>
</div>

</body>
</html>