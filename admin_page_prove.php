<?php
//do jete tabela e adminit per te edituar dhe fshire users
// fshirja e nje useri duke mbajtur username
include 'config.php';

    if(isset($_POST['user_delete'])){
      $uname = $_POST['user_delete'];
      $query = "DELETE FROM user_form WHERE username='$uname' ";
      $query_run = mysqli_query($conn, $query);
    }
   
    $select = "select * from user_form";
    $query=mysqli_query($conn, $select);
?>

<!-- exporting to excel me PHP nqs klikohet butoni export -->
<?php
    if(isset($_POST['export'])){
      //SimpleXLSXGen library
    include 'SimpleXLSXGen.php';
    $users = [
      ['fname', 'lname', 'username', 'status', 'created', 'updated']
    ];
    $sql = "SELECT * FROM user_form";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
      foreach ($res as $row) {
        $users = array_merge($users, array(array($row['fname'], $row['lname'], $row['username'], $row['status'], $row['created'], $row['updated'])));
      }
    }
    $xlsx = SimpleXLSXGen::fromArray($users);
    $xlsx->downloadAs('users.xlsx'); // per te downloaduar file tek sistemi lokal me emrin users
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Admin Page</title>
  <!-- the css file link  -->
  <link rel="stylesheet" href="style1.css?">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

  <!-- kodi per divin dhe selelct result -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--ajax link-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  
   <!-- qe te funksionojne links lart -->
    <script>
        $(document).ready(function() {    
            $('#myTable').DataTable( {
                dom: 'Bfrtip',
                stateSave: true,
                buttons: [
                    'colvis'
                ]
            } );
        } );
</script>

</head>

<body>
  <?php echo '<h4 id="h1-admin">Admin Page</h4>'; ?>
  <div id="flip" style="cursor:pointer"><b>Select Results</b></div><br>

  <div id="panel" style="height:400px">
    <!--select and deselect-->
    <div class="container" style=" padding:2rem; cursor:pointer">
        <div class="row row1">
            <div class="col-md-12">
                <div class="panel panel-default">
                   
                  </div>
            </div>
        </div>
        <div class="content"> 
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <button class="addAll">Select All</button> /
						             <button class="removeAll">Deselect All</button>
                        <br>
                        <input id="someinput" placeholder="Search..." style="width:80%">
                          <br />
                          <select multiple="true" id="select1" class="select_page" style="width:80%; overflow:auto;" class="operator">
                            <option value="fname">fname</option>
                            <option value="lname">lname</option>
                            <option value="username">username</option>
                            <option value="status">status</option>
                            <option value="created">created</option>
                            <option value="updated">updated</option>
                          </select>
                          </input>
                          <br>
                    </div>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <button class="addAll"></button> 
						             <button class="removeAll"></button>
                        <br>
                        <input id="someinput1" placeholder="Search..." style="width:80%">
                          <br />
                          <select multiple="true" id="select2" class="select_page1" style="width:80%; overflow:auto" class="operator">
                        </select>
                        <br>
                    </div>
                  </div>
            </div>
        </div>
        </div>
  </div>
    
  </div>


  <form action="admin_page_prove.php" method="post" style="border:none;" >
  <div id="excel-export" style="text-align:center;float:right">
      <input type="submit" name="export" class="btn btn-success" value="Export To Excel" style="float:left;margin-left:7px; text-decoration:none; text-align:center;" />
      <p><br></p>
   </div>
      <br><br>
  <a href="login_form.php" style="float:right;text-decoration:none;background:#eee;padding: 8px 42px;border-radius: 5px; border:1px solid grey "> <b>Logout</b></a>
  <br>
  </form>
<br>
<div id="new-table1"></div> <!--ketu do afishohet tabela e re -->

