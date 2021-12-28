<?php
  $q = $_GET["q"];
  include("sql_connect.php");
  $sql = "SELECT * FROM problem WHERE problemID = '$q'";
  $res = $conn->query($sql);
  $cnt = 0;
  echo "Echo of the music";
  while($row = mysqli_fetch_assoc($res)){
    echo $row["generatedStatement"];
    $cnt++;
  }
  if($cnt == 0) echo "No result.";  
?>