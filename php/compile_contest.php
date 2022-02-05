<?php
  include_once("compile_problem.php");
  function compileContest($contestID){
    include("sql_connect.php");
    $res = $conn->query("SELECT problemList FROM contest where contestID = '".$conn->real_escape_string($contestID)."';");
    if(!$res) return false;
    $row = json_decode($res->fetch_row()[0], true);
    foreach($row as $problem){
      compileProblem($problem);
    }
    return true;
  }
  if($_GET['contestID'] !== null) compileContest($_GET['contestID']);
?>