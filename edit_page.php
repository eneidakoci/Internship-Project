<?php

@include 'config.php';

if(isset($_POST['modify'])){
    $uname = $_POST['username'];
    $pass = md5($_POST['password']);
    $query = "UPDATE user_form SET fname='$_POST[fname]', lname='$_POST[lname]', password='$pass', updated=now() WHERE username='$_POST[username]'";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        ?>
      <script> alert("Data has been modified!");</script>
   <?php
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
   <title>Edit user data</title>

   <!-- the css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" id="login-form">
      <h2 id="h2-login">Modify</h2>
      <?php
         
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };

      ?>

      <label><b>New First Name:</b></label><br>
      <input type="text" name="fname" required><br><br>
      <label><b>New Last Name:</b></label><br>
      <input type="text" name="lname" required><br><br>
      <label><b>New Password:</b></label><br>
      <input type="password" name="password" required><br><br>
      <label><b>Confirm New Password:</b></label><br>
      <input type="password" name="cpassword" required><br><br>
      <label><b>Username:</b></label><br>
      <input type="text" name="username" required ><br><br>
      <input type="submit" name="modify" value="Modify" class="form-btn" style = "color:white; text-align:center; display:block; width:100%"><br><br>
      <p><a href="admin_page.php">Go back to the admin page.</a></p><br>
     
   </form>

</div>

</body>
</html>