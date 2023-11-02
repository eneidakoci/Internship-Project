<?php
//do jete tabela e adminit per te edituar dhe fshire users
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
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

    <!-- kodi per divin dhe selelct result -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<script>
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle();
  });
});
</script>

<script>
$(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
</script>
<style>
#panel, #flip {
  padding: 7px;
  background-color: #e5eecc;
  border: solid 1px #c3c3c3;
}

#panel {
  padding: 20px;
  display: none;
}
select{
overflow:auto;
border-radius:5px;
padding:9px;
}
#someinput, #someinput1{
	border-radius:7px;
	border:1px solid gray;
	padding:6px;
  background:#eee;
}
.addAll, .removeAll{
background:none;
color:rgb(50,80,250);
border:none;
cursor:pointer;
}

</style>
</head>

<body>
  <?php
    echo '<h4 id="h1-admin">Admin Page</h4>';
  ?>
  <div id="flip" style="cursor:pointer"><b>Select Results</b></div>

<div id="panel" style="height:400px">
<!--select and deselect-->
<button class="addAll">Select All</button> / 
<button class="removeAll">Deselect All</button>
<br>

<script>
$('.addAll').on('click', function() {
    var options = $('select.select_page option').sort().clone();
    $('select.select_page1').append(options);
    $('select.select_page').empty();
});

$('.removeAll').on('click', function() {
 var options = $('select.select_page1 option').sort().clone();
 $('select.select_page').append(options);
    $('select.select_page1').empty();
});

</script>

<input id="someinput" placeholder="Search..." style="width:35%">
<br/>
<select multiple="true" id="select1" class="select_page" style="width:35%; overflow:auto" class="operator">
<option value="First Name">First Name</option>
<option value="Last Name">Last Name</option>
<option value="Username">Username</option>
<option value="Status">Status</option>
<option value="Created">Created</option>
<option value="Updated">Updated</option>
</select>
</input>
<br/><br>
<input id="someinput1" placeholder="Search..." style="width:35%"/><br/>

<select multiple id="select2" class="select_page1" style="width:35%;" class="operator">
</select>

</div>

<script>
//search per select1, kalimi te select2 kur selektohet, dhe nga s2 te s1 kur selektohet prape
$(function () {
	opts = $('#select1 option').map(function () {
        return [[this.value, $(this).text()]];
    });


    $('#someinput').keyup(function () {
        
        var rxp = new RegExp($('#someinput').val(), 'i');
        var optlist = $('#select1').empty();
        opts.each(function () {
            if (rxp.test(this[1])) {
                optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
            } else{
                optlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass("hidden"));
            }
        });
        $(".hidden").toggleOption(false);
    
    });
   
$('.select_page').click(function () {
        $('.select_page option:selected').remove().appendTo('.select_page1');
        opts = $('#select1 option').map(function () {
            return [[this.value, $(this).text()]];
        });
       
    var elements = document.getElementById("select1").options;

    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
    }

    });


});
 
jQuery.fn.toggleOption = function( show ) {
    jQuery( this ).toggle( show );
    if( show ) {
        if( jQuery( this ).parent( 'span.toggleOption' ).length )
            jQuery( this ).unwrap( );
    } else {
        if( jQuery( this ).parent( 'span.toggleOption' ).length == 0 )
            jQuery( this ).wrap( '<span class="toggleOption" style="display: none;" />' );
    }
}; 

///////////////search per select2 dhe kalimi te select 1 kur selektohet te select2//////////////////////////
$(function () {
	opts = $('#select2 option').map(function () {
        return [[this.value, $(this).text()]];
    });


    $('#someinput1').keyup(function () {
        
        var rxp = new RegExp($('#someinput1').val(), 'i');
        var optlist = $('#select2').empty();
        opts.each(function () {
            if (rxp.test(this[1])) {
                optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
            } else{
                optlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass("hidden"));
            }
        });
        $(".hidden").toggleOption(false);
    
    });
   

    $('.select_page1').click(function () {
        $('.select_page1 option:selected').remove().appendTo('.select_page');
        opts = $('#select2 option').map(function () {
            return [[this.value, $(this).text()]];
            
        });
    });

});
 
jQuery.fn.toggleOption = function( show ) {
    jQuery( this ).toggle( show );
    if( show ) {
        if( jQuery( this ).parent( 'span.toggleOption' ).length )
            jQuery( this ).unwrap( );
    } else {
        if( jQuery( this ).parent( 'span.toggleOption' ).length == 0 )
            jQuery( this ).wrap( '<span class="toggleOption" style="display: none;" />' );
    }
}; 

</script>

<?php
// nqs eshte klikuar search me php
if(isset($_POST['valueToSearch'])){
    $search=$_POST['valueToSearch'];
    $query = "SELECT * FROM user_form WHERE CONCAT(fname, lname, username, status, created, updated) LIKE '%$search%'
    OR  CONCAT(fname, ' ',lname) LIKE '%$search%'
    OR  CONCAT(fname, ' ',lname, ' ', username) LIKE '%$search%' ";

    $query_run = mysqli_query($conn, $query);
    echo '<table border="1" class="table table-hover" style="background:rgb(240, 245, 235)">
            <thead>
                <tr>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Username </th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                </tr>
          </thead>  <tbody>';
            
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            ?> 
            
            <tr>
                    <td><?= $row['fname'];?></td>
                    <td><?= $row['lname'];?></td>
                    <td><?= $row['username'];?></td>
                    <td id="status">
                        <?php 
                        if($row['status']==1){
                        echo '<p style="color:rgb(0, 119, 255)"> Enabled</p>';
                        }else{
                        echo '<p style="color:crimson"> Disabled</p>';
                        }
                        ;?>
                    </td>
                    <td><?= $row['created'];?></td>
                    <td><?= $row['updated'];?></td>
            </tr>
       
            <?php
        }
    }echo ' </tbody>
        </table>';
    if(mysqli_num_rows($query_run) == 0)
    {
        ?>
        <div class="form-container">
            <tr>
                <p>No record found. <a href="admin_page.php" style="text-decoration: none;">Search again</a></p>
            </tr>
    </div>
        <?php
    }  
    ?><a href="admin_page.php" style="text-decoration: none; text-align:center;display:flex; align-items:center; justify-content:center">Go back</a> 
    <?php
}?>

<?php
if(!isset($_POST['valueToSearch'])){
  ?>
  <form action="admin_page.php" method="post" style="border:none;" >
  <div id="excel-export" style="text-align:center;float:right">
                <input type="submit" name="export" class="btn btn-success" value="Export To Excel" style="float:left;margin-left:7px; text-decoration:none; text-align:center;" />
                <p><br></p>
              </div>
              <br><br>
  <a href="login_form.php" style="float:right;text-decoration:none;background:#eee;padding: 8px 42px;border-radius: 5px; border:1px solid grey "> <b>Logout</b></a>
  <br>
  </form>
<br>
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
              <td><?= $row['username'];?></td><!-- STATUSI-->
              <td id="status">
                <?php 
                if($row['status']==1){
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
          <td>
            <form action="admin_page.php" method="POST" style="border:none;">
              <button type="submit" style="background-color: crimson; padding:8px; border-radius:5px; text-decoration:none; color:#fff;cursor:pointer; border-style:none" name="user_delete" value="<?=$row['username'];?>">Delete</button>
              </td>
            </tr></form>
            <?php
        }
      }else{
        ?>
      
         <?php
      }
      ?>
<?php
    };
      ?>
  </form>
  </tbody>
</table> 
</body>
</html>