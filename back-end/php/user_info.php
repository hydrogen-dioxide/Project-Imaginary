<?php
  $q = $_GET["q"];
  include("sql_connect.php");
  $sql = "SELECT * FROM userInfo WHERE userID = '$q'";
  $res = $conn->query($sql);
  $cnt = 0;
  if($res == false) { echo "No result"; return; }
  while($row = mysqli_fetch_assoc($res)){
    foreach($row as $key => $val){
      echo "$key => $val" . " ";
    }
    echo "<br>";
    $cnt++;
  }
  if($cnt == 0) echo "No result.";  
?>