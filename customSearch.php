<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style1.css?">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

  <!-- per dt-->
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        stateSave: true,
        buttons: [
          'colvis'
        ]
      });
    });
  </script>

</head>
<body>
    
</body>
</html>

<?php
include 'config.php';

$kolonat = $_POST['info'];
$cols = explode(',', $_POST['info']);
$size = sizeof($cols);

$query = "SELECT $kolonat FROM user_form";
$result = mysqli_query($conn, $query);
echo "<table border='1' id='myTable' class='table table-hover' class='display' style='background:rgb(240, 245, 235)'>
<thead style='padding: 15px; color:rgb(100,90,190)'>
    <tr style='padding: 15px;'>";

if (mysqli_num_rows($result)) {
    $i = 0;
    while ($i < $size) {
        echo "<th> $cols[$i] </th>";
        $i += 1;
    }
    
    echo "</tr>
    </thead>
    <tbody style='padding: 10px;'>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        for ($j = 0; $j < $size; $j++) {
            echo "<td style='padding: 15px;'>" . $row[$cols[$j]] . "</td>";
        }
    }
}
echo "</tbody></table>";
?>
