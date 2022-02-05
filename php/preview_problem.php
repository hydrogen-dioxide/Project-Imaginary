<?php
  include_once("ProblemClass.php");
  function compileProblem($problemID, $verbal = false){
    $problem = new Problem(); 
    $problem->loadFromSQL($problemID);
    $problem->updateFile();
    if($verbal) echo $problem->getPreview();
    return true;
  }
  if($_GET['problemID']) compileProblem($_GET['problemID'], true);
?>