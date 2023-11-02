<?php
//do jete tabela e adminit per te edituar dhe fshire users
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Admin Page</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">

<form action="" method="post" id="reject-form">
    <p>You are not the admin!</p>
 <p><a href="admin_login.php" id="reject1">Try again.</a></p>
 <p><a href="register_form.php" id="reject2">Register.</a></p>
 <p><a href="login_form.php" id="reject3">Log in as a user.</a></p>
</form>

</div>


</body>
</html>