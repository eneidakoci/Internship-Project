<?php
//do jete tabela e adminit per te edituar dhe fshire users
// fshirja e nje useri duke mbajtur username
include 'config.php';

    if(isset($_POST['user_delete'])){
      $uname = $_POST['user_delete'];
      ?>
      <script>
        function myFunction() {
          let text = "Are you sure you want to delete this user?";
          if (confirm(text) == true) {
           <?php
           $query = "DELETE FROM user_form WHERE username='$uname' ";
           $query_run = mysqli_query($conn, $query);
          ?>
          } if(confirm(text) == false) {
            alert('You canceled!');
            return false;
          }
        }
        </script>
        <?php
    }
     
    $select = "select * from user_form";
    $query=mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Admin Page</title>
  <!-- the css file link  -->
  <link rel="stylesheet" href="style1.css?">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
  <?php echo '<h4 id="h1-admin">Admin Page</h4>'; ?>
  <hr>
  <br>
  <form action="index.php" style="border:none;">
  <label>Click '+' to add product.</label>
    <button id='shtoUser'> + </button>
  </form>
  
  <form action="" method="post" style="border:none;" >
  <a href="login_form.php" style="float:right;text-decoration:none;background:#eee;padding: 8px 42px;border-radius: 5px; border:1px solid grey "> <b>Logout</b></a>
  <br>
  </form>
<br>

<div id="new-table">
 <table border="1" id="myTable" class="table table-hover" class="display" style="background:rgb(240, 245, 235)">
  <thead>
    <tr>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Username </th>
      <th scope="col">Modify User</th>
      <th scope="col">Delete User</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      $query = "SELECT * FROM user_form";
      $query_run = mysqli_query($conn, $query);
      if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
          $uname=$row['username'];
          $fname=$row['fname'];
          $lname=$row['lname'];     
            ?>
            <tr>       
              <td><?= $row['fname'];?> </td>
              <td><?= $row['lname'];?></td>
              <td><?= $row['username'];?></td>
              <td>
              <form action="modify.php" method="POST" style="border:none;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" name="modifyy" value="Edit" id="btn-edit"
                style="cursor:pointer;background-color: orange; padding:8px; border-radius:5px; text-decoration:none; color:#fff">          
              </td>
              </form>
          <td>
            <form action="admin_page.php" method="POST" style="border:none;">
              <button type="submit" style="background-color: crimson; padding:8px; border-radius:5px; text-decoration:none; color:#fff;cursor:pointer; border-style:none" onclick='myFunction()' name="user_delete" value="<?=$row['username'];?>">Delete</button>
              </td>
            </tr>
            </form>
            <?php
        }
      }
      ?>
  </tbody>
</table> 
</div>

</body>
</html>