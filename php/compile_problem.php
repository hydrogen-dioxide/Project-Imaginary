<?php
  include_once("ProblemClass.php");
  function compileProblem($problemID, $verbal = false){
    // echo "Compiling " . $problemID . " ...";
    $problem = new Problem(); 
    $problem->loadFromSQL($problemID);
    $problem->updateFile();
    if($verbal) echo $problem->toHTML();
    // echo " Done" . "\n";
    return true;
  }
  if($_GET['problemID']) compileProblem($_GET['problemID'], true);
?>