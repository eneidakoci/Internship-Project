<?php
//do jete tabela e adminit per te edituar dhe fshire users
include 'config.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$password=$_POST['password'];
$sql = "select * from admin_table where password ='$password'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
if($row['password'] == $password){
    header("location:admin_page.php");
}else{
    header("location:not_admin.php");
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Admin Page</title>

   <!-- the css file link  -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
<div class="form-container">

   <form action="" method="post">
      <h2 id="admin-login">Admin Log In</h2><br>
      <label><b>Admin Username:</b></label><br>
      <input type="text" name="username" value="<?php
    $sql = 'Select * from admin_table';
    $result=mysqli_query($conn, $sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        echo $row['email'];
    }
?>"readonly><br><br>
      <label><b>Password:</b></label><br>
      <input type="password" name="password" required><br><br>
      <input type="submit" name="submit" value="Login" class="form-btn"><br><br>
      <p>Are you not the admin?  <a href="login_form.php">Log in as a user here.</a></p><br>
      <p>Do not have an account?  <a href="register_form.php">Sign up here.</a></p>
   </form>

</div>
  
</body>
</html>