<div id="new-table">
 <table border="1" id="myTable" class="table table-hover" class="display" style="background:rgb(240, 245, 235)">
  <thead>
    <tr>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Username </th>
      <th scope="col">Status</th>
      <th scope="col">Created</th>
      <th scope="col">Updated</th>
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
              <td id="status">
                <?php 
                if($row['status']=='Enabled'){
                  echo '<p style="color:rgb(0, 119, 255)"> Enabled</p>';
                }else{
                  echo '<p style="color:crimson"> Disabled</p>';
                }
                ;?>
              </td>
              <td><?= $row['created'];?></td>
              <td><?= $row['updated'];?></td>
              <td>
              <form action="modify.php" method="POST" style="border:none;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" name="modifyy" value="Edit" id="btn-edit"
                style="cursor:pointer;background-color: orange; padding:8px; border-radius:5px; text-decoration:none; color:#fff">          
              </td>
              </form>
          <td>
            <form action="admin_page_prove.php" method="POST" style="border:none;">
              <button type="submit" style="background-color: crimson; padding:8px; border-radius:5px; text-decoration:none; color:#fff;cursor:pointer; border-style:none" name="user_delete" value="<?=$row['username'];?>">Delete</button>
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

<script>
    $(document).ready(function(){
        let selectedOptions = [];
        
        $("#flip").click(function() {
          $("#panel").slideToggle();
        });

      $('.addAll').on('click', function() { 
        $('#select1 option').each(function() {
          $('#select2').append(`<option value="${this.value}">${this.value}</option>`);
          $(this).remove();
        });
      });
      $('.addAll').on('click', function() {
          selectedOptions.push('fname', 'lname', 'username', 'created', 'updated', 'status');
           localStorage.setItem('cols', selectedOptions);
           document.getElementById('new-table').style.display='block';
      });

      $('.removeAll').on('click', function() {
        $('#select2 option').each(function() {
          $('#select1').append(`<option value="${this.value}">${this.value}</option>`);
          $(this).remove();
          localStorage.setItem('cols', selectedOptions);
        });
      });
      $('.removeAll').on('click', function() {
        selectedOptions = [];
           localStorage.setItem('cols', selectedOptions);
           document.getElementById('new-table').style.display='none';
           document.getElementById('new-table1').style.display='none';
      });
    });

    // search
    $(function () {
              let selectedOptions = [];
              opts = $('#select1 option').map(function () {
                return [[this.value, $(this).text()]];
              });
              opts2 = $('.select_page option:selected').map(function () {
                return [[this.value, $(this).text()]];
              });

              //search ne select
        $(function () {
          const input2 = document.getElementById('someinput').addEventListener('keyup', function(){
          const inp =document.getElementById('someinput');
          const filter= inp.value.toLowerCase();
          const select = document.getElementById('select1');


        for (let k = 0; k <select.length; k++) {
          if (select[k].innerHTML.toLowerCase().indexOf(filter) > -1) {
            select[k].style.display="";
          }
            else{
              select[k].style.display="none";
            }

        }
        }); 

        $('#select1').on('change', function() {
          selectedOptions.push(this.value);
          $('#select2').append(`<option value="${this.value}">${this.value}</option>`);
          $(`.select_page option:selected`).remove();
              opts = $('#select1 option').map(function () {
                  return [[this.value, $(this).text()]];
              });
              if(localStorage)
                  localStorage.setItem('cols',selectedOptions);
        });
          
  });

  //search ne select-in e dyte
  $(function () {
    const input2 = document.getElementById('someinput1').addEventListener('keyup', function(){
    const inp =document.getElementById('someinput1');
    const filter= inp.value.toLowerCase();
    const select = document.getElementById('select2');


    for (let k = 0; k <select.length; k++) {
      if (select[k].innerHTML.toLowerCase().indexOf(filter) > -1) {
        select[k].style.display="";
      }
        else{
          select[k].style.display="none";
        }

    }
    }); 

    $('#select2').on('change', function() {
      let itemToRemove = this.value;
        selectedOptions.splice($.inArray(itemToRemove, selectedOptions), 1);
        $('#select1').append(`<option value="${this.value}">${this.value}</option>`);
        $(`#select2 option[value="${this.value}"]`).remove();
        localStorage.setItem('cols', selectedOptions);
    });
    
  });
  
  });

    let info = localStorage.getItem('cols');
      if (info.length > 0) {
        $.ajax({
          url: 'customSearch.php',
          method: 'POST',
          data: {
            info: info
          },
          async: true,
          success: function(data) {
              $('#new-table').html(data);
             // $("#new-table").hide(data);
          }
          });
      }
</script>

</body>
</html>