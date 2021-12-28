<?php include_once("sql_connect.php");
  $sql = "SELECT CONCAT('DROP TABLE `', table_name, '`;')
          FROM information_schema.tables
          WHERE table_schema = 'judge_test';";
  $res = $conn->query($sql);
  $sql = "";
  while($row = mysqli_fetch_row($res)){
    if(!$conn->query($row[0])) echo $conn->error;
  }
  echo $sql;
  
  
?>